<!DOCTYPE html>
<html>
<body>

<h3>Fonction stupide en O(n^3)</h3>

<?php
  $starttime = microtime(true);
  $nb = $_GET['nb'];
  if (empty($nb)) 
  {
      echo "Erreur, vous devez donner un nombre (nb) en parametre !";
  }
  $a = 1;
  for($i = 0; $i < $nb; ++$i)
  {
        for($j = 0; $j < $nb; ++$j)
        {
            for($j = 0; $j < $nb; ++$j)
            {   
                for($k = 0; $k < $nb; ++$k)
                {   
                    ++$a;
                }
            }
        }
  }
  $timediff = microtime(true) - $starttime;
  echo "<br>Elapsed time : " . $timediff; 
?> 

</body>
</html>
