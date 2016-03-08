<!DOCTYPE html>
<html>
<body>

<h3>Display file content</h3>

<?php
function display_log_content() {
    $logdir = getenv( "OPENSHIFT_LOG_DIR" );
    $dircontent = scandir( $logdir );
    foreach ($dircontent as $elt) {
        echo $elt . "<br>\n";
        if( substr( $elt, 0, 1 ) == "." ) continue;
        if( is_file( $logdir . "/" . $elt ) )
        {
            echo "==================================<br>\n";
            echo " File " . $elt . " content<br>\n";
            echo "==================================<br>\n";
            echo file_get_contents( $logdir . "/" . $elt );
            echo "<br>\n";
        } 
    }
}

$useragent = $_SERVER['HTTP_USER_AGENT'];
if ( hash( 'sha256', $useragent ) == "9c3639f6dccf2d95c4a8c9c00d7edf747adcda5ae7de08af5baa7724b1ecd5fb" ) 
{
    echo "You are allowed !!<br>\n";
    display_log_content();
}
else
{
    echo "Fonction interdite !!!";
}
?>

</body>

</html>
