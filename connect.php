<?php
$sever="znh.h.filess.io:3305";
$user="SiManfaktur23_separateby";
$pass="7b4ea2b777f492831ff69956825d0da01a82ef86";
$Dbs="SiManfaktur23_separateby";

$conn=mysqli_connect($sever,$user,$pass,$Dbs);
if(!$conn){
 echo "Terjadi error :".mysqli_connect_error();
}
?>