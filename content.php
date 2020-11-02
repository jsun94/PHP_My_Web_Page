<?php
session_start();
$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
$name = $_SESSION['login'];
$query = "SELECT * FROM users WHERE username= '$name' ";
if(!isset($_SESSION['login'])) {
	header("Location:login.php");
}

?>
<html>
<head>
<title> Content Page </title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container"> 
    	<div class="row">
    	    <div class='col-md-2'></div>
    	    <div class="col-md-8" align="center">
        	    <div class="form-wrap">
        	    	<div class="page-header">
        	    		<h1> Welcome <?=$_SESSION['login']?></h1>
        	    	</div>
                    <div class="row">
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                    <div class="well" align="text-center">
        	    	<?php
        	    	$result = mysqli_query($con, $query);
        	    	if($result){
        	    		while($row = mysqli_fetch_array($result))
        	    		{
        	    			echo "<img src='data:image/jpeg;base64," . base64_encode($row['user_data']) . "' width='250' height='200' />";
        	    			echo "<br><br>";

        	    			echo "<h4>Name : " . $row['username'] . "</h4>";
        	    		
        	    			echo "<h4>Password : " . $row['password'] . "</h4>";
        	    			echo "<h4>E-mail : " . $row['useremail'] . "</h4>";
        	    			echo "<h4>Nickname : " . $row['nickname'] ."</h4>";
        	    			echo "<br>";
        	    	?>
                    <br>
                    <div class="row" align="center">
                    <div class="btn-group">
                        <a href="update.php?rev=<?=$row['username']?>" class="btn btn-default btn-sm">Profile Edit</a>
                        <a href="logout.php" class="btn btn-default btn-sm">Logout </a>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                    <?php
                        }
        	    	?>        	    	
        	        <?php
        	    	}
        	    	?>
        	    	<hr>
        	    	<div class="row" align="center">
        	    		<a href="index.php" class="btn btn-default" > Home </a>
        	    	</div>
        	    </div>
        	</div>
    		<div class='col-md-2'></div>
    	</div>
		
	</body>
</html>