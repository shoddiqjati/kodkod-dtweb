<?php
include 'db_configuration.php';

/*
	Created by P-CODE 2016
*/
// $answerFormat = "phy01_b.1 phy02_c.2 phy03_c.3 phy04_a.1 phy05_d.4";

$response = array();
function submit($nisn, $answer)
{
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	$date = date("Y-m-d");
	$array_ans = explode("#", $answer);
	$size_array = sizeof($array_ans);
	for ($i = 0; $i < $size_array; $i++) {
		$parsing = explode("_", $array_ans[$i]);
		$real_ans = explode(".", $parsing[1]);
		$query = "INSERT INTO `tb_jawaban` (`nisn`, `id_soal`, `jawaban`, `alasan`, `tanggal`) VALUES ('$nisn', '$parsing[0]', '$real_ans[0]', '$real_ans[1]', '$date')";
		$result = $conn->query($query);
		// echo $query;
	}
	// $response['response'] = "Jawaban telah dikumpulkan";
	// echo json_encode($response);
}

function reload($nisn, $answer, $score)
{
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	$datetime = date("H:i:s d/m/Y");
	$mark = $score * 100 / 30;
	$query = "INSERT INTO `tb_answer` (`nisn`, `answer`, `score`, `mark`, `time`) VALUES('$nisn', '$answer', '$score', '$mark', '$datetime')";
	// $result = $conn->query($query);
	echo $query;
}
?>
