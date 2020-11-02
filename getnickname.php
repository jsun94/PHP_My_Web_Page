<!DOCTYPE html>
<html>
<head>
	<title>Get Restaurants</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$q = $_GET['q'];
$con = mysqli_connect('localhost','root','123123','final_db');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM reviews WHERE nickname = '".$q."'";

$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) == 0) {
    echo "Check the nickname again!";
}
?>
<table class='table table-condensed'>
<thead>
	<tr>
		<th class="text-center">닉네임</th>
        <th class="text-center">맛집명</th>
        <th class="text-center">점수</th>
        <th class="text-center">추천메뉴</th>
    </tr>
</thead>
</tr>
<?php
while($row = mysqli_fetch_array($result))
  {
  echo "<tr align = 'center'>";
  echo "<td>" . $row['nickname'] . "</td>";
  echo "<td>" . $row['restaurant_name'] . "</td>";
  echo "<td>" . $row['score'] . "</td>";
  echo "<td>" . $row['recommend'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?>
</body>
</html>