<?php
include 'koneksi.php';
$nama_guru = $_GET['nama_guru'];
$query = mysqli_query($koneksi, "select id,nama from guru left join mapel on guru.nama_mapel=mapel.id where nama_guru='$nama_guru'");
$mapel = mysqli_fetch_array($query);
$data = array(
    'id' => $mapel['id'],
    'nama_mapel' => $mapel['nama']);
echo json_encode($data);