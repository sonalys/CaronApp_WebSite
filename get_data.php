<?php
 $Origem = htmlspecialchars($_POST['Origem']);
 $WayPts = htmlspecialchars($_POST['Waypts']);
 $Destino = htmlspecialchars($_POST['Destino']);
 if(isset($_COOKIE['uname'])) 
	echo $WayPts;
 else
	die;
 
?>