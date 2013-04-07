<?php

//TODO: http://jqueryui.com/tooltip/#custom-content
function smarty_function_dbxreflink($params, &$smarty) {
    require_once INC . '/db.php';
    global $db_urls, $db;
    if (!isset($db_urls))
        $db_urls = array(
            'GO' => 'http://amigo.geneontology.org/cgi-bin/amigo/term_details?term=GO:',
            'HMMSmart' => 'http://smart.embl-heidelberg.de/smart/do_annotation.pl?BLAST=DUMMY&DOMAIN=',
            'superfamily' => 'http://supfam.cs.bris.ac.uk/SUPERFAMILY/cgi-bin/search.cgi?search_field='
        );

    if (!isset($db_urls[$params['dbxref']['dbname']])) {
        $stm = $db->prepare('SELECT urlprefix FROM db WHERE name=:dbname');
        $stm->bindValue('dbname', $params['dbxref']['dbname']);
        $stm->execute();
        if (($row = $stm->fetch(PDO::FETCH_ASSOC)) != false) {
            $db_urls[$params['dbxref']['dbname']] = $row['urlprefix'];
        }
        else
            $db_urls[$params['dbxref']['dbname']] = '';
    }
    $description = sprintf('<span class="dbxref-tooltip" data-definition="%5$s" data-dbversion="%4$s">%1$s:%2$s%3$s</span>'
            , $params['dbxref']['dbname']
            , $params['dbxref']['accession']
            , !empty($params['dbxref']['name']) ? ' (' . $params['dbxref']['name'] . ')' : ''
            , !empty($params['dbxref']['dbversion']) ? $params['dbxref']['dbversion'] : 'unknown'
            , $params['dbxref']['definition']
        );


    $ret = null;

    if ($db_urls[$params['dbxref']['dbname']] == '')
        return $description;
    else
        return sprintf('<a href="%1$s%2$s" target="_blank">%3$s</a>', $db_urls[$params['dbxref']['dbname']], $params['dbxref']['accession'], $description);
}

?>
