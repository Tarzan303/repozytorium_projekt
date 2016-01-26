<?php
        
    include "head_admin.php";

    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    $polaczenie->set_charset("utf8");
    
    $id_student = $_GET['id_student'];
    
    $sql_id_wniosek = sprintf("SELECT id_wniosek FROM wniosek, student WHERE student.id_student = $id_student AND student.id_student=wniosek.id_student");
   
    
    if ($rezultat_wniosek = @$polaczenie->query($sql_id_wniosek))
	{
		$ile_wniosek = $rezultat_wniosek->num_rows;
		if ($ile_wniosek > 0)
		{
			for ($j = 1; $j <= $ile_wniosek; $j++) 
            {
            	$wiersz_wniosek = $rezultat_wniosek->fetch_assoc();
				$id_wniosek = $wiersz_wniosek['id_wniosek'];
				$sql_id_priorytet = sprintf("SELECT id_priorytet FROM priorytet, wniosek WHERE wniosek.id_wniosek = $id_wniosek AND wniosek.id_wniosek=priorytet.id_wniosek");
				if ($rezultat_priorytet = @$polaczenie->query($sql_id_priorytet))
				{
					$ile_priorytet = $rezultat_priorytet->num_rows;			
        			if ($ile_priorytet > 0)
        			{
        				for ($i = 1; $i <= $ile_priorytet; $i++) 
                    	{                        
                        	$wiersz_priorytet = $rezultat_priorytet->fetch_assoc();
							$id_priorytet = $wiersz_priorytet['id_priorytet'];
							$sql_delete_priorytet = sprintf("DELETE FROM priorytet WHERE id_priorytet=$id_priorytet");
							$rezultat_delete_priorytet = @$polaczenie->query($sql_delete_priorytet);
																										
						}										
        			}												
				}
				$rezultat_priorytet->free_result();
				$sql_delete_wniosek = sprintf("DELETE FROM wniosek WHERE id_wniosek=$id_wniosek");
				$rezultat_delete_wniosek = @$polaczenie->query($sql_delete_wniosek);
				
			}
		}
	}
	$rezultat_wniosek->free_result();
	$sql_delete_student = sprintf("DELETE FROM student WHERE id_student=$id_student");
	$rezultat_delete_student = @$polaczenie->query($sql_delete_student);	
	
	echo "Usunięto konto studenta.";
	echo "<br /><br /><a href='admin_uzytkownicy.php'> Wstecz</a>";
	    
    include "foot.html";
?>