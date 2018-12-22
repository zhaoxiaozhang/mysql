<?php

	if (empty($_GET['id'])) {
	  exit('<h1>获取ID参数失败</h1>');
	}
	
	$id = $_GET['id'];
	
	// TODO: 连接数据库并查询此id的相关数据
	$connect = mysqli_connect('127.0.0.1', 'root', '930617', 'user');
	if (!$connect) {
	  exit('<h1>连接数据库失败</h1>');
	}
	$query = mysqli_query($connect, "select * from demo where Id = '{$id}';");
	if (!$query) {
	  exit('<h1>查询失败</h1>');
	}
	$items = mysqli_fetch_assoc($query);

	// TODO: 重新保存数据并上传到数据库
		$name = $items['name'];
		$gender = $items['gender'];
		$birthday = $items['birthday'];
	
	// TODO： 头像上传相关操作
	function add (){

	
		
		if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK ){
			$end = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
			$target = './files/'.uniqid().'.'.$end;
			if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $target)){
				$GLOBALS['msg'] = '头像保存失败';
			}
			$avatar = $target;
				
				// TODO: 连接数据库保存
			
		}
		$query = mysqli_query($connect, "insert into demo value(NULL, '{$avatar}', '{$name}', '{$gender}', '{$birthday}')");    
			if (!$query){
				$GLOBALS['msg'] = '数据保存失败';
			}
		header('Location: index.php');
		
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		add();
	}
	
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
      <a class="navbar-brand" href="#">
        XXX管理系统
      </a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.html">
            用户管理
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            商品管理
          </a>
        </li>
      </ul>
    </nav>
    <main class="container">
      <h1 class="heading">添加用户</h1>
      <?php if(isset($msg)): ?>
      	<div class="alert alert-danger"><?php echo $msg ?></div>
      <?php endif ?>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $items['id'] ?>" method='post' enctype='multipart/form-data'>
        <?php if(isset($items)): ?>
        <div class="form-group">
          <label for="avatar">头像</label>
          <input type="file" class="form-control" id="avatar" name='avatar'>
        </div>
        <div class="form-group">
          <label for="name">姓名</label>
          <input type="text" class="form-control" id="name" name='name'  value='<?php echo $items['name'] ?>'>
        </div>
        <div class="form-group">
          <label for="gender">性别</label>
          <select class="form-control" id="gender">
            <option value='-1'>请选择性别</option>
            <option <?php echo $items['gender']=='1' ? ' selected' : '' ?> value='1'>男</option>
            <option <?php echo $items['gender']=='0' ? ' selected' : '' ?> vaule='0'>女</option>
          </select>
        </div>
        <div class="form-group">
          <label for="birthday">生日</label>
          <input type="date" class="form-control" id="birthday" name='birthday' value="<?php echo $items['birthday'] ?>">
        </div>
        <button class="btn btn-primary">
        保存
        </button>
        <?php endif ?>
      </form>
    </main>
  </body>
</html>
