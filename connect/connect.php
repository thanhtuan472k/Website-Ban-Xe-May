<?php	
	$con=mysqli_connect('localhost','root','','xemay');
	mysqli_set_charset($con,'utf8');
	if(!$con){
		echo "Không thể kết nối đến Database!".mysqli_connect_error($con);
	}
?>