<?php
    
    include "head_student.php";

    echo "<p>Witaj ".$_SESSION['student_imie']." ".$_SESSION['student_nazwisko'].'![<a href="logout.php">Wyloguj się!</a>]</p>';
    echo "<p><b>Grupa laboratoryjna: </b>".$_SESSION['student_grupa_laboratoryjna'];
    echo " | <b>Grupa projektowa: </b>".$_SESSION['student_grupa_projektowa'];
?>

<br />
<b> Wybierz  przedmiot</b><br />


<?php
		require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
    	
    	$id_prowadzacy = $_POST['id_prowadzacy'];
		
    	$_SESSION['id_prowadzacy'] = $id_prowadzacy;
    	
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			
			
			$sql = "SELECT * FROM projekt 
			JOIN przedmiot on przedmiot.id_przedmiot = projekt.id_przedmiot 
			JOIN prowadzacy ON prowadzacy.id_prowadzacy = przedmiot.id_prowadzacy 
			WHERE prowadzacy.id_prowadzacy = '$id_prowadzacy'
			GROUP BY przedmiot.id_przedmiot";
			
			if($rezultat = $polaczenie->query($sql))
			{
				$ile_prowadzacych = $rezultat->num_rows;
				if($ile_prowadzacych>=1)
				{
					echo '<form action="student_wybierz_prowadzacego_przedmiot_temat.php" method="post">';
					echo "Wybierz przedmiot: ".'</br>';
					for ($i = 1; $i <= $ile_prowadzacych; $i++) 
					{
						$wiersz = $rezultat->fetch_assoc();
						$nazwa_przedmiotu = $wiersz['nazwa_przedmiotu'];
						$id_przedmiot = $wiersz['id_przedmiot']; 
						
						
echo<<<END
						<input type="radio" name="id_przedmiot" value="$id_przedmiot" />
						$nazwa_przedmiotu<br />
END;
				
					}
					echo '<input type="submit" value="Wybierz przedmiot"/>';
					echo '</form>';
					echo "<a href='student_wybierz_prowadzacego.php'> Wstecz</a>";
					
					$rezultat->free_result();	
				}
				else
				{
					echo "brak dodanych";
				}
				
			}

			
			$polaczenie->close();
		}


    include "foot.html";
?>