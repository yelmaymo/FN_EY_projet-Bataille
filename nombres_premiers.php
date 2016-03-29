
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

<h3>FNombre premiers</h3>


<?php
    
  include "_functions.php";

$nb = $_GET['nb'];
$start = $_GET['start'];
$i=0;

if ( empty($nb) || empty($start) )  
  {
        echo "Erreur, vous devez spécifier deux nombres !";
        exit; 
  }

/*if ( gmp_strval(gmp_nextprime($start)) ) 
  {
    echo $start;
  }
*/
do{
 
echo ( gmp_strval(gmp_nextprime($start)) . " ");

$start = gmp_strval(gmp_nextprime($start)) + 1;

$i = $i + 1;

}while ($i < $nb);


/*
if(gmp_nextprime($start))
echo gmp_strval(gmp_nextprime($start));
*/  
?>


</body>
</html>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

