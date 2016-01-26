<?php
    
    include "head_prowadzacy.php";

?>
<center><b> Dodawanie przedmiotów</b></center><br />

<?php
			$nazwa_przed = $_SESSION['nazwa_przed'];
			$forma_zajec = $_SESSION['forma_zajec'];
			$_SESSION['brak_wyboru_formy_nazwy'] = '';
			
echo <<<END
				dodano przedmiot <b>$nazwa_przed</b> <br />
				forma zajeć: $forma_zajec	<br />	<br />		
END;


if($forma_zajec == "projekt")
{
	require_once "connect.php";
    
    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
		
    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    	}	
		else
		{
			$sql_forma_zajec ="SELECT MAX(forma_zajec.id_forma_zajec) FROM forma_zajec";
			$sql_przedmiot ="SELECT MAX(przedmiot.id_przedmiot) FROM przedmiot";
			
			if($rezultat_forma_zajec = $polaczenie->query($sql_forma_zajec))
			{
				$wiersz = $rezultat_forma_zajec->fetch_assoc();
				$_SESSION['id_forma_zajec'] = $wiersz['MAX(forma_zajec.id_forma_zajec)'];					
				//echo $_POST['id_forma_zajec']. '<br/>';
			}
			
			if($rezultat_przedmiot = $polaczenie->query($sql_przedmiot ))
			{
				$wiersz = $rezultat_przedmiot->fetch_assoc();
				$_SESSION['id_przedmiot'] = $wiersz['MAX(przedmiot.id_przedmiot)'];					
				//echo $_POST['id_przedmiot']. '<br/>';
			}
						
			
		}

		
	
echo <<<END

<form action="prowadzacy_dodaj_temat_projektu_zapisz_do_bazy.php" method="post">
	
	Podaj nazwę tematu:</br>	
	<input type="text" name="nazwa_tematu" /><br />
	Podaj ilość grupy:</br>
	<input type="text" name="ilosc_grupy" /><br />
	<input type="submit" value="Dodaj temat projektu"/>
</form>
</br> 		
END;
		echo "Jeżeli chcesz dodać kolejne zajęcia,a nie chcesz dodawanać tematów kliknij:<br />";
		echo "<a href='prowadzacy_dodaj_przedmiot_forma-zajec.php'> Wstecz</a><br /><br />";
		echo "Jeżeli dodałeś projekt, a nie chcesz dodać tematów kliknij:<br />";
		echo "<a href='prowadzacy.php'> Wyjście</a>";
}

else 
{
	echo "Jeżeli chcesz dodać kolejne zajęcia kliknij:<br />";
	echo "<a href='prowadzacy_dodaj_przedmiot_forma-zajec.php'> Wstecz</a><br /><br />";
	echo "Jeżeli chcesz wyjść kliknij:<br />";
	echo "<a href='prowadzacy.php'> Wyjście</a><br />";
}
	echo $_SESSION['nie_poprawny_temat_grupa_projekt'];
    include "foot.html";
?>