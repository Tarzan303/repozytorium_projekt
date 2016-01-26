<?php
    
  
    include "head_student.php"; 
    
    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    $polaczenie->set_charset("utf8");
    
    if ($polaczenie->connect_errno!=0)
    {
        echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    }
    else
    {
        $sql =sprintf("SELECT wniosek_status, wniosek_komentarz, priorytet, wielkosc_grupy, temat_projektu, 
        nazwa_przedmiotu, prowadzacy_imie, prowadzacy_nazwisko, liczba_grupy 
        FROM student s, wniosek w, priorytet pri, projekt pro, przedmiot prz, prowadzacy prow 
        WHERE w.id_wniosek = pri.id_wniosek AND pri.id_projekt = pro.id_projekt 
        AND pro.id_przedmiot = prz.id_przedmiot AND prz.id_prowadzacy = prow.id_prowadzacy 
        AND s.id_student = w.id_student AND s.id_student = '%s'", $_SESSION['id_student']);

            if($rezultat = $polaczenie->query($sql))
            {
                $ile_wnioskow = $rezultat->num_rows;
                if($ile_wnioskow>=1)
                {
                    echo "<table border>";
echo <<<END
                    <tr>
                        <td>temat_projektu</td>
                        <td>wielkosc_grupy</td> 
                        <td>liczba_grupy</td> 
                        <td>prowadzacy_imie</td>
                        <td>prowadzacy_nazwisko</td>
                        <td>nazwa_przedmiotu</td>
                        <td>wniosek_status</td>
                        <td>wniosek_komentarz</td>
                        <td>priorytet</td>
                        </tr>
END;
                    
                    for ($i = 1; $i <= $ile_wnioskow; $i++) 
                    {
                        
                        $wiersz = $rezultat->fetch_assoc();
                        $wielkosc_grupy = $wiersz['wielkosc_grupy']; 
						$liczba_grupy = $wiersz['liczba_grupy'];
                        $temat_projektu = $wiersz['temat_projektu']; 
                        $prowadzacy_imie = $wiersz['prowadzacy_imie']; 
                        $prowadzacy_nazwisko = $wiersz['prowadzacy_nazwisko']; 
                        $wniosek_status = $wiersz['wniosek_status']; 
                        $wniosek_komentarz = $wiersz['wniosek_komentarz']; 
                        $nazwa_przedmiotu = $wiersz['nazwa_przedmiotu'];
                        $priorytet = $wiersz['priorytet'];
                        
echo <<<END
                        <tr>
                        <td>$temat_projektu</td>
                        <td>$wielkosc_grupy</td> 
                        <td>$liczba_grupy</td> 
                        <td>$prowadzacy_imie</td>
                        <td>$prowadzacy_nazwisko</td>
                        <td>$nazwa_przedmiotu</td>
                        <td>$wniosek_status</td>
                        <td>$wniosek_komentarz</td>
                        <td>$priorytet</td>
                        </tr>
END;
                                               
                    }
                    echo "</table>";
                    echo "<br /><br /><a href='student.php'> Wstecz</a>";
                     
                    $rezultat->free_result();   
                }
                else
                {
                    echo "Brak wynikow";
                    
                    echo "<br /><br /><a href='student.php'> Wstecz</a>";
                    
                }
                
            }            
            $polaczenie->close();
        }
    
    include "foot.html";
?>