<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
$num = $_GET['id'];
?>
<html>
<head>
	<title>Restaurant Detail</title>
	<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		$query2 = "SELECT * FROM restaurants WHERE id= '$num' ";
		$result2 = mysqli_query($con,$query2);
        if ($result2) {
          while ( $row =mysqli_fetch_array($result2)) {
          $r_data = $row[2];
          $r_name = $row[3];
          $type = $row[4];
          $address = $row[5];
          $phone = $row[6];
	?>
	 <div class="container"> 
    	<div class="row">
    		<div class="page-header" align="center">
                <div align="center">
        	    <?php
                    echo "<img src='data:image/jpeg;base64," . base64_encode($r_data) . "' width='300' />";
                    //echo "<br>";
                ?>
                </div>
                <h2><mark><?= $r_name ?></mark></h2>
                <p class="text-muted"><?= $type ?></p>
                <p><span class="glyphicon glyphicon-map-marker"> </span> <?= $address ?> <br>
                   <span class="glyphicon glyphicon-earphone"> </span> <?= $phone ?>
                </p>
        	 </div>
             <?php
                    }
                } 
            ?>
    	    <div class='col-md-2'></div>
    	    <div class="col-md-8">
        	    <div class="form-wrap">
        	    	<table class="table table-striped custab">
                <thead>
                    <tr>
                        <th class="text-center">닉네임</th>
                        <th class="text-center">맛집명</th>
                        <th class="text-center">점수</th>
                        <th class="text-center">추천메뉴</th>
                    </tr>
                </thead>
<?php
$query = "SELECT * FROM reviews WHERE restaurant_name = '$r_name'";
$result=mysqli_query($con, $query);
$count = 0;
$sum = 0;
$avg = 0;
while ( $row =mysqli_fetch_array($result)) {
        $a[] = $row[0];
        $nickname = $row[1];
        $rest_name = $row[2];
        $score = $row[3];
        $sum += $score;
        $recommend = $row[4];
    ?>
             <tr align="center">
                <td><?= $nickname ?></td>
                <td><?= $rest_name ?></td>
                <td><?= $score ?></td>
                <td> <?= $recommend ?> </td>
            </tr>
    <?php
    }
    if (isset($a)) {
        $count = count($a);
        $avg = $sum / $count;
    }
    //$count = count($a);
    //$avg = $sum / $count;
    ?>
        </table>
        	    </div>
                <div class="text-right">        	    	
        	    	<b><p class="text-info">평균 점수 : <?= $avg ?> (<?= $count ?>명 참여)</p></b>
                </div>
        	    </div>
                
        	    </div> 
        <div class="row" align="center">
        	<a href ="index.php" class="btn btn-default center"> Home </a>
        </div>
        <div class='col-md-2'></div>
        	</div>
</body>
</html>