<?php
    
    include "head_student.php";

?>

<br />
<b> Wybierz  przedmiot</b><br />


<?php
require_once "connect.php";
    
    	
    
    	
    	//$_SESSION['id_przedmiot'];
    	//$_SESSION['id_prowadzacy'];
		 $_SESSION['id_projekt_wybrane'] =  $_POST['id_projekt'];   	
    
    	$id_projekt_wybrane= $_POST['id_projekt'];
		
		
		
		$ile = count($id_projekt_wybrane) ;
		$ile_do_priorytet = count($id_projekt_wybrane) ;
		
		for($i = 0; $i < $ile; $i++)
		{
			//echo $id_projekt_wybrane[$i];
			$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    		$polaczenie->set_charset("utf8");
			if ($polaczenie->connect_errno!=0)
    		{
        		echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    		}	
			else
			{
				
			$sql = "SELECT * FROM projekt WHERE projekt.id_projekt = '$id_projekt_wybrane[$i]'";
			
			if($rezultat = $polaczenie->query($sql))
				{
					
				echo '<form action="student_wybierz_prowadzacego_przedmiot_temat_podaje_dane_wysyla_do_bazy.php" method="post">';	
				//$ile_prowadzacych = $rezultat->num_rows;
				echo '<br />'."Wybrano tematy:  ";
				$wiersz = $rezultat->fetch_assoc();
				$temat_projektu = $wiersz['temat_projektu'];
				$wielkosc_grupy = $wiersz['wielkosc_grupy'];
				
				 echo $temat_projektu.'<br />';
				 echo "wielkość grupy:  ".$wielkosc_grupy.'<br />';
				/////////////////
				//wpisać dane przez studenta dla każdego tematu
				echo "podaj liczbe studentów".'<br />';
				
				echo '<select name="wielkosc_grupy[]">';
				//echo '<option>1</option>';
				for($ii = 1; $ii<=$wielkosc_grupy; $ii++)
				{
					echo '<option>';
					echo $ii;
					echo'</option>';
				}
				echo '</select><br />';
				echo"podaj priorytet:  <br />";
				echo '<select name="priorytet[]">';
				for($iii = 1; $iii<=$ile_do_priorytet; $iii++)
				{
					echo '<option>';
					echo $iii;
					echo'</option>';
				}
				
				echo '</select><br />';
				////////////////
				 
				
				 $polaczenie->close();
				 $rezultat->free_result();
				}

			}
			
		}//for
		
		echo '<br /><input type="submit" value="Potwierdz wybór"/>';
		echo '</form>';
		echo "<a href='student_wybierz_prowadzacego.php'> Wstecz</a><br />";
    	
    	/*
    	$id_przedmiot = $_POST['id_przedmiot'];
    	$_SESSION['id_przedmiot'] = $id_przedmiot;
    	$id_prowadzacy = $_SESSION['id_prowadzacy'];
    	
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
					echo '<form action="prowadzacy_dodaj_temat_projektu_wyswietl.php" method="post">';
					echo "Wybierz przedmiot: ".'</br>';
					for ($i = 1; $i <= $ile_prowadzacych; $i++) 
					{
						$wiersz = $rezultat->fetch_assoc();
						$temat_projektu = $wiersz['temat_projektu'];
						$wielkosc_grupy = $wiersz['wielkosc_grupy'];
						$id_projekt = $wiersz['id_projekt'];
						
						echo '<input type="checkbox" name="id_projekt" value="';
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
*/

?>

<?php
    include "foot.html";
?>