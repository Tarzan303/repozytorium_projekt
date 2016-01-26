<?php
    session_start();
    if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
    {
        header('Location: index.php');
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
       $login = $_POST['login'];
       $haslo = sha1($_POST['haslo']);
       $_SESSION['status']  = $_POST['status'];
       
       $login = htmlentities($login, ENT_QUOTES,"utf-8");
       $haslo = htmlentities($haslo, ENT_QUOTES,"utf-8");
       
       
       if ($_SESSION['status'] == "student")
       {
           $sql = sprintf("SELECT * FROM student WHERE student_login = '%s' AND student_haslo = '%s'", mysqli_real_escape_string($polaczenie,$login), mysqli_real_escape_string($polaczenie,$haslo));
           
       }
       else if ($_SESSION['status'] == "prowadzacy")
       {
           $sql = sprintf("SELECT * FROM prowadzacy WHERE prowadzacy_login = '%s' AND prowadzacy_haslo = '%s'", mysqli_real_escape_string($polaczenie,$login), mysqli_real_escape_string($polaczenie,$haslo));
       }
       else if ($_SESSION['status'] == "admin")
       {
           $sql = sprintf("SELECT * FROM admin WHERE admin_login = '%s' AND admin_haslo = '%s'", mysqli_real_escape_string($polaczenie,$login), mysqli_real_escape_string($polaczenie,$haslo));
       }
       
       
       if ($rezultat = @$polaczenie->query($sql))
       {
           $ilu_userow = $rezultat->num_rows;
           if($ilu_userow > 0 && $_SESSION['status'] == "student")
           {
               $_SESSION['zalogowany'] = true;
               
               $wiersz = $rezultat->fetch_assoc();
               $_SESSION['id_student'] = $wiersz['id_student'];
               $_SESSION['student_imie'] = $wiersz['student_imie'];
               $_SESSION['student_nazwisko'] = $wiersz['student_nazwisko'];
               $_SESSION['student_grupa_laboratoryjna'] = $wiersz['student_grupa_laboratoryjna'];
               $_SESSION['student_grupa_projektowa'] = $wiersz['student_grupa_projektowa'];
              
               
               unset($_SESSION['blad']);
               $rezultat->free_result();            
               header('Location: student.php');                

           }
           
           else if($ilu_userow > 0 && $_SESSION['status'] == "prowadzacy")
           {
               $_SESSION['zalogowany'] = true;
               
               $wiersz = $rezultat->fetch_assoc();
               $_SESSION['id_prowadzacy'] = $wiersz['id_prowadzacy'];
               $_SESSION['prowadzacy_imie'] = $wiersz['prowadzacy_imie'];
               $_SESSION['prowadzacy_nazwisko'] = $wiersz['prowadzacy_nazwisko'];

               
               unset($_SESSION['blad']);
               $rezultat->free_result();            
               header('Location: prowadzacy.php');                

           }
           else if ($ilu_userow > 0 && $_SESSION['status'] == "admin")
           {
               $_SESSION['zalogowany'] = true;
               header('Location: admin.php');   
           }
           else    
           {
               $_SESSION['blad'] = '<span style = "color:red">Nieprawidłowy login lub hasło!</span>';
               header('Location: index.php');
           }
       }
         
       $polaczenie->close();
    } 
?>