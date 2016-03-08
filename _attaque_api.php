<?php
    include "_functions.php";
        ## Types d'attaque :
        #  # 1 - attaque normal
        #    # 2 - riposte
        #      # 3 - mise à mort
        #        # 4 - acharnement
$type = $_GET['type'];
$conn = get_pq_conn();

$result = pg_query($conn, "SELECT nb_pv FROM etat");
$row = pg_fetch_row($result);

if( $row[0] <= 0 ) exit; 

if( $type == 1 )
    {
        pg_query($conn, "UPDATE etat SET nb_points = nb_points + 10");
    }
    else if( $type == 4 )
    {
        pg_query($conn, "UPDATE etat SET nb_points = nb_points + 1");
    }
?>

