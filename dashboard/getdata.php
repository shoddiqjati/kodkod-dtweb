<?php
include 'db_configuration.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$listNisn = array();
$listKunci = array();

$splitKunci;
$listKunciHuruf = array();
$listAlasan = array();

$listNilaiPerson = array();

if ($_SESSION['username'] == "admin") {
	$query_kunci = "SELECT `kunci` FROM `tb_soal`";
	$result_kunci = $conn->query($query_kunci);
	if ($result_kunci->num_rows>0) {
		$k = 0;
		while ($row = $result_kunci->fetch_assoc()) {
			$listKunci[$k] = $row['kunci'];
			$k++;
		}
	}

	for ($l=0; $l < 15; $l++) {
		$splitKunci = explode('.', $listKunci[$l]);
		$listKunciHuruf[$l] = $splitKunci[0];
		$listAlasan[$l] = $splitKunci[1];
	}

	$query_users = "SELECT * FROM `users` ORDER BY `nisn`";
	$result = $conn->query($query_users);
	if ($result->num_rows>0) {
		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$listNisn[$i] = $row['nisn'];
			$i++;
		}
	}
	$lenghtArray = sizeof($listNisn);
	for ($i=0; $i < $lenghtArray; $i++) {
		$num = $i + 1;
		if ($listNisn[$i] != 42014) {
			$query_answer = "SELECT * FROM (SELECT * FROM `tb_jawaban` WHERE `nisn` = '$listNisn[$i]' ORDER BY `id_jawaban` ASC LIMIT 15) sub ORDER BY RIGHT(`id_soal`,2)";
			$result = $conn->query($query_answer);
			if ($result->num_rows>0) {
				echo "<tr><td>" . $listNisn[$i] . "</td>";
				$ak = 0;
				while ($row = $result->fetch_assoc()) {
					if ($row['jawaban'] == $listKunciHuruf[$ak] && $row['alasan'] == $listAlasan[$ak]) {
						echo "<td style='background: #0288D1'>" . $row['jawaban'] . $row['alasan'] . "</td>";
						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 2;
					} elseif ($row['jawaban'] == $listKunciHuruf[$ak] || $row['alasan'] == $listAlasan[$ak]) {
						echo "<td style='background: #CDDC39'>" . $row['jawaban'] . $row['alasan'] . "</td>";
						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 1;
					} else {
						echo "<td style='background: #FF5722'>" . $row['jawaban'] . $row['alasan'] . "</td>";
						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 0;
					}
					$ak++;
				}
				$tampilNilai = number_format($listNilaiPerson[$i] / 30 * 100, 2, '.', '');
				echo "<td>$num</td>";
				echo "<td>$tampilNilai</td></tr>";
			} else {
				echo "<tr><td>" . $listNisn[$i] . "</td>";
				for ($j=0; $j < 15; $j++) {
					echo "<td style='background: #FF5722'>--</td>";
					$listNilaiPerson[$i] = $listNilaiPerson[$i] + 0;
				}
				$tampilNilai = number_format($listNilaiPerson[$i] / 30 * 100, 2, '.', '');
				echo "<td>$num</td>";
				echo "<td>$tampilNilai</td></tr>";
			}

		} else {
			$query_answer = "SELECT * FROM (SELECT * FROM `tb_jawaban` WHERE `nisn` = 42014 ORDER BY `id_jawaban` DESC LIMIT 15) sub ORDER BY RIGHT(`id_soal`,2)";
			$result = $conn->query($query_answer);
			if ($result->num_rows>0) {
				echo "<tr><td>" . $listNisn[$i] . "</td>";
				$ak = 0;
				while ($row = $result->fetch_assoc()) {
					if ($row['jawaban'] == $listKunciHuruf[$ak] && $row['alasan'] == $listAlasan[$ak]) {
						echo "<td style='background: #0288D1'>" . $row['jawaban'] . $row['alasan'] . "</td>";
						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 2;
					} elseif ($row['jawaban'] == $listKunciHuruf[$ak] || $row['alasan'] == $listAlasan[$ak]) {
						echo "<td style='background: #CDDC39'>" . $row['jawaban'] . $row['alasan'] . "</td>";
						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 1;
					} else {
						echo "<td style='background: #FF5722'>" . $row['jawaban'] . $row['alasan'] . "</td>";
						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 0;
					}
					$ak++;
				}
				$tampilNilai = number_format($listNilaiPerson[$i] / 30 * 100, 2, '.', '');
				echo "<td>$num</td>";
				echo "<td>$tampilNilai</td></tr>";
			}
		}
	}
} else {
	header("./error-404");
}
?>
