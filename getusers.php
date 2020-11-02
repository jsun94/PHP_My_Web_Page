<!DOCTYPE html>
<html>
<head>
	<title>Get Users</title>
</head>
<body>
	<?php
	$con = mysqli_connect('localhost','root','123123','final_db');
	if (!$con)
	{
		die('Could not connect: ' . mysqli_error($con));
	}
//mysqli_select_db($con,"ajax_demo");
	$sql="SELECT username FROM users";
	$result = mysqli_query($con,$sql);
	while ( $row =mysqli_fetch_array($result)) {
		$a[] = $row[0];
    }
    // get the q parameter from URL
    $q=$_REQUEST["q"]; $hint="";
    // lookup all hints from array if $q is different from "" 
    if ($q !== "")
    	{ $q=strtolower($q); $len=strlen($q);
    		foreach($a as $name)
    			{ if (stristr($q, substr($name,0,$len)))
    				{ if ($hint==="")
    				{ $hint=$name; }
    				else
    					{ $hint .= ", $name"; }
    			}
    		}
    	}
    	// Output "no suggestion" if no hint were found
    	// or output the correct values 
    	echo $hint==="" ? "no suggestion" : $hint;
    	?>

</body>
</html>