<?php
    session_start();
    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
	
	 include "head.html";

	 echo "<p>Witaj ".$_SESSION['prowadzacy_imie']." ".$_SESSION['prowadzacy_nazwisko'].'![<a href="logout.php">Wyloguj się!</a>]</p>';
	  	 
	 require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
    	
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			
			$sql = "SELECT * FROM `forma_zajec` WHERE `forma_zajec` LIKE 'projekt'";
			
			if($rezultat = $polaczenie->query($sql))
			{
				$ile_przedmiotow = $rezultat->num_rows;
				if($ile_przedmiotow>=1)
				{
					echo '<form action="prowadzacy_dodaj_temat_projektu_wyswietl.php" method="post">';
					echo "Wybierz projekt:".'</br>';
					for ($i = 1; $i <= $ile_przedmiotow; $i++) 
					{
						$wiersz = $rezultat->fetch_assoc();
						$nazwa = $wiersz['forma_zajec'];				
						$id_projektu = $wiersz['id_forma_zajec'];
						
						
						
						echo '<input type="radio" name="id_projektu" value="';
						echo $id_projektu;
						echo'" />';
						echo $nazwa."  ".$id_projektu;
						echo '<br />';
						//echo $id."  ".$nazwa."  ".
						//'<a href="prowadzacy_dodaj_temat_projektu_wyswietl.php"> Dodaj temat projektu</a><br />';
						
						
					}
					echo '<input type="submit" value="Dodaj temat projektu"/>';
					echo '</form>';
					
					$rezultat->free_result();	
				}
				else
				{
					echo "brak dodanych";
				}
				
			}

			
			$polaczenie->close();
		}










?>
<br /><br /><a href="prowadzacy.php"> Wstecz</a>

<?php

    include "foot.html";
?>

		