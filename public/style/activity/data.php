<?php
$kucun = $_POST['kucun'];
if($kucun==1){
	$result = [
	'msg'=>'congratulation!',
	'cdkey'=>'cdkey111',
	'statu'=>1
	];
}else{
	$result = [
	'msg'=>'henyihan',
	'statu'=>0
	];
}
echo json_encode($result);
?>