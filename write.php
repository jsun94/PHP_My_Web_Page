<!DOCTYPE html>
<html>
<head>
<title> Write </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['login'])) {
	header("Location:login.php");
}
$con = mysqli_connect('localhost', 'root', '123123', 'final_db');

$username = $_SESSION['login'];

$query = "SELECT nickname FROM users WHERE username = '$username' ";
$result = mysqli_query($con, $query);
$row =mysqli_fetch_array($result);
$nickname = $row[0];	
?>
<div class="container"> 
    	<div class="row">
    	    <div class='col-md-3'></div>
        <div class="col-md-6">
        	    <div class="form-wrap">
        	    	<div class="page-header">
        	    		<h1>Review</h1>
        	    	</div>
                
                    <form action="write.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="nickname" class="form-control" value="<?php echo $nickname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="restaurant_name">Restaurant's name</label><br>
                            <select name="restaurant_name">
                            	<option value="">(Select a restaurant)</option>
                            	<?php
                            	$query1 = "SELECT * FROM restaurants";
                            	$result1 = mysqli_query($con, $query1);
                            	while ($row1 = mysqli_fetch_array($result1)) {
                            		$name = $row1[3];
                            	?>
                            	<option> <?= $name ?> </option> 
                            	<?php                           		
                            	}
                            	?>					      
				            </select>
                        </div>
                        <div class="form-group">
                            <label for="score">Score</label><br>
                             5 <input type="radio" name="score" value="5"> &nbsp;&nbsp;
                             4 <input type="radio" name="score" value="4"> &nbsp;&nbsp;
                             3 <input type="radio" name="score" value="3"> &nbsp;&nbsp;
                             2 <input type="radio" name="score" value="2"> &nbsp;&nbsp;
                             1 <input type="radio" name="score" value="1">
                            <!-- <input type="text" name="score" class="form-control" placeholder="0~5"> -->
                        </div>
                        
                        <div class="form-group">
                            <label for="recommend">Your Recommend</label>
                            <input type="text" name="recommend" class="form-control" placeholder="Enter your recommended menu">
                        </div>
                        <div class="form-group"> 
                            <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Write">
                        </div>
                       </form>

<?php
if(isset($_POST['submit'])) {
	$nickname = $_POST['nickname'];
	$rest_name = $_POST['restaurant_name'];
	$score = $_POST['score'];
	$recommend = $_POST['recommend'];

	if (empty($_POST['restaurant_name'])) {
		echo "<script> alert('Check the form of Restaurant name')</script>";
	}
	if (empty($_POST['score'])) {
		echo "<script> alert('Check the form of score')</script>";
	}
	if (empty($_POST['recommend'])) {
		echo "<script> alert('Check the form of recommended menu')</script>";
	}

	$query2 = "INSERT INTO reviews VALUES (NULL , '$nickname' , '$rest_name' , '$score' , '$recommend')";
	$result2 = mysqli_query($con, $query2);
	if(!$result2){ 
		echo "Problem in Writing !". mysqli_error($con);
	}else {
		header("Location:board.php");
		?>
		<h2 align="center"> The writing has been successfully registered! </h2>
		<h2 align="center"><a style="text-decoration:none" href="board.php">자유 게시판</a></h2>
<?php
	}
}
?>
</body>
</html>