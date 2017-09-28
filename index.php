<?php

?>
<html> <!-- HTML TAG -->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" /> <!-- External References -->
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
		<a class="user_name dropdown_profile">Alysson Ribeiro</a>
		<img class="user_icon dropdown_profile" src='https://i.pinimg.com/736x/32/c8/5c/32c85c66e56c16729b04de8e76051d04--anime-boys-anime-manga.jpg'>
		<div class="login_panel"></div>
	</div>
</div>
</html>