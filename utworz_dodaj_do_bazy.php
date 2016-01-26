<?php
    session_start();
    
    include "head.html";
    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    $polaczenie->set_charset("utf8");
    
    $login_utworz = $_POST['login_utworz'];
    $haslo_utworz = sha1($_POST['haslo_utworz']);
    $imie_utworz = $_POST['imie_utworz'];
    $nazwisko_utworz = $_POST['nazwisko_utworz'];    
    
    
    
    if ($_SESSION['typ'] == "student")
    {
        $gr_lab = $_POST['gr_lab'];
        $gr_proj = $_POST['gr_proj'];
        $sql_utworz = sprintf("SELECT * FROM student WHERE student_login = '%s'", mysqli_real_escape_string($polaczenie,$login_utworz));
        if ($rezultat_utworz = @$polaczenie->query($sql_utworz))
        {
            $ile_utworz = $rezultat_utworz->num_rows;
            if ($ile_utworz > 0)
            {
                $_SESSION['blad_utworz'] = "<span style = 'color:red'>Podany login już istnieje!</span>";
               header('Location: utworz.php');
            }
            else
            {
                $sql_dodaj = "INSERT INTO `u879164499_proj`.`student` 
                    (`id_student`, `student_imie`, `student_nazwisko`, 
                    `student_grupa_laboratoryjna`, `student_grupa_projektowa`,`student_login`,`student_haslo`) 
                    VALUES (NULL, '$imie_utworz', '$nazwisko_utworz', '$gr_lab', '$gr_proj','$login_utworz','$haslo_utworz');";            
                if($rezultat_dodaj = $polaczenie->query($sql_dodaj))
                {
                    echo "Dodano do bazy użytkownika ".$login_utworz.".";
                    echo "<br /><br /><a href='czysc_sesje.php'> Wstecz</a>";
                }
                
            }
            $rezultat_utworz->free_result();   
    
        }        
    }
    else if ($_SESSION['typ'] == "prowadzacy")
    {
        $sql_utworz = sprintf("SELECT * FROM prowadzacy WHERE prowadzacy_login = '%s'", mysqli_real_escape_string($polaczenie,$login_utworz));
        if ($rezultat_utworz = @$polaczenie->query($sql_utworz))
        {
            $ile_utworz = $rezultat_utworz->num_rows;
            if ($ile_utworz > 0)
            {
                $_SESSION['blad_utworz'] = "<span style = 'color:red'>Podany login już istnieje!</span>";
                header('Location: utworz.php');
            }
            else
            {
                $sql_dodaj = "INSERT INTO `u879164499_proj`.`prowadzacy` 
                    (`id_prowadzacy`, `prowadzacy_imie`, `prowadzacy_nazwisko`, 
                    `prowadzacy_login`,`prowadzacy_haslo`) 
                    VALUES (NULL, '$imie_utworz', '$nazwisko_utworz','$login_utworz','$haslo_utworz');";            
                if($rezultat_dodaj = $polaczenie->query($sql_dodaj))
                {
                    echo "Dodano do bazy użytkownika ".$login_utworz.".";
                    echo "<br /><br /><a href='czysc_sesje.php'> Wstecz</a>";
                }           
            }
            $rezultat_utworz->free_result();   
    
        }
    }  
   include "foot.html";    
?>