<?php
    
    include "head_student.php";

	echo "<br />";
	echo "<b> Wybierz prowadzącego oraz przedmiot</b><br />";



require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
    	
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			
			$sql = "SELECT prowadzacy.id_prowadzacy, prowadzacy.prowadzacy_imie, prowadzacy.prowadzacy_nazwisko FROM prowadzacy";
			
			if($rezultat = $polaczenie->query($sql))
			{
				$ile_prowadzacych = $rezultat->num_rows;
				if($ile_prowadzacych>=1)
				{

echo<<<END
					<form action="student_wybierz_prowadzacego_przedmiot.php" method="post">
					Wybierz prowadzącego: </br>

END;
					
					for ($i = 1; $i <= $ile_prowadzacych; $i++) 
					{
						$wiersz = $rezultat->fetch_assoc();
						$prowadzacy_imie = $wiersz['prowadzacy_imie'];				
						$prowadzacy_nazwisko = $wiersz['prowadzacy_nazwisko'];
						$id_prowadzacy = $wiersz['id_prowadzacy'];
						
echo<<<END
						<input type="radio" name="id_prowadzacy" value="$id_prowadzacy" />
						$prowadzacy_imie $prowadzacy_nazwisko<br />
						
END;
						
					}

echo<<<END
					<br />
					<input type="submit" value="Wybierz prowadzącego"/>
					</form>
					<a href="student.php"> Wstecz</a>
END;
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