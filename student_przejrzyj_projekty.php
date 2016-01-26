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
        $sql ="SELECT prowadzacy_imie, prowadzacy_nazwisko, temat_projektu, wielkosc_grupy 
               FROM prowadzacy, projekt, przedmiot 
               WHERE prowadzacy.id_prowadzacy = przedmiot.id_prowadzacy 
               AND projekt.id_przedmiot = przedmiot.id_przedmiot";

            if($rezultat = $polaczenie->query($sql))
            {
                $ile_tematow = $rezultat->num_rows;
                if($ile_tematow>=1)
                {
                    echo "<table border>";
                    echo "<tr><td>temat_projektu</td><td>wielkosc_grupy</td>";
                    echo "<td>prowadzacy_imie</td><td>prowadzacy_nazwisko</td></tr>";
                    for ($i = 1; $i <= $ile_tematow; $i++) 
                    {
                        
                        $wiersz = $rezultat->fetch_assoc();
                        $wielkosc_grupy = $wiersz['wielkosc_grupy'];
                        $temat_projektu = $wiersz['temat_projektu'];
                        $prowadzacy_imie = $wiersz['prowadzacy_imie'];
                        $prowadzacy_nazwisko = $wiersz['prowadzacy_nazwisko'];
echo <<<END
                        <tr><td>$temat_projektu</td><td>$wielkosc_grupy</td>
                        <td>$prowadzacy_imie</td>
                        <td>$prowadzacy_nazwisko</td></tr>
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