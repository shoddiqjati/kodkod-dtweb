<?php
session_start();
include '../db_configuration.php';
include 'open-table.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$listNisn = array();
$listKunci = array();

$splitKunci;
$listKunciHuruf = array();
$listAlasan = array();

$listNilaiPerson = array();
$fulldata = array();

$arrayJawaban = array();
$finalMark = array();

$z = 0;

if ($_SESSION['username'] == "admin") {
  if ($z == 0) {
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
  				$ak = 0;
  				while ($row = $result->fetch_assoc()) {
            $arrayJawaban[$i] = $arrayJawaban[$i] . "_" . $row['jawaban'] . "." . $row['alasan'];
  					if ($row['jawaban'] == $listKunciHuruf[$ak] && $row['alasan'] == $listAlasan[$ak]) {
  						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 2;
  					} elseif ($row['jawaban'] == $listKunciHuruf[$ak] || $row['alasan'] == $listAlasan[$ak]) {
  						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 1;
  					} else {
  						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 0;
  					}
  					$ak++;
  				}
  				$tampilNilai = number_format($listNilaiPerson[$i] / 30 * 100, 2, '.', '');
          $finalMark[$i] = $tampilNilai;
  			}
  		} else {
  			$query_answer = "SELECT * FROM (SELECT * FROM `tb_jawaban` WHERE `nisn` = 42014 ORDER BY `id_jawaban` DESC LIMIT 15) sub ORDER BY RIGHT(`id_soal`,2)";
  			$result = $conn->query($query_answer);
  			if ($result->num_rows>0) {
  				$ak = 0;
  				while ($row = $result->fetch_assoc()) {
            $arrayJawaban[$i] = $arrayJawaban[$i] . "_" . $row['jawaban'] . "." . $row['alasan'];
  					if ($row['jawaban'] == $listKunciHuruf[$ak] && $row['alasan'] == $listAlasan[$ak]) {
  						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 2;
  					} elseif ($row['jawaban'] == $listKunciHuruf[$ak] || $row['alasan'] == $listAlasan[$ak]) {
  						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 1;
  					} else {
  						$listNilaiPerson[$i] = $listNilaiPerson[$i] + 0;
  					}
  					$ak++;
  				}
  				$tampilNilai = number_format($listNilaiPerson[$i] / 30 * 100, 2, '.', '');
          $finalMark[$i] = $tampilNilai;
  			}
  		}
  	}
  }

  /*
   *ENDSECTION GETTING DATA
   */

  array_multisort($finalMark, SORT_DESC, SORT_NUMERIC, $listNisn, $arrayJawaban, $listNilaiPerson);
  $sofm = sizeof($finalMark);
  for ($i=0; $i < $sofm; $i++) {
    $j = $i + 1;
    $fulldata[$i] = $listNisn[$i] . " " . $arrayJawaban[$i] . " " . $listNilaiPerson[$i] . " " . $finalMark[$i]. " " . $j;
  }

  array_multisort($fulldata, SORT_ASC, SORT_NUMERIC);

  $x = 0;
  if ($x == 0) {
    for ($i=0; $i < $sofm; $i++) {
      $breakfd = explode(' ', $fulldata[$i]);
      $bfdanswer = explode('_', $breakfd[1]);
      $sobfda = sizeof($bfdanswer);
      echo "<tr><td>" . $breakfd[0] . "</td>";
      for ($j=1; $j < $sobfda; $j++) {
        $counterAK = $j - 1;
        $getAnsNum = explode('.', $bfdanswer[$j]);
        if ($getAnsNum[0] == $listKunciHuruf[$counterAK] && $getAnsNum[1] == $listAlasan[$counterAK]) {
          echo "<td style='background: #0288D1'>" . $getAnsNum[0] . $getAnsNum[1] . "</td>";
        } elseif ($getAnsNum[0] == $listKunciHuruf[$counterAK] || $getAnsNum[1] == $listAlasan[$counterAK]) {
          echo "<td style='background: #CDDC39'>" . $getAnsNum[0] . $getAnsNum[1] . "</td>";
        } else {
          echo "<td style='background: #FF5722'>" . $getAnsNum[0] . $getAnsNum[1] . "</td>";
        }
      }
      echo "<td>" . $breakfd[2] . "</td>";
      echo "<td>" . $breakfd[3] . "</td>";
      echo "<td>" . $breakfd[4] . "</td>";
      if ($breakfd[3] >= 70) {
        echo "<td>Lulus</td></tr>";
      } else {
        echo "<td>Tidak Lulus</td></tr>";
      }
    }
  }
  /*
   *SECTION
   *Getting Data and Sorting
   */
} else {
  header("Location: ../../error-404/");
}
include 'close-table.php';
?>
