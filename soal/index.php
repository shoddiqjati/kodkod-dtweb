<?php
include 'push.php';
if (isset($_POST['tag'])) {
    $tag = $_POST['tag'];
    if ($tag=="jawaban") {
    	$input = $_POST['input'];
      $split = explode(" ", $input);
      $nisn = $split[0];
      $answer = $split[1];
      $score = $split[2];
      reload($nisn, $answer, $score);
    }
}
?>
