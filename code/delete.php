<?php
	
	if (empty($_GET['id'])){
		exit('<h1>Id参数获取失败</h1>');
	}
	$id = $_GET['id'];
	
	// TODO: 连接数据库
	$connect = mysqli_connect('127.0.0.1', 'root', '930617', 'user');
	if (!$connect){
		exit('<h1>数据库连接失败</h1>');
	}
	$query = mysqli_query($connect, "delete from demo where Id = '{$id}' ");
	if (!$query){
		exit('<h1>删除数据失败</h1>');
	}
	
	header('Location: index.php');
	
?>