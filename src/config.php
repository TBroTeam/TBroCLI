<?php
//chado database
define('DB_ADAPTER','pgsql');
define('DB_CONNSTR', 'pgsql:host=${chado_db_host};dbname=${chado_db_name};port=${chado_db_port}');
define('DB_USERNAME', '${chado_db_username}');
define('DB_PASSWORD', '${chado_db_password}');

//uncomment for debugging
//    define('DEBUG', true);
//error_reporting(E_ALL );
//ini_set('display_errors', '1');


?>
