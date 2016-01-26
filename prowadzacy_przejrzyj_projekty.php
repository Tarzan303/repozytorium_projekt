<?php
    
    include "head_prowadzacy.php";

    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    $polaczenie->set_charset("utf8");
	
	$id = $_SESSION['id_prowadzacy'];
    
    if ($polaczenie->connect_errno!=0)
    {
        echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;      
    }
    
    else
    {
        $sql ="SELECT prowadzacy_imie, prowadzacy_nazwisko, temat_projektu, wielkosc_grupy, nazwa_przedmiotu 
               FROM prowadzacy, projekt, przedmiot 
               WHERE prowadzacy.id_prowadzacy = przedmiot.id_prowadzacy 
               AND projekt.id_przedmiot = przedmiot.id_przedmiot
               AND prowadzacy.id_prowadzacy = '$id'";

            if($rezultat = $polaczenie->query($sql))
            {
                $ile_tematow = $rezultat->num_rows;
                if($ile_tematow>=1)
                {
                    echo "<table border>";
                    echo "<tr><td>nazwa_przedmiotu</td><td>temat_projektu</td><td>wielkosc_grupy</td>";
                    echo "</tr>";
                    for ($i = 1; $i <= $ile_tematow; $i++) 
                    {
                        
                        $wiersz = $rezultat->fetch_assoc();
						$nazwa_przedmiotu = $wiersz['nazwa_przedmiotu'];
                        $wielkosc_grupy = $wiersz['wielkosc_grupy'];
                        $temat_projektu = $wiersz['temat_projektu'];

echo <<<END
                        <tr><td>$nazwa_przedmiotu</td>
                        <td>$temat_projektu</td>
                        <td>$wielkosc_grupy</td></tr>
END;
                                               
                    }
                    echo "</table>";
                    echo "<br /><br /><a href='prowadzacy.php'> Wstecz</a>";
                     
                    $rezultat->free_result();   
                }
                else
                {
                    echo "Brak wynikow";
                    
                    echo "<br /><br /><a href='prowadzacy.php'> Wstecz</a>";
                    
                }
                
            }

            
            $polaczenie->close();
        }
    include "foot.html";
?>