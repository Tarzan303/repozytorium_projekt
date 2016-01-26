<?php
        
    include "head_admin.php";

    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    $polaczenie->set_charset("utf8");
    
    $id_prowadzacy = $_GET['id_prowadzacy'];
	
	$sql_id_forma_zajec = sprintf("SELECT id_forma_zajec FROM forma_zajec, prowadzacy WHERE prowadzacy.id_prowadzacy = $id_prowadzacy AND prowadzacy.id_prowadzacy=forma_zajec.id_prowadzacy");
	$sql_id_przedmiot = sprintf("SELECT id_przedmiot FROM przedmiot, prowadzacy WHERE prowadzacy.id_prowadzacy = $id_prowadzacy AND prowadzacy.id_prowadzacy=przedmiot.id_prowadzacy");   
	
	$rezultat_przedmiot = @$polaczenie->query($sql_id_przedmiot);
	$ile_przedmiot = $rezultat_przedmiot->num_rows;
	
	if ($ile_przedmiot > 0)
	{
		for ($k = 1; $k <= $ile_przedmiot; $k++) 
        {
        	$wiersz_przedmiot = $rezultat_przedmiot->fetch_assoc();
			$id_przedmiot = $wiersz_przedmiot['id_przedmiot'];
			$sql_delete_przedmiot = sprintf("DELETE FROM przedmiot WHERE id_przedmiot=$id_przedmiot");
			$rezultat_delete_przedmiot = @$polaczenie->query($sql_delete_przedmiot);
			
        }
		
	}
	    
    $rezultat_forma_zajec = @$polaczenie->query($sql_id_forma_zajec);
	$ile_forma_zajec = $rezultat_forma_zajec->num_rows;

	
	if ($ile_forma_zajec > 0)
	{
		for ($i = 1; $i <= $ile_forma_zajec; $i++) 
        {
           	$wiersz_forma_zajec = $rezultat_forma_zajec->fetch_assoc();
			$id_forma_zajec = $wiersz_forma_zajec['id_forma_zajec'];
			$sql_id_projekt = sprintf("SELECT id_projekt FROM projekt, forma_zajec WHERE forma_zajec.id_forma_zajec = $id_forma_zajec AND forma_zajec.id_forma_zajec=projekt.id_forma_zajec");
			if ($rezultat_projekt = @$polaczenie->query($sql_id_projekt))
			{
				$ile_projekt = $rezultat_projekt->num_rows;			
       			if ($ile_projekt > 0)
       			{
       				for ($j = 1; $j <= $ile_projekt; $j++) 
                   	{                        
                       	$wiersz_projekt = $rezultat_projekt->fetch_assoc();
						$id_projekt = $wiersz_projekt['id_projekt'];
						
						$sql_id_priorytet = sprintf("SELECT id_priorytet FROM projekt, priorytet WHERE projekt.id_projekt = $id_projekt AND projekt.id_projekt=priorytet.id_projekt");
						if ($rezultat_priorytet = @$polaczenie->query($sql_id_priorytet))
						{
							$ile_priorytet = $rezultat_priorytet->num_rows;			
       						if ($ile_priorytet > 0)
       						{
       							for ($k = 1; $k <= $ile_priorytet; $k++) 
                   				{                        
                       				$wiersz_priorytet = $rezultat_priorytet->fetch_assoc();
									$id_priorytet = $wiersz_priorytet['id_priorytet'];
						
									$sql_id_wniosek = sprintf("SELECT id_wniosek FROM wniosek, priorytet WHERE priorytet.id_priorytet = $id_priorytet AND wniosek.id_priorytet=priorytet.id_priorytet");
									if ($rezultat_wniosek = @$polaczenie->query($sql_id_wniosek))
									{
										$ile_wniosek = $rezultat_wniosek->num_rows;			
       									if ($ile_wniosek > 0)
       									{
       										for ($l = 1; $l <= $ile_wniosek; $l++) 
                   							{                        
                       							$wiersz_wniosek = $rezultat_wniosek->fetch_assoc();
												$id_wniosek = $wiersz_wniosek['id_wniosek'];
												$sql_delete_wniosek = sprintf("DELETE FROM wniosek WHERE id_wniosek=$id_wniosek");
												$rezultat_delete_wniosek = @$polaczenie->query($sql_delete_wniosek);																														
											}	
																				
       									}												
									}
						
									$sql_delete_priorytet = sprintf("DELETE FROM priorytet WHERE id_priorytet=$id_priorytet");
									$rezultat_delete_priorytet = @$polaczenie->query($sql_delete_priorytet);
								}
																			
       						}												
						}
						
						$sql_delete_projekt = sprintf("DELETE FROM projekt WHERE id_projekt=$id_projekt");
						$rezultat_delete_projekt = @$polaczenie->query($sql_delete_projekt);
					}
																								
				}												
			}
			$sql_delete_forma_zajec = sprintf("DELETE FROM forma_zajec WHERE id_forma_zajec=$id_forma_zajec");
			$rezultat_delete_forma_zajec = @$polaczenie->query($sql_delete_forma_zajec);
		}		
		
	}
	
	$sql_delete_prowadzacy = sprintf("DELETE FROM prowadzacy WHERE id_prowadzacy=$id_prowadzacy");
	$rezultat_delete_prowadzacy = @$polaczenie->query($sql_delete_prowadzacy);	

	echo "Usunięto konto prowadzącego.";
	echo "<br /><br /><a href='admin_uzytkownicy.php'> Wstecz</a>";
	
       
    include "foot.html";
?>