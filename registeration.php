<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost','root','123123','final_db');

if(isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$nickname = $_POST['nickname'];
	$file = $_FILES['image']['tmp_name'];

	if( empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['nickname'])) {
		echo "<script> alert('You did not fill out the form completely!') </script>";
	}else {
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])) {
            echo "<script> alert('You did not provide a valid email address!') </script>";
        }
        if (empty($file)) {
            echo "<script> alert('Please selcet an image') </script>";
        }else{
            $query = "SELECT * FROM users WHERE username='$username' OR useremail='$email'";
            $result = mysqli_query($con, $query);
            if( mysqli_num_rows($result) > 0) {
                header("Location:registeration.php?MSG=Username or email is already exist, Please use another one!!");
            }else {
                $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $image_name = addslashes($_FILES['image']['name']);
                $image_size = getimagesize($_FILES['image']['tmp_name']);

                if($image_size == FALSE) {
                    echo "<script> alert('That's not a image!') </script>";
                }else{
                    $query = "INSERT INTO users VALUES (NULL , '$image_name' , '$image_data' , '$username', '$password', '$email' , '$nickname')";
                    if (mysqli_query($con, $query) ) {
                        $_SESSION['login'] = $username;
                        $_SESSION['image'] = $image_name;
                        $_SESSION['nickname'] = $nickname;
                        header("Location:content.php");
                    }else{
                        echo "wrong!!";
                    }
                }
            }	
        }
    }
}
?>
<html>
<head>
	<title> Registration Page </title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if(isset($_GET['MSG'])) {
	echo $_GET['MSG'];
}
?>

<div class="container"> 
    	<div class="row">
    	    <div class='col-md-3'></div>
        <div class="col-md-6">
        	    <div class="form-wrap">
        	    	<div class="page-header">
        	    		<h1>Register now to create an account</h1>
        	    	</div>
                
                    <form action="registeration.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Your Name</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter your e-mail">
                        </div>
                        
                        <div class="form-group">
                            <label for="nickname">Your Nickname</label>
                            <input type="text" name="nickname" class="form-control" placeholder="Enter your nickname">
                        </div>
                        <div class="form-group">
                            <label for="image">Your Image</label>
                            <input type="file" name="image" width="500px" height="400px">
                        </div>
                        <div class="form-group"> 
                            <input type="submit" name="submit" class="btn btn-primary btn-block m-t-md" value="Register">
                        </div>
                       </form>
                       Already registered?  <a href="login.php"> Login </a>
                    
                    <hr>
                    
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    	<div class='col-md-3'></div>
    </div> <!-- /.container -->

</body>
</html>