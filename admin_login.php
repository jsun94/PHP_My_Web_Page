<?php
session_start();

$con = mysqli_connect('localhost', 'root', '123123', 'final_db');

if(isset($_POST['submit'])) {
	$admin_name = $_POST['admin_name'];
	$admin_pass = $_POST['admin_pass'];
	if (empty($_POST['admin_name'])) {
		echo "<script> alert('Check your name again !')</script>";
	}
	if (empty($_POST['admin_pass'])) {
		echo "<script> alert('Check your password again !')</script>";
	}
	$query = "SELECT admin_name, admin_pass FROM admin
	WHERE admin_name='$admin_name' AND admin_pass='$admin_pass'";
	
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0) {
		$_SESSION['admin_login'] = $admin_name;
		header("Location:admin_users.php");
	}
	else {
		echo "Wrong admin username or admin password !";
	}
}
/*
if(mysqli_connect_errno()) {
	echo "Connection Failed" .mysqli_connect_error();
}
else {
	echo "Success in Connection!!";
}
	*/
?>
<html>
<head>
	<title> Admin Login Page </title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
    	<div class="row">
    	    <div class='col-md-3'></div>
        <div class="col-md-6">
        	    <div class="form-wrap">
        	    	<div class = "page-header">
        	    		<h1>Please Administrator's Log in</h1>
        	    	</div>
         
                    <form action="admin_login.php" method="post">
                        <div class="form-group">
                            <label for="admin_name">Name</label>
                            <input type="text" name="admin_name" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="admin_pass">Password</label>
                            <input type="password" name="admin_pass" class="form-control" placeholder="Enter your password">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Log in">
                    </form>
                    	<a href="index.php" class="btn btn-default btn-block m-t-md" > Home </a>
                    	<div class='col-md-3'></div>
                    </div>
                </div>
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
</body>
</html>