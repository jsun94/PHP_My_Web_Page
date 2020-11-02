<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" align="center">
    <div class="row">
    	    <div class='col-md-3'></div>
        <div class="col-md-6">
        	<div class = "page-header">
        	    	<h1 align="center"> Users List </h1>
        	</div>
        	<table class="table table-striped custab">
        		<thead>
        			<tr>
                        <th class="text-center">이름</th>
                        <th class="text-center">비밀번호</th>
                        <th class="text-center">이메일</th>
                        <th class="text-center">닉네임</th>
                        <th class="text-center">수정/삭제</th>
                    </tr>
                </thead>
            
	<?php
	$con = mysqli_connect('localhost', 'root', '123123', 'final_db');
	$query = "SELECT * FROM users";
	$result = mysqli_query($con,$query);
	
	while ( $row =mysqli_fetch_array($result)) {
		$id = $row[0];
		$name = $row[3];
		$password = $row[4];
		$email = $row[5];
		$nickname = $row[6];
	?>
	         <tr>
                <td class="text-center"><?= $name ?></td>
                <td class="text-center"><?= $password ?></td>
                <td class="text-center"> <?= $email ?> </td>
                <td class="text-center"> <?= $nickname ?> </td>
                <td class="text-center"> <a href="revise.php?rev=<?=$name?>" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                	<a href="delete.php?del=<?=$id?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
            </tr>
	<?php
	}
	?>
	  </table>
	  <a href ="index.php" class="btn btn-default"> Home </a>
	</div>
	<div class='col-md-3'></div>
</div>
</div>
</body>
</html>