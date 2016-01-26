<?php
    
	include "head_prowadzacy.php";

		$_SESSION['id_wniosek'] = $id_wniosek = $_GET['id_wniosek'];
		
?>

<form action="prowadzacy_dodane_zajecia_dodaj_komentarz_dodaj_do_bazy.php" method="post">
	
	Wpisz komenetarz:<br />	
	<textarea rows="4" cols="50" name="komentarz"></textarea><br />
	<input type="submit" value="Dodaj komentarz"/>
</form>
	
<?php
	include "foot.html";
?>