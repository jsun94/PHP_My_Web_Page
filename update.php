<?php
$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
$rev_name = $_GET['rev'];
?>

<html>
<head>
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
                    <div class="page-header">
                        <h1><?= $rev_name?> Edit</h1>
                    </div>
                
                    <form action="update.php" method="post" enctype="multipart/form-data">
                        <!-- <div class="form-group">
                            <label for="username">Your New Name</label>
                            <input type="text" name="newname" class="form-control" placeholder="Enter your new name">
                        </div> -->
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="hidden" name="revname" value="<?= $rev_name ?>">
                            <input type="password" name="newpass" class="form-control" placeholder="Enter your new password">
                        </div>
                        <div class="form-group">
                            <label for="email">Your New Email</label>
                            <input type="text" name="newemail" class="form-control" placeholder="Enter your new e-mail">
                        </div>
                        
                        <div class="form-group">
                            <label for="nickname">Your New Nickname</label>
                            <input type="text" name="newnickname" class="form-control" placeholder="Enter your new nickname">
                        </div>
                        <div class="form-group">
                            <label for="image">Your New Image</label>
                            <input type="file" name="newimage">
                        </div>
                        <div class="form-group"> 
                            <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Edit">
                        </div>
                       </form>                    
                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
        <div class='col-md-3'></div>
    </div>
    </div> <!-- /.container -->
	<?php
	if(isset($_POST['submit'])) {
		$rev_name = $_POST['revname'];
        //$newname = $_POST['newname'];
		$password = $_POST['newpass'];
		$email = $_POST['newemail'];
		$nickname = $_POST['newnickname'];
        $file = $_FILES['newimage']['tmp_name'];

        if( empty($_POST['newpass']) || empty($_POST['newemail']) || empty($_POST['newnickname']) || empty($file) ) {
            echo "<script> alert('You did not fill out the form completely!') </script>";
        }else{
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            echo "<script> alert('You did not provide a email address!') </script>";
        }
        $image_data = addslashes(file_get_contents($_FILES['newimage']['tmp_name']));
        $image_name = addslashes($_FILES['newimage']['name']);
        $image_size = getimagesize($_FILES['newimage']['tmp_name']);
         if($image_size == FALSE) {
            echo "That's not an image.";
            }else{
                $query = "UPDATE users SET user_image = '$image_name' , user_data = '$image_data' , password = '$password', useremail = '$email' , nickname = '$nickname' WHERE username='$rev_name'";
                if (mysqli_query($con, $query) ) {
                    $_SESSION['login'] = $rev_name;
                    header("Location:content.php");
                }
            }
        }
    }
        ?>
</body>
</html>