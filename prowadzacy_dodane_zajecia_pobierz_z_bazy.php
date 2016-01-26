<?php
    
    include "head_prowadzacy.php";
    $_SESSION['nie_poprawny_temat_grupa_projekt'] = '';

	require_once "connect.php";

    	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    	$polaczenie->set_charset("utf8");
		$id_prowadzacego = $_SESSION['id_prowadzacy'];

    	if ($polaczenie->connect_errno!=0)
    	{
        	echo "Error".$polaczenie->connect_errno." Opis".$polaczenie->connect_error;
    	}
		else
		{
			$sql ="SELECT przedmiot.nazwa_przedmiotu,
			projekt.temat_projektu, projekt.wielkosc_grupy,
			student.student_imie, student.student_nazwisko,
			wniosek.liczba_grupy, priorytet.priorytet,
			wniosek.wniosek_status, wniosek.wniosek_komentarz,
			wniosek.id_wniosek, student.id_student
			FROM projekt JOIN przedmiot ON przedmiot.id_przedmiot = projekt.id_przedmiot
			JOIN prowadzacy ON prowadzacy.id_prowadzacy = przedmiot.id_prowadzacy
			JOIN priorytet ON priorytet.id_projekt = projekt.id_projekt
			JOIN wniosek ON wniosek.id_wniosek = priorytet.id_wniosek
			JOIN student ON student.id_student = wniosek.id_student
			WHERE prowadzacy.id_prowadzacy = '$id_prowadzacego'";

			if($rezultat = $polaczenie->query($sql))
			{
				$ile_wierszy = $rezultat->num_rows;
				if($ile_wierszy>=1)
				{
echo<<<END
<table border="1" style="width:100%">
<tr>
<td>nazwa przedmiotu</td>
<td>temat projektu</td>
<td>wielkość grupy</td>
<td>student imię</td>
<td>student nazwisko</td>
<td>liczba grupy</td>
<td>priorytet</td>
<td>wniosek status</td>
<td>komentarz</td>

</tr>

END;



					for ($i = 1; $i <= $ile_wierszy; $i++)
					{
						$wiersz = $rezultat->fetch_assoc();
						$nazwa_przedmiotu = $wiersz['nazwa_przedmiotu'];
						$temat_projektu = $wiersz['temat_projektu'];
						$wielkosc_grupy = $wiersz['wielkosc_grupy'];
						$student_imie = $wiersz['student_imie'];
						$student_nazwisko = $wiersz['student_nazwisko'];
						$liczba_grupy = $wiersz['liczba_grupy'];
						$priorytet = $wiersz['priorytet'];
						$wniosek_status = $wiersz['wniosek_status'];
						$komentarz = $wiersz['wniosek_komentarz'];
						$id_wniosek= $wiersz['id_wniosek'];
						$id_student= $wiersz['id_student'];
						if(!$wniosek_status)
						{

							$wniosek_status = '<a href="prowadzacy_dodane_zajecia_potwierdz.php?id_wniosek='.$id_wniosek.'">potwierdz</a>/
											   <a href="prowadzacy_dodane_zajecia_odrzuc.php?id_wniosek='.$id_wniosek.'">odrzuć</a>';
						}
						if(!$komentarz)
						{
							$komentarz = '<a href="prowadzacy_dodane_zajecia_dodaj_komentarz.php?id_wniosek='.$id_wniosek.'">dodaj</a>';
						}

echo<<<END

<tr>
<td>$nazwa_przedmiotu</td>
<td>$temat_projektu</td>
<td>$wielkosc_grupy</td>
<td>$student_imie</td>
<td>$student_nazwisko</td>
<td>$liczba_grupy</td>
<td>$priorytet</td>
<td>$wniosek_status</td>
<td>$komentarz</td>
</tr>
END;
					}//for
					echo'</table>';

					$rezultat->free_result();
				}
				else
				{
					echo "brak wpisów";
				}

			}


			$polaczenie->close();
		}


?>
<br /><br /><a href="prowadzacy.php"> Wstecz</a>

<?php

    include "foot.html";
?>

