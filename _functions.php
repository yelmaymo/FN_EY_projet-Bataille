<?php


    function app_log( $msg )
    {
        error_log( $msg . "\n", 3, getenv( "OPENSHIFT_LOG_DIR" ) . "/application.log" );
    }

    function get_pq_conn()
    {
        define('DB_HOST', getenv('OPENSHIFT_POSTGRESQL_DB_HOST'));
        define('DB_PORT',getenv('OPENSHIFT_POSTGRESQL_DB_PORT')); 
        define('DB_USER',getenv('OPENSHIFT_POSTGRESQL_DB_USERNAME'));
        define('DB_PASS',getenv('OPENSHIFT_POSTGRESQL_DB_PASSWORD'));
        define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));

        $dbhost = constant("DB_HOST"); // Host name 
        $dbport = constant("DB_PORT"); // Host port
        $dbusername = constant("DB_USER"); // Mysql username 
        $dbpassword = constant("DB_PASS"); // Mysql password 
        $dbname = constant("DB_NAME"); // Database name
        
        $connstring = 'host=' . $dbhost . ' user=' . $dbusername . ' dbname=' . $dbname .' connect_timeout=5';
        $conn = pg_connect($connstring); // getenv( "OPENSHIFT_POSTGRESQL_DB_URL" ) );
        return $conn;
    }
?>
