<?php
	$GLOBALS['msg'] = '欢迎';
	$count = mysqli_connect('127.0.0.1', 'root', '930617','user');
	if(!$count){
		exit('<h1>数据库连接失败！</h1>');
	}
	//12
	$user = mysqli_query($count, 'select * from demo;');
	if (!$user){
		exit('<h1>查询失败！</h1>');
	}
//	$row = mysqli_fetch_assoc($user);
//	var_dump($row);
//	TODO: 遍历输出数据表中的值
	while ($row = mysqli_fetch_assoc($user)){
		var_dump($row);
		$row = mysqli_fetch_assoc($user);
	}
	
	
	mysqli_close($count);
?>

<html>
	<head>
		<mate charset='utf-8'></mate>
		<title></title>
	</head>
	<body>
		<h1><?php echo $msg; ?></h1>
	</body>
</html>