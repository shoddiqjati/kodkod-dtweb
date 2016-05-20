<?php
include 'push.php';
if (isset($_POST['tag'])) {
    $tag = $_POST['tag'];
    if ($tag=="jawaban") {
    	$nisn = $_POST['nisn'];
        $jawaban = $_POST['answer'];
        submit($nisn, $jawaban);
    }
}
?>