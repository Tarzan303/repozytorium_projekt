<?php
    session_start();
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true) && $_SESSION['status'] == "student")
    {
        header('Location: student.php');
        exit();
    }
    else if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true) && $_SESSION['status'] == "prowadzacy")
    {
        header('Location: prowadzacy.php');
        exit();
    }
    else if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true) && $_SESSION['status'] == "admin")
    {
        header('Location: admin.php');
        exit();
    }
  
    include "head.html";
?>
<div id="okno_logowania">
<form action="zaloguj.php" method="post">
    <div class="napis_logowanie">Login: <br /></div> <input type="text" name="login"/> <br />
    <div class="napis_logowanie">Hasło <br /></div> <input type="password" name="haslo" /> <br />
    <div class="radio_logowanie"><input type="radio" name="status" value="student"/>Student<br /></div>
    <div class="radio_logowanie"><input type="radio" name="status" value="admin"/>Admin<br /></div> 
    <div class="radio_logowanie"><input type="radio" name="status" value="prowadzacy"checked/>Prowadzący <br /></div>
    <input type="submit" value="Zaloguj się" id="przycisk_logowanie"/>
</form>
<form action="utworz.php" method="post">    
    <input type="submit" value="Nowe konto" id="przycisk_nowe_konto"/>
    <div class="radio_logowanie"><input type="radio" name="typ" value="student"/>Student<br /></div>
    <div class="radio_logowanie"><input type="radio" name="typ" value="prowadzacy"checked/>Prowadzący <br /></div>
</form>
</div>

<?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

    include "foot.html";	
?>