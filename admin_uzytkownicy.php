<?php
        
    include "head_admin.php";

    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    $polaczenie->set_charset("utf8");
    $sql_lista_student = sprintf("SELECT * FROM student");
    $sql_lista_prowadzacy = sprintf("SELECT * FROM prowadzacy");
    
    if ($rezultat_lista_stud = @$polaczenie->query($sql_lista_student))
    {
        $ile_student = $rezultat_lista_stud->num_rows;
        if ($ile_student > 0)
        {
                    echo "<b />Konta studentów";
                    echo "<table border= 1 align='center'width='90%'>";
                    echo "<tr><td>Student_imie</td><td>Student_nazwisko</td><td>Student_grupa_laboratoryjna</td>";
                    echo "<td>Student_grupa_projektowa</td><td>Student_login</td><td>Student_hasło</td>";
                    echo "</tr>";
                    for ($i = 1; $i <= $ile_student; $i++) 
                    {
                        
                        $wiersz = $rezultat_lista_stud->fetch_assoc();
                        $student_imie = $wiersz['student_imie'];
                        $student_nazwisko = $wiersz['student_nazwisko'];
                        $student_grupa_laboratoryjna = $wiersz['student_grupa_laboratoryjna'];
                        $student_grupa_projektowa = $wiersz['student_grupa_projektowa'];
                        $student_login = $wiersz['student_login'];
                        $student_haslo = $wiersz['student_haslo'];
                        $id_student = $wiersz['id_student'];
                        
echo <<<END
                        <tr><td>$student_imie</td>
                        <td>$student_nazwisko</td>
                        <td>$student_grupa_laboratoryjna</td>
                        <td>$student_grupa_projektowa</td>
                        <td>$student_login</td>
                        <td>$student_haslo</td>
                        <td width='50px'><a href='admin_uzytkownicy_usun_student.php?id_student=$id_student'> Usuń użytkownika </a></td>
                        <td width='50px'><a href='admin_uzytkownicy_aktualizuj_student.php?id_student=$id_student'> Zmień hasło </a></td>
                        </tr>                        
END;
                                                
                                               
                    }
                    echo "</table>";
                     
                    $rezultat_lista_stud->free_result();   
        }
        else
        {
            echo "Brak wyników";
        }
        
    }
    if ($rezultat_lista_prow = @$polaczenie->query($sql_lista_prowadzacy))
    {
        $ile_prowadzacy = $rezultat_lista_prow->num_rows;
        if ($ile_prowadzacy > 0)
        {
                    echo "Konta prowadzących";
                    echo "<table border align='center' width='90%' >";
                    echo "<tr><td>Prowadzacy_imie</td><td>Prowadzacy_nazwisko</td>";
                    echo "<td>Prowadzacy_login</td><td>Prowadzacy_haslo</td></tr>";
                    for ($i = 1; $i <= $ile_prowadzacy; $i++) 
                    {
                        
                        $wiersz = $rezultat_lista_prow->fetch_assoc();
                        $prowadzacy_imie = $wiersz['prowadzacy_imie'];
                        $prowadzacy_nazwisko = $wiersz['prowadzacy_nazwisko'];
                        $prowadzacy_login = $wiersz['prowadzacy_login'];
                        $prowadzacy_haslo = $wiersz['prowadzacy_haslo'];
                        $id_prowadzacy = $wiersz['id_prowadzacy'];
echo <<<END
                        <tr><td>$prowadzacy_imie</td>
                        <td>$prowadzacy_nazwisko</td>
                        <td>$prowadzacy_login</td>
                        <td>$prowadzacy_haslo</td>
                        <td width='50px'><a href='admin_uzytkownicy_usun_prowadzacy.php?id_prowadzacy=$id_prowadzacy'> Usuń użytkownika </a></td>
                        <td width='50px'><a href='admin_uzytkownicy_aktualizuj_prowadzacy.php?id_prowadzacy=$id_prowadzacy'> Zmień hasło </a></td>
                        </tr>
END;
                                               
                    }
                    echo "</table>";
                    
                    $rezultat_lista_prow->free_result();   
        }
        else
        {
            echo "Brak wyników";
        }
        
    }
    
    echo "<br /><br /><a href='admin.php'> Wstecz</a>";
    
    
    include "foot.html";
?>