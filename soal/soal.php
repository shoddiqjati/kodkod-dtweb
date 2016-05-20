<?php
include 'db_configuration.php';
Header('Content-Type: application/json; charset=UTF-8');
/*
	Created by P-CODE 2016
*/
	
$response = array();

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$conn->query("SET NAMES 'utf8'"); 
$conn->query("SET CHARACTER SET utf8");  
$conn->query("SET SESSION collation_connection = 'utf8_unicode_ci'");

$query = "SELECT * FROM `tb_soal` ORDER BY RAND()";
$result = $conn->query($query);

if ($result->num_rows>0) {
	while ($row = $result->fetch_array()) {
		extract($row);
		$qsn[] = array(
			'id_soal' => $id_soal,
			'kompetensi' => $kompetensi,
			'pertanyaan' => $pertanyaan,
			'jawaban' => array(
				'ans_a' => $ans_a,
				'ans_b' => $ans_b,
				'ans_c' => $ans_c,
				'ans_d' => $ans_d),
			'alasan' => array(
				'rsn_1' => $rsn_1,
				'rsn_2' => $rsn_2,
				'rsn_3' => $rsn_3,
				'rsn_4' => $rsn_4),
			'id_gambar' => $id_gambar,
			'kunci' => $kunci
			);

		// echo "α β γ δ ε ϝ ϛ ζ η θ ι κ λ μ ν ξ ο π ϟ ϙ ρ σ τ υ φ χ ψ ω ϡ";
	}
	$response['response'] = "soal";
	$response['soal'] = $qsn;
	echo json_encode($response);
}
?>
