<?php
		// TODO: 连接数据库
		$connect = mysqli_connect('127.0.0.1', 'root', '930617', 'user');
		if (!$connect){
			$GLOBALS['msg'] = '数据库连接失败';
		}
		// TODO: 查询获取到的数据库表
		$data = mysqli_query($connect, 'select * from demo');
		if (!$data){
			$GLOBALS['msg'] = '查询失败';
		}
		// TODO 获取一条数据

		// TODO: 输出获取到的数据	
	
	?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXX管理系统</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">用户管理</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">商品管理</a>
      </li>
    </ul>
  </nav>
  <main class="container">
    <h1 class="heading">用户管理 <a class="btn btn-link btn-sm" href="add.php">添加</a></h1>
    <?php if(isset($msg)): ?>
    	<div class="alert alert-danger"><?php echo $msg; ?></div>
    <?php endif ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>头像</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th class="text-center" width="140">操作</th>
        </tr>
      </thead>
      <tbody>
      	
      	<?php while($row = mysqli_fetch_assoc($data)): ?>
      		<tr>
          <th scope="row"><?php echo $row['Id']; ?></th>
          <td><img src="<?php echo $row['avatar']; ?>" class="rounded" alt="<?php echo $row['name'] ?>"></td>
          <td><?php echo $row['name'] ?></td>
          <td><?php echo $row['gender']==0 ? '♀': '♂'; ?></td>
          <td><?php echo $row['birthday']; ?></td>
          <td class="text-center">
            <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['Id'] ?>">编辑</a>
            <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['Id'] ?>">删除</a>
          </td>
        </tr>
      	<?php endwhile ?>
      		
        
      </tbody>
    </table>
    <ul class="pagination justify-content-center">
      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
  </main>
</body>
</html>
