<!DOCTYPE html>
<html>
<body>

<h3>Fonction resurrection</h3>

<?php
    include "_functions.php";

    $conn = get_pq_conn();
    if( $conn == false ){
        echo "Erreur de connection a la base<br>";
        echo pg_last_error() . "<br>\n";
        app_log( "Erreur de connection à la base " . date( "Y-m-d H:M:S", time() ) );
        exit;
    }
    $result = pg_query($conn, "SELECT nb_pv FROM etat");
    if (!$result) {
          echo "Une erreur s'est produite.\n";
            exit;
          }

    $row = pg_fetch_row($result);
    $nbpv = $row[0];
    echo "Nb pv : " . $nbpv . "<br>\n";
    if( $nbpv <= 0 ) {
        echo "Resurrection ok !!<br>\n";
        pg_query($conn, "INSERT INTO anciennes_attaques_recues SELECT * FROM attaques_recues");
        pg_query($conn, "DELETE FROM attaques_recues");
        pg_query($conn, "UPDATE etat SET nb_points = nb_points - 50, nb_pv = 1000");
        app_log( "Resurrection done on " . date( "Y-m-d H:M:S", time() ) );
        pg_query($conn, "INSERT INTO log_points(categorie, points, created_at) VALUES( 1, -50, now() )");
    }
    else
    {
        echo "Resurrection impossible !!<br>\n";
        pg_query($conn, "UPDATE etat SET nb_points = nb_points - 2");
        pg_query($conn, "INSERT INTO log_points(categorie, points, created_at) VALUES( 2, -2, now() )");
        app_log( "Failed resurrection on " . date( "Y-m-d H:M:S", time() ) );
    }
?>

</body>

</html>
