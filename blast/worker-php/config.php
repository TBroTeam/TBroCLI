<?php

define('JOB_DB_CONNSTR', 'pgsql:host=132.187.22.155;dbname=dionaea_transcript_db_dev');
define('JOB_DB_USERNAME', 's202139');
define('JOB_DB_PASSWORD', 's202139');

define('MAX_FORKS', 2);
define('HOSTNAME', gethostname());
define('SUPPORTED_PROGRAMS', serialize(array(
            'blastn' => '/usr/bin/blastn',
            'blastp' => '/usr/bin/blastp',
            'blastx' => '/usr/bin/blastx',
            'tblastn' => '/usr/bin/tblastn',
            'tblastx' => '/usr/bin/tblastx'
        )));

#make sure you have write rights in this directory, as databases will be downloaded there
define('DATABASE_BASEDIR', '/storage/temp/blast/downloaded')
?>
