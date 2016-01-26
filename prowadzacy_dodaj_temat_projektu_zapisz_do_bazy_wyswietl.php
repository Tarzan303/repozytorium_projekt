<?php
    
     include "head_prowadzacy.php";
	 
		require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
		
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			$id_przedmiot = $_SESSION['id_przedmiot'];	
					
			$sql ="SELECT przedmiot.nazwa_przedmiotu, projekt.temat_projektu, projekt.wielkosc_grupy
			FROM projekt JOIN przedmiot on przedmiot.id_przedmiot = projekt.id_przedmiot
			WHERE projekt.id_projekt = ( SELECT MAX(projekt.id_projekt) FROM projekt )";
											
			if($rezultat = $polaczenie->query($sql))
			{
				$wiersz = $rezultat->fetch_assoc();
				$nazwa_przedmiotu = $wiersz['nazwa_przedmiotu'];
				$temat_projektu	= $wiersz['temat_projektu'];
				$wielkosc_grupy	= $wiersz['wielkosc_grupy'];				
				
				  
echo <<<END
				dodano temat:  <b>$temat_projektu</b> <br />
				o wielkosci: <b>$wielkosc_grupy</b>	<br />	
				dla przedmiotu: <b>$nazwa_przedmiotu</b> <br /><br />	
				Jeżeli chcesz dodać kolejny temat kliknij: <br />
				<a href="prowadzacy_dodaj_przedmiot_forma-zajec_wyswietl_dodane.php"> Wstecz</a><br /><br />
				Jeżeli chcesz wyjść kliknij:<br />
				<a href='prowadzacy.php'> Wyjście</a>
END;
			}
		}
		
		
		
?>



