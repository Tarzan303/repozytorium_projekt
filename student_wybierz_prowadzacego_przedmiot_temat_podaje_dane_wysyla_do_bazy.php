<?php
       
    include "head_student.php";

?>

<br />
<b> Wybierz  przedmiot</b><br />


<?php
require_once "connect.php";
    
    	
    	$wielkosc_grupy = $_POST['wielkosc_grupy'];
    	$priorytet = $_POST['priorytet'];
    	$ile = count($wielkosc_grupy) ;
    	$result = count($priorytet) == count(array_unique($priorytet));
    	if($result)
		{
			for($i = 0; $i < $ile; $i++)
			{
				
				//echo "wielkość grupy:  ".$wielkosc_grupy[$i]."    ";
				//echo "Priorytet:  ".$priorytet[$i].'</br>';
				$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    			$polaczenie->set_charset("utf8");
		
    			if ($polaczenie->connect_errno!=0)
    			{
        			echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    			}
				else
				{
					$id_student = $_SESSION['id_student'];
					$id_projekt = $_SESSION['id_projekt_wybrane'];
					
					$sql_wniosek = "INSERT INTO `u879164499_proj`.`wniosek` 
					(`id_wniosek`, `wniosek_status`, `wniosek_komentarz`, 
					`id_student`, `liczba_grupy`) 
					VALUES (NULL, '', '', '$id_student', '$wielkosc_grupy[$i]');";
					
					
					
					if($rezultat_wniosek = $polaczenie->query($sql_wniosek)) 
					{//&& $rezultat_priorytet = $polaczenie->query($sql_priorytet)
						
						$sql_id_wniosek = "SELECT MAX(wniosek.id_wniosek) FROM wniosek";
						
						if($rezultat_id_wniosek = $polaczenie->query($sql_id_wniosek)) 
						{
							$wiersz = $rezultat_id_wniosek->fetch_assoc();
							$id_wniosek = $wiersz['MAX(wniosek.id_wniosek)'];
							//echo $id_wniosek;	
								
							$sql_priorytet = "INSERT INTO `u879164499_proj`.`priorytet` 
							(`id_priorytet`, `id_projekt`, `id_wniosek`, `priorytet`) 
							VALUES (NULL, '$id_projekt[$i]', 
							'$id_wniosek', '$priorytet[$i]');";
							
							if($rezultat_priorytet = $polaczenie->query($sql_priorytet))
							{
								echo " dodano do bazy wniosek  ";
							}	
							
						}
						
					}
					
				}//else	
			}//for
		}
		else 
		{
			echo "nie prawidłowo podany priotytet ";	
		}
		
    	
    	echo "<a href='student_wybierz_prowadzacego.php'> Wstecz</a><br />";
    	
		
    	
		
		
		
    	
    	//$_SESSION['id_przedmiot'];
    	//$_SESSION['id_prowadzacy'];
		 //$_SESSION['id_projekt_wybrane'] =  $_POST['id_projekt'];   	
    /*
    	$id_projekt_wybrane= $_POST['id_projekt'];
		
		
		
		$ile = count($id_projekt_wybrane) ;
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
				//$ile_prowadzacych = $rezultat->num_rows;
				echo "Wybrano tematy: ";
				$wiersz = $rezultat->fetch_assoc();
				$temat_projektu = $wiersz['temat_projektu'];
				$wielkosc_grupy = $wiersz['wielkosc_grupy'];
				
				 echo $temat_projektu."  ".$wielkosc_grupy."  ";
				/////////////////
				//wpisać dane przez studenta dla każdego tematu
				
				////////////////
				 echo '</br>';
				
				 $polaczenie->close();
				 $rezultat->free_result();
				}

			}
			
		}
    	
    	
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