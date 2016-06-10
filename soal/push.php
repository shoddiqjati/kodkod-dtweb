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

// function reload($nisn, $answer, $score)
// {
// 	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// 	$datetime = date("H:i:s d/m/Y");
// 	$mark = $score * 100 / 30;
// 	$query = "INSERT INTO `tb_answer` (`nisn`, `answer`, `score`, `mark`) VALUES('$nisn', '$answer', '$score', '$mark')";
// 	$result = $conn->query($query);
// 	// echo $query;
// }
// $input = '123 a.4_c.-_b.3_c.-_b.2_b.-_d.2_b.2_d.3_-.3_-.4_d.4_b.3_-.2_b.2 6,42014 c.2_c.2_b.2_c.1_d.2_c.3_a.1_a.1_b.2_a.2_a.3_a.2_c.2_b.1_c.3 10,111427 c.3_a.1_c.2_a.1_a.1_c.1_a.1_a.1_b.2_b.2_d.4_a.1_d.4_c.1_c.2 9,156550 b.2_c.2_c.2_a.1_d.2_a.1_a.1_c.3_c.3_d.1_d.1_d.4_a.4_a.4_b.3 25,156552 b.2_a.1_c.2_a.1_d.2_a.1_a.1_d.4_c.3_d.4_d.2_c.3_d.3_a.1_b.3 23,156559 b.2_c.2_c.2_d.1_d.2_a.1_c.2_c.3_c.3_d.1_d.1_d.4_a.4_a.4_b.3 22,156560 b.2_c.1_c.2_a.1_b.2_d.1_c.3_d.4_a.1_b.1_d.1_d.4_b.3_b.4_b.3 18,156561 b.2_b.4_c.2_a.1_d.2_d.1_c.1_d.4_c.3_b.1_d.1_d.4_a.3_b.1_b.2 19,156562 b.2_c.1_d.3_a.1_d.2_c.1_a.3_a.1_c.3_b.2_d.1_a.1_d.1_d.1_b.1 16,156564 b.2_b.4_c.2_a.1_d.2_d.1_c.1_d.4_c.3_b.1_d.1_d.4_a.3_b.1_b.2 19,156566 b.2_b.2_d.3_d.1_d.2_a.1_a.3_a.1_c.3_d.4_d.1_c.2_b.1_a.1_b.3 19,156568 b.2_c.1_c.2_c.1_a.2_c.2_a.1_d.4_a.1_d.4_d.2_a.1_d.3_a.1_b.3 18,156569 b.2_-.-_d.3_a.1_d.2_c.1_a.1_d.4_c.3_b.3_d.1_b.2_c.4_a.4_b.3 19,156570 b.2_a.1_c.2_a.1_b.2_b.2_a.1_d.4_d.4_c.3_d.1_b.2_a.3_a.2_b.3 16,156571 b.2_c.1_c.2_a.1_b.2_a.2_c.3_d.4_c.3_b.2_d.1_d.4_b.2_a.4_b.3 21,156574 b.2_d.4_d.2_c.1_d.2_c.2_a.1_d.4_c.3_b.3_d.1_b.2_c.4_a.2_b.2 16,156575 b.1_c.2_c.2_a.1_a.1_c.3_a.1_d.4_c.3_d.4_d.1_c.3_d.3_b.1_b.3 20,156576 b.2_c.3_c.2_b.1_b.3_a.1_a.3_a.1_d.4_d.4_d.1_b.2_c.3_a.1_b.3 16,156579 b.2_c.1_c.2_a.1_b.1_a.2_c.3_d.4_a.1_b.2_d.1_d.3_b.3_b.1_b.3 15,156580 b.2_c.1_d.3_a.1_d.2_c.1_a.3_a.1_c.3_b.2_d.1_a.1_d.1_d.1_b.1 16,156581 b.2_b.4_c.2_a.1_d.2_d.1_c.1_d.4_c.3_b.1_d.1_d.4_d.2_a.1_b.2 21,156582 b.2_b.4_c.2_a.1_a.2_d.1_c.1_d.4_c.3_b.1_d.2_d.4_d.2_a.4_b.3 21,156583 b.2_a.1_c.2_c.1_a.2_a.1_a.2_b.2_d.4_d.3_d.3_b.2_c.2_b.4_b.1 13,156584 b.2_a.3_c.2_b.1_d.2_c.1_a.3_a.1_c.3_a.1_d.1_a.2_c.4_d.2_b.3 15,156586 b.2_c.1_c.2_c.1_d.2_d.2_a.1_d.4_c.3_d.4_d.2_b.4_d.2_a.4_b.3 23,156587 b.2_c.2_c.2_b.1_-.4_c.2_a.1_a.1_c.3_b.2_d.4_c.3_b.2_d.1_b.- 13,156590 b.2_a.2_c.2_c.1_d.2_a.2_a.2_a.1_a.1_b.4_d.4_b.3_d.4_a.1_b.3 16,156592 c.3_-.-_c.2_a.1_d.4_c.1_a.2_a.1_c.3_b.2_d.-_a.1_d.3_d.1_b.3 13,156594 b.2_c.2_c.2_d.1_d.2_b.1_a.1_a.1_c.3_d.4_d.1_c.3_c.2_b.2_b.3 20,156595 b.2_a.1_c.2_a.1_d.2_d.3_c.3_a.1_c.3_b.2_d.4_a.1_d.4_b.4_b.3 15,156596 c.3_d.4_c.2_a.1_d.4_d.2_a.2_a.1_c.3_b.2_d.4_c.4_c.4_a.1_b.3 13,156597 b.2_c.4_c.4_d.4_d.1_c.1_a.2_a.1_c.3_d.4_d.1_d.4_c.3_b.2_c.4 15,156598 b.2_a.3_c.2_d.1_c.1_c.1_a.2_a.1_a.1_c.3_b.4_b.2_b.3_b.1_c.1 7,156601 b.2_c.2_c.2_d.4_a.1_c.1_a.1_d.4_d.4_c.1_d.1_c.3_d.2_b.2_c.1 14,156605 b.2_c.2_c.2_c.1_a.1_c.2_c.3_a.1_a.1_b.3_d.1_c.4_d.2_a.4_b.3 15,156606 b.2_b.2_c.2_a.1_a.1_a.2_a.3_a.1_b.2_a.1_d.1_b.2_d.2_a.1_c.2 13,156607 b.2_b.3_c.2_d.1_d.2_c.2_a.1_d.4_c.3_b.4_d.2_c.3_b.4_c.1_c.3 16,156608 b.2_b.3_c.2_d.1_a.1_b.4_a.1_d.4_c.3_b.2_d.1_d.4_a.4_a.4_a.3 18,156609 b.1_c.2_c.2_c.1_a.1_c.2_a.1_a.1_a.1_c.3_d.1_a.1_d.1_a.1_b.2 14,156611 b.2_c.1_c.2_a.1_d.2_a.1_a.1_d.4_c.3_b.2_d.1_a.1_d.4_c.1_b.3 22,156613 b.2_b.1_c.2_a.2_b.1_c.1_c.2_d.4_a.1_d.2_d.2_b.3_b.2_d.3_c.1 10,156616 c.2_b.3_c.2_d.1_a.2_a.1_a.3_a.1_d.4_a.3_d.1_a.1_d.3_a.4_b.3 15,156617 b.2_b.3_c.2_b.2_d.4_a.1_a.2_a.1_c.3_d.4_b.2_a.1_d.4_b.2_a.2 13,156618 b.2_c.4_c.2_a.1_d.2_a.1_a.1_a.1_d.4_d.4_d.2_d.4_b.2_d.2_b.3 20,156619 b.2_b.4_c.2_a.1_d.2_d.2_a.1_a.1_d.4_c.3_d.1_d.4_c.4_d.2_b.2 15,156620 a.2_b.4_c.2_c.1_a.2_a.1_c.3_a.1_d.4_a.3_d.1_a.1_d.2_a.4_b.3 14,156621 b.2_c.1_c.2_c.1_d.2_a.1_a.1_d.4_c.3_c.3_d.1_d.4_d.2_a.4_b.2 24,256555 b.2_d.4_d.3_c.1_a.1_c.2_a.1_a.1_c.3_b.3_d.4_a.2_c.4_b.3_b.3 10,256585 b.1_c.1_c.2_b.1_d.2_c.1_a.3_a.1_c.3_b.2_d.1_a.2_d.1_d.2_b.2 16,';
// $split = explode(",", $input);
// $size = sizeof($split);
// $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// for ($i=0; $i < $size; $i++) {
// 	$masuk = explode(" ", $split[$i]);
// 	$nisn = $masuk[0];
// 	$answer = $masuk[1];
// 	$score = $masuk[2];
// 	$mark = number_format($score * 100 / 30, 2, '.','');
// 	$query = "INSERT INTO `tb_answer` (`nisn`, `answer`, `score`, `mark`) VALUES('$nisn', '$answer', '$score', '$mark')";
// 	// echo $query;
// 	$result = $conn->query($query);
// }
// // echo $size;
?>
