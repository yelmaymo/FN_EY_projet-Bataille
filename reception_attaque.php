<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

<h3>Fonction attaque</h3>
Explication : <br> vous devez appeler cette fonction en lui indiquant un attaquant avec le parametre attaquant. <br>
Par exemple : <br> coursosisepphp-aenori.rhcloud.com/reception_attaque.php?attaquant=coursosisepphp2-aenori <br>
Où la valeur du paramètre attaquant est votre propre application openshift (dans le cas ci-dessus, cela serait coursosisepphp2-aenori.rhcloud.com. <br> 
Ensuite les deux applications vont parler entre elles pour résoudre l'attaque.<br><br><br>

<h3>Resultat de l'attaque</h3>

<?php
    include "_functions.php";

  $attaquant = $_GET['attaquant'];
  if (empty($attaquant)) 
  {
        echo "Erreur, vous devez spécifier un attaquant en paramètre !";
        exit; 
  }
  $attaquant_url = "http://" . $attaquant . ".rhcloud.com/_attaque_api.php";
  $attaque = getenv( "OPENSHIFT_APP_NAME" ) . "-" . getenv( "OPENSHIFT_NAMESPACE" );
  $existe = strlen( file_get_contents( $attaquant_url ) ) != 0;
  if( $existe == false )
  {
        echo "Erreur, l'attaquant spécifié : <br>" . $attaquant_url . "<br>n'existe pas !";
        exit; 
  }
  ## Types d'attaque :
  # 1 - attaque normal
  # 2 - riposte
  # 3 - mise à mort
  # 4 - acharnement

  $conn = get_pq_conn();
  $result = pg_query($conn, "SELECT nb_pv FROM etat");
  $row = pg_fetch_row($result);
  $nb_pv = $row[0];
  if( $nb_pv <= 0 )
  {
      $type = 4;
      echo "Lache, j'étais déjà à terre, vous gagnez 1 point<br>";
  }
  else if( $nb_pv > 100 )
  {
      $type = 1;
      echo "Bonne attaque, 10 points<br>";
      pg_query($conn, "UPDATE etat SET nb_pv = nb_pv - 100");
      pg_query($conn, "INSERT INTO attaques_recues(attaquant, categorie, degats, created_at) VALUES( ".$attaquant.",1,100,now())");
  }
  file_get_contents( $attaquant_url . "?type=".$type );

?> 

</body>
</html>
