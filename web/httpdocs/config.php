<?php
define('APPPATH', '/');
define('SERVICEPATH', '/ajax');

define('OPENID_DOMAIN', 'localhost');

set_include_path(get_include_path() . PATH_SEPARATOR . '/path/to/web/includes');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DB', 'mydb');

if (isset($_REQUEST['DEBUG']))
    define('DEBUG', true);

error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
