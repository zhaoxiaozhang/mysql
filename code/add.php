<?php
	function add(){
		// TODO: 验证文本非空
		if (empty($_POST['name'])){
			$GLOBALS['msg'] = '请输入姓名';
			return;
		}
		if (!(isset($_POST['gender']) && $_POST['gender'] !== '-1' )){
			$GLOBALS['msg'] = '请选择性别';
			return;
		}
		 if (empty($_POST['birthday'])) {
    $GLOBALS['msg'] = '请输入日期';
    return;
  }

		
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		// TODO: 验证文件域
		if (empty($_FILES['avatar'])){
			$GLOBALS['msg'] = '请正确使用文件表单';
			return;
		}
		$avatar = $_FILES['avatar'];
		// TODO: 验证文件大小，格式，error
		if ($avatar['error'] !== UPLOAD_ERR_OK){
			$GLOBALS['msg'] = '上传失败';
			return;
		}
		if ($avatar['size'] > 1 *1024 *1024){
			$GLOBALS['msg'] = '上传头像过大';
			return;
		}

		//TODO: 获取文件后缀名
		$end = pathinfo($avatar['name'], PATHINFO_EXTENSION);
		$target = './files/'.uniqid().'.'.$end;
		if (!move_uploaded_file($avatar['tmp_name'], $target)){
			$GLOBALS['msg'] = '图像保存失败';
		}
		//保存头像信息
		$avatar = $target;
		// TODO: 保存数据到数据库
		$connect = mysqli_connect('127.0.0.1', 'root', '930617', 'user');
		if(!$connect){
			$GLOBALS['msg'] = '数据库连接失败';
		}
		
		$query = mysqli_query($connect, "insert into demo value(NULL, '{$avatar}', '{$name}', '{$gender}', '{$birthday}' )");
		if(!$query){
			$GLOBALS['msg'] = '数据保存失败';
		}
		
		header('Location: index.php');
	}
	
	
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
    <h1 class="heading">添加用户</h1>
    <?php if(isset($msg)): ?>
    	<div class="alert alert-danger"><?php echo $msg; ?></div>
    <?php endif ?>	
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' enctype='multipart/form-data'>
      <div class="form-group">
        <label for="avatar">头像</label>
        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
      </div>
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" id="gender" name="gender">
          <option value="-1">请选择性别</option>
          <option value="1">男</option>
          <option value="0">女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <input type="date" class="form-control" id="birthday" name="birthday">
      </div>
      <button class="btn btn-primary">保存</button>
    </form>
  </main>
</body>
</html>
