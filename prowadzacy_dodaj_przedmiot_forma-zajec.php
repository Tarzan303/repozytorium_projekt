<?php
      
    include "head_prowadzacy.php";
    $_SESSION['nie_poprawny_temat_grupa_projekt'] = '';

?>
<center><b> Dodawanie przedmiotów</b></center><br />

<form action="prowadzacy_dodaj_przedmiot_forma-zajec_dodawanie_do_bazy.php" method="post">
	
	Podaj nazwę przedmiotu:		
	<input type="text" name="nazwa_przed" /><br />
	
	Wybierz formę zajęć:<br />		
	<input type="radio" name="forma_zajec" value="wykład" />Wykład<br />
	<input type="radio" name="forma_zajec" value="ćwiczenia" />Ćwiczenia<br />
	<input type="radio" name="forma_zajec" value="projekt" />Projekt<br />
	<input type="radio" name="forma_zajec" value="laboratorium" />Laboratorium<br />	
	
	<input type="submit" value="Dodaj przedmiot oraz forme zajęć"/>
</form>
<?php
	echo $_SESSION['brak_wyboru_formy_nazwy'];


	echo "<br /><br /><a href='prowadzacy.php'> Wstecz</a>";


    include "foot.html";
?>