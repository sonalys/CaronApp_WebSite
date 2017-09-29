<?php
include "configs.php";

session_start();


//$user_session = md5(microtime().$_SERVER['REMOTE_ADDR']); // SESSION ID, UNIQUE BY NAVIGATOR

function CheckCookieLogin() {
    $uname = $_COOKIE['uname']; 
    if (!empty($uname)) {   
        $query = "SELECT * FROM `users` WHERE `session`='$uname'";
		$result = mysqli_query($conn, $query);
		if ( mysqli_num_rows($result) > 0 ){
			$_SESSION['logged_in'] = 1;
			$_SESSION['cookie'] = $uname;
			// reset expiry date
			setcookie("uname",$uname,time()+3600*24*365,'/', '.localaddress');
		}
    }
}

$username = "raicon";
$password = "123";

if(!isset($_SESSION['cookie']) && empty($_SESSION['logged_in'])) {
    CheckCookieLogin();
}
else{
$query = "SELECT username, password FROM users WHERE username='".$username."' AND password='".$password."'";
$result = queryData($conn, $query);

if ( mysqli_num_rows($result) > 0 )
	
	$_SESSION['logged_in'] = 1;
	$cookiehash = md5(sha1($username . $_SERVER['REMOTE_ADDR']));
	setcookie("uname",$cookiehash,time()+3600*24*365,'/', '.localaddress');
	$_SESSION['cookie'] = $cookiehash;
	$query = "UPDATE `users` SET `session`='$cookiehash' WHERE `username`='$username'";
	executeData($conn, $query);
}
	
?>
<html> <!-- HTML TAG -->
<link rel="icon" href="favicon.ico" type="image/ico">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" /> <!-- External References -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="background.js"></script>
 <!-- <div class="div_blur"></div>Blurry Background 
<div class="div_overlay"></div>-->
 <!-- Content Start -->
<div class="content">
	<div class="menu_lateral">
		<div class="logo"></div>
		<!--<details><summary>Login</summary>
		<div class="login_panel"></div>
		</details>-->
		<ul class="lista_lateral">
			<li><a href="homepage.php" ondragstart="return false;" target="subpage">Página Inicial</a></li>
			<!--<li><a href="index.php" ondragstart="return false;">Perfil</a></li>-->
			<li><a href="search_carona.php" ondragstart="return false;" target="subpage">Buscar Carona</a></li>
			<li><a href="register_carona.php" ondragstart="return false;" target="subpage">Registrar Carona</a></li>
		</ul>
	</div>
	<iframe src="homepage.php" class="subpage" name="subpage" id="subpage" scrolling="no"></iframe>
</div>
<div class="menu_superior">
	<div class="profile">
		<a class="user_name dropdown_profile"><?php if(isset($_SESSION["logged_in"])) echo $username; else echo "Logue-se"; ?></a>
		<img class="user_icon dropdown_profile" src='https://i.pinimg.com/736x/32/c8/5c/32c85c66e56c16729b04de8e76051d04--anime-boys-anime-manga.jpg'>
		<div class="login_panel"></div>
	</div>
</div>
</html>