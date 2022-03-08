<html>
<head>
<title>form</title>
</head>
<body>
<?php
	

	$e=$_REQUEST["email"];
	$n=$_REQUEST["nome"];
	$tel=$_REQUEST["telefono"];
	$p=$_REQUEST["password"];
	echo $e;
	echo $x;
	echo $n1;
	echo $y;
	echo $n2."<br>";
	
	if($x==2 && $y==1 && $n!=0 && $n1!=0 && $n2!=0){
	$delta=($n1*$n1)+(4*$n*$n2);
	$delta=sqrt($delta);
	$x1=(($n1*-1)+$delta)/2*$n;	
	$x2=(($n1*-1)+$delta)/2*$n;
	echo "<br>x1 = ".$x1."x2 = ".$x2."<br>";
	}
	else{
		//echo "<meta http-equiv=\"refresh\" target=\"_blank\" content=\"0.1;URL=aidme.tk/login.html\">";
		//echo "<h1><center><span style=\"color: #ff0000;\">ERROR</span></center></h1>";	
	}
	
?>
</body>
</html>
