<?php
if (isset($_POST['download'])) {
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data Summary by RANK.ods");
  include 'data.php';
}
?>
