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
		$id_prowadzacego = $_SESSION['id_prowadzacy'];
		
		$id_wniosek =  $_SESSION['id_wniosek'];
		$komentarz = $_POST['komentarz'];
		echo $id_wniosek; echo $komentarz;
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			$sql ="UPDATE wniosek SET wniosek.wniosek_komentarz = '$komentarz'
			 WHERE wniosek.id_wniosek = '$id_wniosek'";
			
			if($rezultat = $polaczenie->query($sql))
			{
			header('Location: prowadzacy_dodane_zajecia_pobierz_z_bazy.php');
			}

			
			$polaczenie->close();
		}










?>


		