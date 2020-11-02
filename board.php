<!DOCTYPE html>
<html>
<head>
<title> Reviews Board </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script>
function showRest(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getrestaurants.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
function showNickname(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint1").innerHTML="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getnickname.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
<?php session_start();
$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
?>
<div class="container-full" align="center">
    <div class="row">
    	    <div class='col-md-1'></div>
        <div class="col-md-10">
        	<div class = "page-header">
        	    	<h1 align="center">  All Reviews List </h1>
        	</div>
        	<div class="row">
        		 <div class="col-md-6">
        		 	<?php
        	        $query1 = "SELECT restaurants_name FROM restaurants";
                    $result1 = mysqli_query($con , $query1)
                    ?>
                    <form>
	                <select name="restaurants" onchange="showRest(this.value)">
	                <option value="">Select a restaurant:</option>
                    <?php
                    while ($row = mysqli_fetch_array($result1)) {
                    	$r_name = $row[0];
            	    ?>
            	    <option><?= $r_name ?></option>
            	    <?php
            	    }
                    ?>
                </select>
            </form>
            <div id="txtHint"><b>All reviews of the restaurant's info will be listed here.</b></div>
        </div>
        <div class="col-md-6">
        	<form> 
        		Nickname: <input type="text" onkeyup="showNickname(this.value)">
        	</form>
        	<div id="txtHint1"><b>All reviews of the user's info will be listed here.</b></div>
        </div>
        </div>
        <div class='col-md-1'></div>
    </div>
</div>
</div>
<hr>
<div class="container" align="center">
	<div class="row">
		<div class='col-md-3'></div>
        <div class="col-md-6">
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
$query = "SELECT * FROM reviews";
$result=mysqli_query($con, $query);
while ( $row =mysqli_fetch_array($result)) {
		$nickname = $row[1];
		$rest_name = $row[2];
		$score = $row[3];
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
?>
        </table>
<hr>
    <div class="row" align="center">
            <a href ="index.php" class="btn btn-default"> Home </a>
	</div>
	<div class='col-md-3'></div>
</div>
</div>
</div>
</body>
</html>