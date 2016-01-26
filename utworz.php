<?php
    session_start();

    include "head.html";
    if(!isset($_SESSION['typ'])) $_SESSION['typ']  = $_POST['typ'];
    
    if ($_SESSION['typ'] == "student")
       {
echo<<<END
<div id="okno_utworz">
<form action="utworz_dodaj_do_bazy.php" method="post">
<div class="napis_utworz">Login: <br /></div> <input type="text" name="login_utworz" /> <br />
<div class="napis_utworz">Hasło <br /></div> <input type="password" name="haslo_utworz" /> <br />
<div class="napis_utworz">Imie: <br /></div> <input type="text" name="imie_utworz"/> <br />
<div class="napis_utworz">Nazwisko: <br /></div> <input type="text" name="nazwisko_utworz"/> <br />
<div class="napis_utworz">Grupa laboratoryjna: <br /></div> <input type="text" name="gr_lab"/> <br />
<div class="napis_utworz">Grupa projektowa: <br /></div> <input type="text" name="gr_proj"/> <br />
<input type="submit" value="Dodaj" id="przycisk_utworz"/>
</form>
</div>
<form action="czysc_sesje.php">    
    <input type="submit" value="Anuluj" id="przycisk_nowe_konto"/>
</form>
END;
           
       }
    else if ($_SESSION['typ'] == "prowadzacy")
       {
echo<<<END
<div id="okno_utworz">
<form action="utworz_dodaj_do_bazy.php" method="post">
<div class="napis_utworz">Login: <br /></div> <input type="text" name="login_utworz"/> <br />
<div class="napis_utworz">Hasło <br /></div> <input type="password" name="haslo_utworz" /> <br />
<div class="napis_utworz">Imie: <br /></div> <input type="text" name="imie_utworz"/> <br />
<div class="napis_utworz">Nazwisko: <br /></div> <input type="text" name="nazwisko_utworz"/> <br />
<input type="submit" value="Dodaj" id="przycisk_utworz"/>
</form>
</div>
<form action="czysc_sesje.php">    
    <input type="submit" value="Anuluj" id="przycisk_nowe_konto"/>
</form>

END;
       }
       
    if(isset($_SESSION['blad_utworz'])) echo $_SESSION['blad_utworz'];
       
       

    include "foot.html";    
?>