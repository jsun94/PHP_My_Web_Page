<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
  <title>Final Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<div class="container">
<div class="admin_login" ALIGN="right">
  <?php
if(!isset($_SESSION['login'])){
  ?>
<a href ="admin_login.php" class="btn btn-info">Admin</a> <a href ="login.php" class="btn btn-primary">Login</a>
<?php
}else{
?>
<a href ="content.php" class="btn btn-info">My page</a> <a href ="logout.php" class="btn btn-primary">Logout</a>
<?php
}
?>
</div>
<hr>
<div class="container">
  <div class = "page-header">
      <h1>먹라이프</h1>
    </div>
  <div class="row">
    <div class="btn-group pull-right">
      <a href="write.php" class="btn btn-primary btn-sm">Write a review</a>
      <a href="add.php" class="btn btn-primary btn-sm">+ Add new restaurants</a> 
    </div>
  </div>
  <br>
  <div class="row">
      <!-- BEGIN PRODUCTS -->
        <?php
        $con = mysqli_connect('localhost', 'root', '123123', 'final_db');
        $query = "SELECT * FROM restaurants ORDER BY id ASC";
        $result = mysqli_query($con,$query);
        while ( $row =mysqli_fetch_array($result)) {
          $id =$row[0];
          $r_img = $row[1];
          $r_data = $row[2];
          $r_name = $row[3];
          $type = $row[4];
          $address = $row[5];
          $phone = $row[6];
  ?>
  <div class="col-md-3 col-sm-6">
  <form method="post" action="detail.php?action=add&id=<?php echo $row["id"]; ?> ">
  <div class="thumbnail">
    <!-- <img src="/serverweb/img/1.jpg" width="500" height="400"> -->
    <?php
    echo "<img src='data:image/jpeg;base64," . base64_encode($r_data) . "' style='height:200px; width:100%;overflow:hidden;' class='img-responsive' />";
    ?>
            <h4><?= $r_name ?></h4>
            <!-- <div class="ratings">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div> -->
            <p><?= $type ?><br>
               <?= $address ?>
            </p>
            <hr>
            <input type="submit" name="detail" style="margin-top:5px;" class="btn btn-success btn-block" value="SHOW"/>
        </div>
      </div>
    </form>
      <?php
    }
  ?>  
  </div>
  <div class="row" align="center">
    <a href="board.php" class="btn btn-default">Show All Reviews </a>
  </div>
</div>
</body>
</html>