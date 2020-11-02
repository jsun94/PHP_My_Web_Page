<?php
$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
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
        	    		<h1>Find your password</h1>
        	    	</div>
         
                    <form action="password.php" method="post">
                        
                        <div class="form-group">
                            <label for="username">Your Name</label>
                            <!-- <input type="hidden" name="revname" value="<?= $rev_name ?>"> -->
                            <input type="text" name="username" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="emial">E-mail</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter your e-mail">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Done">
                    </form>
                    <div class="row" align="center"><a href="login.php">Log in again?</a> </div>                  
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    		<div class='col-md-3'></div>
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
	<?php
	if( isset($_POST['submit']) ) {
		$name = $_POST['username'];
		$email = $_POST['email'];
		$query = "SELECT password FROM users WHERE username='$name' AND useremail = '$email'";
		$result = mysqli_query($con, $query);
        $row =mysqli_fetch_array($result);
        $password = $row[0];
        echo "<script> alert('Your password is $password')</script>";
}
?>

</body>
</html>