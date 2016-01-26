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
			if($_POST['nazwa_przed'] && $_POST['forma_zajec'])
			{
				$nazwa_przed = $_POST['nazwa_przed'];
				$forma_zajec = $_POST['forma_zajec'];
				$id_prowadzacego = $_SESSION['id_prowadzacy'];
				
				
				$sql_forma_zajec = "INSERT INTO `u879164499_proj`.`forma_zajec` 
				(`id_forma_zajec`, `forma_zajec`, `id_prowadzacy`) 
				VALUES (NULL, '$forma_zajec', '$id_prowadzacego');";
			
				$sql_nazwa_przed = "INSERT INTO `u879164499_proj`.`przedmiot` 
				(`id_przedmiot`, `nazwa_przedmiotu`, `id_prowadzacy`) 
				VALUES (NULL, '$nazwa_przed', '$id_prowadzacego');";

				if(($rezultat_forma_zajec = $polaczenie->query($sql_forma_zajec)) && 
			   	   ($rezultat_nazwa_przed = $polaczenie->query($sql_nazwa_przed)))
					{

						$_SESSION['nazwa_przed'] = $_POST['nazwa_przed'];
						$_SESSION['forma_zajec'] = $_POST['forma_zajec'];
						header('Location: prowadzacy_dodaj_przedmiot_forma-zajec_wyswietl_dodane.php');
					}
			
			}
			else
			{
				
				$_SESSION['brak_wyboru_formy_nazwy'] = '<span style = "color:red">Brak nazwy przedmiotu i/lub brak wyboru formy przedmiotu!</span>';
                header('Location: prowadzacy_dodaj_przedmiot_forma-zajec.php');
			}
			

			
			$polaczenie->close();
		}
	
?>