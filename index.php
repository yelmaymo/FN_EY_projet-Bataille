<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head> 
<body>

<h3>Fonctionnalités disponibles sur ce site</h3>

<?php
function list_php_files() {
    $result = array();
    $dircontent = scandir( "." );
    foreach ($dircontent as $elt) {
        if( substr( $elt, 0, 1 ) == "." ) continue;
        if( is_file( $elt ) && (strlen( $elt ) > 4) && (substr($elt, -4) == ".php") && (substr($elt, 0, 1) != "_") )
        {
            array_push( $result, $elt );
        } 
    }
    return $result;
}

$all_php_files = list_php_files();
foreach( $all_php_files as $php_file )
{
    echo "<li><a href=\"" . $php_file . "\">" . $php_file . "</li>"; 
}

?>

</body>

</html>
