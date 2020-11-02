<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost','root','123123','final_db');
if( isset($_POST['submit']) ) {
	$rest_name = $_POST['restaurants_name'];
	$type = $_POST['type'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$file = $_FILES['image']['tmp_name'];
	
	if( empty($_POST['restaurants_name']) || empty($_POST['type']) || empty($_POST['address']) || empty($_POST['phone']) || !isset($file) ) {
		echo "<script> alert('Check your form again') </script>";
	}
	else {
		$query = "SELECT * FROM restaurants 
				  WHERE restaurants_name='$rest_name' AND type = '$type'";

		$result = mysqli_query($con, $query);
		
		if( mysqli_num_rows($result) > 0) {
			header("Location:registeration.php?MSG=Already exist, Please use another one!!");
		}else {
			$image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
            $image_size = getimagesize($_FILES['image']['tmp_name']);
            
            if($image_size == FALSE) {
            echo "That's not an image.";
            }else{
                $query = "INSERT INTO restaurants
					  VALUES (NULL , '$image_name' , '$image_data' , '$rest_name', '$type', '$address' , '$phone')";
			    if (mysqli_query($con, $query) ) {
				    //$_SESSION['login'] = $username;
                    $_SESSION['image'] = $image_name;
                    //$_SESSION['nickname'] = $nickname;
				    header("Location:index.php");
			    }else{
				echo "wrong!!";
			    }
		    }
        }	
	}
}
?>
<html>
<head>
	<title>Add a restaurant</title>
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
        	    		<h1>Add a restaurant</h1>
        	    	</div>
                
                    <form action="add.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="restaurants_name">Restaurant's Name</label>
                            <input type="text" name="restaurants_name" class="form-control" placeholder="Enter a restaurant name">
                        </div>
                        <div class="form-group">
                            <label for="type">Restaurant's Type</label>
                            <input type="text" name="type" class="form-control" placeholder="Enter a type of the restaurant">
                        </div>
                        <div class="form-group">
                            <label for="address">Restaurant's Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter a address of the restaurant">
                        </div>
                        
                        <div class="form-group">
                            <label for="nickname">Restaurant's Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter a phone number of the restaurant ">
                        </div>
                        <div class="form-group">
                            <label for="image">Restaurant's Front Image</label>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group"> 
                            <input type="submit" class="btn btn-primary btn-block m-t-md" name="submit" value="Register">
                        </div>
                       </form>
                        </div>
    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    	<div class='col-md-3'></div>
    </div>
    </div> <!-- /.container -->
</body>
</html>