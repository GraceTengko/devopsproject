<?php

$host="103.23.198.122";
$user="Devs7";
$password="Team_Devops_7";
$db="mahasiswa_db";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
        die("Koneksi Gagal:".mysqli_connect_error());
        
}
?>