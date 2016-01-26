
<?php
    session_start();
    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true) && $_SESSION['status'] == "student")
    {
        header('Location: student.php');
        exit();
    }
    else if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true) && $_SESSION['status'] == "admin")
    {
        header('Location: admin.php');
        exit();
    }

	require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
		
		    
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			
			if($_POST['nazwa_tematu']&& $_POST['ilosc_grupy']&& $_SESSION['id_forma_zajec'] && $_SESSION['id_przedmiot'] 
			  && ($_POST['ilosc_grupy']>= 1 && $_POST['ilosc_grupy']<= 100 ))
			{
				
				
				
				$wielkosc_grupy = $_POST['ilosc_grupy'];
				$temat_projektu = $_POST['nazwa_tematu'];
				$id_przedmiot = $_SESSION['id_przedmiot'];
				$id_forma_zajec = $_SESSION['id_forma_zajec'];
				
				$sql = "INSERT INTO `u879164499_proj`.`projekt` 
				(`id_projekt`, `wielkosc_grupy`, `temat_projektu`, `id_przedmiot`, `id_forma_zajec`)
				 VALUES (NULL, '$wielkosc_grupy', '$temat_projektu', '$id_przedmiot', '$id_forma_zajec');";
				
				
				if(($rezultat = $polaczenie->query($sql)))
				{
					header('Location: prowadzacy_dodaj_temat_projektu_zapisz_do_bazy_wyswietl.php');
					
				} 
				
			}
			else
		    {
		    	
				$_SESSION['nie_poprawny_temat_grupa_projekt'] = '<span style = "color:red">Brak nazwy tematu lub brak poprawne ilości grupy!</span>';
                header('Location: prowadzacy_dodaj_przedmiot_forma-zajec_wyswietl_dodane.php');	
			
			 
			 }

			$polaczenie->close();
		}

?>


		