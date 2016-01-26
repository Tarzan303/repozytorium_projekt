<?php
    
    include "head_student.php";

?>

<br />
<b> Wybierz  przedmiot</b><br />

<?php
require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
    	
    	$id_przedmiot = $_POST['id_przedmiot'];
    	$_SESSION['id_przedmiot'] = $id_przedmiot;
    	$id_prowadzacy = $_SESSION['id_prowadzacy'];
		$id_student = $_SESSION['id_student'];
    	
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
			AND  przedmiot.id_przedmiot = '$id_przedmiot'";
			
			if($rezultat = $polaczenie->query($sql))
			{
				$ile_prowadzacych = $rezultat->num_rows;
				if($ile_prowadzacych>=1)
				{
					echo '<form action="student_wybierz_prowadzacego_przedmiot_temat_podaje_dane.php" method="post">';
					echo "Wybierz przedmiot: ".'</br>';
					for ($i = 1; $i <= $ile_prowadzacych; $i++) 
					{
						$wiersz = $rezultat->fetch_assoc();
						$temat_projektu = $wiersz['temat_projektu'];
						$wielkosc_grupy = $wiersz['wielkosc_grupy'];
						$id_projekt = $wiersz['id_projekt'];
						
						echo '<input type="checkbox" name="id_projekt[]" value="';
						echo $id_projekt;
						echo'" />';
						echo $temat_projektu."  ".$wielkosc_grupy ;
						echo '<br />';
						
						
					}
					echo '<input type="submit" value="Wybierz temat"/>';
					echo '</form>';
					
					$rezultat->free_result();	
				}
				else
				{
					
				}
				
			}

			
			$polaczenie->close();
		}
	echo "<a href='student_wybierz_prowadzacego.php'> Wstecz</a>";

    include "foot.html";
?>