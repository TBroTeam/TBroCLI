<?php

class Isoform extends WebService {

    public function execute($data) {
        global $_CONST, $db;

#UI hint
        if (false)
            $db = new PDO();

        $param_isoform_uniquename = $data['query1'];
        $param_predpep_uniquename = null;

        $query_get_isoforms = <<<EOF
SELECT isoform.* 
    FROM feature AS isoform
    WHERE isoform.uniquename = :isoform_uniquename
    AND isoform.type_id = {$_CONST('CV_ISOFORM')}
EOF;
        $stm_get_isoforms = $db->prepare($query_get_isoforms);
        $stm_get_isoforms->bindValue('isoform_uniquename', $param_isoform_uniquename);

        $query_get_predpeps = <<<EOF
SELECT predpep.*, featureloc.* 
    FROM feature AS predpep, featureloc, feature AS isoform 
    WHERE featureloc.feature_id=predpep.feature_id 
        AND featureloc.srcfeature_id=isoform.feature_id
        AND predpep.type_id = {$_CONST('CV_PREDPEP')}
        AND isoform.uniquename = :isoform_uniquename
EOF;
        $stm_get_predpeps = $db->prepare($query_get_predpeps);
        $stm_get_predpeps->bindValue('isoform_uniquename', $param_isoform_uniquename);

        $query_get_interpro = <<<EOF
SELECT 
  interpro.* , featureloc.* 
FROM 
  feature predpep, 
  feature interpro, 
  featureloc
WHERE 
  interpro.feature_id = featureloc.feature_id AND
  featureloc.srcfeature_id = predpep.feature_id AND
  interpro.type_id = {$_CONST('CV_ANNOTATION_INTERPRO')} AND 
  predpep.uniquename = :predpep_uniquename
        
EOF;
        $stm_get_interpro = $db->prepare($query_get_interpro);
        $stm_get_interpro->bindParam('predpep_uniquename', $param_predpep_uniquename);

        $query_get_repeatmasker = <<<EOF
SELECT 
  repeatmasker.* , featureloc.* 
FROM 
  feature isoform, 
  feature repeatmasker, 
  featureloc
WHERE 
  repeatmasker.feature_id = featureloc.feature_id AND
  featureloc.srcfeature_id = isoform.feature_id AND
  repeatmasker.type_id = {$_CONST('CV_ANNOTATION_REPEATMASKER')} AND 
  isoform.uniquename = :isoform_uniquename
        
EOF;
        $stm_get_repeatmasker = $db->prepare($query_get_repeatmasker);
        $stm_get_repeatmasker->bindValue('isoform_uniquename', $param_isoform_uniquename);

        function strand2dir($strand) {
            return $strand > 0 ? 'right' : 'left';
        }

        function space($sequence) {
            $ret = "";
            for ($i = 0; $i < strlen($sequence); $i++)
                $ret .= $sequence{$i} . '  ';
            return substr($ret, 0, -2);
        }

        function rewinds($sequence, $strand) {
            if ($strand < 0)
                return strrev($sequence);
            return $sequence;
        }

        $json = array();

        $min = 0;
        $max = 0;

        $stm_get_isoforms->execute();
        if (($isoform = $stm_get_isoforms->fetch(PDO::FETCH_ASSOC)) !== false) {
            $max = $isoform['seqlen'];
            $json[] = array(
                #'name' => 'Isoform',
                'type' => 'sequence',
                'subtype' => 'DNA',
                'data' => array(array(
                        'id' => $isoform['uniquename'],
                        'sequence' => $isoform['residues'],
                        'dir' => 'right',
                        'offset' => 1
                ))
            );

            $stm_get_repeatmasker->execute();
            $data = array();
            while ($repeatmasker = $stm_get_repeatmasker->fetch(PDO::FETCH_ASSOC)) {
                $left = $repeatmasker['fmin'];
                $right = $repeatmasker['fmax'];

                $data[] = array(
                    'id' => $repeatmasker['uniquename'],
                    'data' => array(array($left, $right)),
                    'dir' => strand2dir($repeatmasker['strand'])
                );
            }
            if (count($data) > 0)
                $json[] = array(
                    #'name' => 'Interpro Domains',
                    'type' => 'box',
                    'fill' => 'rgb(255,25,51)',
                    'outline' => 'rgb(0,0,0)',
                    'data' => $data
                );
            unset($data);

            $stm_get_predpeps->execute();
            while ($predpep = $stm_get_predpeps->fetch(PDO::FETCH_ASSOC)) {

                $json[] = array(
                    #'name' => 'Predicted Peptides',
                    'type' => 'sequence',
                    'subtype' => 'DNA',
                    'fill' => 'rgb(255,255,51)',
                    'outline' => 'rgb(0,0,0)',
                    'data' => array(array(
                            'id' => $predpep['uniquename'],
                            'sequence' => space(rewinds($predpep['residues'], $predpep['strand'])),
                            'offset' => $predpep['fmin'],
                            'dir' => 'right'#strand2dir($predpep['strand'])
                    ))
                );


                $param_predpep_uniquename = $predpep['uniquename'];
                $stm_get_interpro->execute();
                $data = array();
                while ($interpro = $stm_get_interpro->fetch(PDO::FETCH_ASSOC)) {
                    $left = $predpep['fmin'] + ($interpro['fmin'] - 1) * 3;
                    $right = $left + ($interpro['fmax'] - $interpro['fmin'] + 1) * 3;
                    $data[] = array(
                        'id' => $interpro['uniquename'],
                        'data' => array(array($left, $right)),
                        'dir' => strand2dir($interpro['strand'])
                    );
                }
                if (count($data) > 0)
                    $json[] = array(
                        #'name' => 'Interpro Domain',
                        'type' => 'box',
                        'fill' => 'rgb(20,255,51)',
                        'outline' => 'rgb(0,0,0)',
                        'data' => $data
                    );
            }
        }

        return array('tracks' => $json, 'min' => $min, 'max' => $max);
    }

}

?>
