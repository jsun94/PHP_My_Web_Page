<?php
session_start();

$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
if(isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if (empty($_POST['username']) || empty($_POST['password'])) {
		echo "<script> alert('You did not fill out the form completely!')</script>";
	}else{
		$query = "SELECT username, password  FROM users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0) {
			$_SESSION['login'] = $username;
			header("Location:content.php");
		}else {
		echo "<script> alert('Check your name and password again!')</script>";
	    }
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
<title> Login Page </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
function showUsers(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getusers.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<div class="container">
    	<div class="row">
    	    <div class='col-md-3'></div>
        <div class="col-md-6">
        	    <div class="form-wrap">
        	    	<div class = "page-header">
        	    		<h1>Please Log in</h1>
        	    	</div>
         
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter your name" onkeyup="showUsers(this.value)">
                            <p>Suggestions: <span id="txtHint"></span></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <a href="password.php" class="btn btn-link">Forgot your password?</a>
                        <!-- <a href="javascript:;" class="text-center" data-toggle="modal" data-target=".forget-modal">Forgot your password?</a> -->
                        <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Log in">
                    </form>
                    
                    <div class="form-group">
                        <p class="text-center">Do not have an account?</p> 
                        <a href="registeration.php" class="btn btn-default btn-block m-t-md">Create an account</a>
                    </div>
                    <hr>
                    <div class="row" align="center">
                    	<a href="index.php" class="btn btn-default">Home</a>
                    </div>
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    		<div class='col-md-3'></div>
    	</div> <!-- /.row -->
    </div> <!-- /.container -->

    <!-- <div class="modal fade forget-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Recovery password</h4>
			</div>
			<div class="modal-body">
				<p>Type your email account</p>
				<input type="email" name="recovery-email" id="recovery-email" class="form-control" autocomplete="off">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-custom">Recovery</button>
			</div> -->
		<!-- </div>  --><!-- /.modal-content -->
	<!-- </div> --> <!-- /.modal-dialog -->
<!-- </div>  --><!-- /.modal -->

</body>
</html>