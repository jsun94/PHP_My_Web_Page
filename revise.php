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
        	    	<div class = "page-header">
        	    		<h1><?= $rev_name ?>'s Password Edit</h1>
        	    	</div>
         
                    <form action="revise.php" method="post">
                        
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="hidden" name="revname" value="<?= $rev_name ?>">
                            <input type="password" name="revpassword" class="form-control" placeholder="Enter new password">
                        </div>
                        <!-- <div class="form-group">
                            <label for="emial">E-mail</label>
                            <input type="text" name="revemail" class="form-control" placeholder="Enter new e-mail">
                        </div> -->
                        <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Done">
                    </form>                   
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    		<div class='col-md-3'></div>
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
	<?php
	if( isset($_POST['submit']) ) {
		$name = $_POST['revname'];
		$password = $_POST['revpassword'];
		//$email = $_POST['revemail'];

       /* if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['revemail'])) {
            echo "<script> alert('You did not provide a e-mail address!') </script>";
        }else{*/
            $query = "UPDATE users SET password='$password' WHERE username='$name'";
            $result = mysqli_query($con, $query);
            if (mysqli_query($con, $query) ) {
                header("Location:admin_users.php");
			}
        //}
    }
?>
</body>
</html>