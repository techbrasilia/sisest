<?php // header("Content-Type: text/html; charset=UTF-8"); ?>
<nav class="navbar navbar-static" style="background: #cccccc;">
	<div class="container">
		<div class="nav-collapse collase">
			<?php if( isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'admin' ):?>
			<ul class="nav navbar-nav">
				<li><a href="index.php" style="color: #FFFFFF; font-size: 16px;">Início</a></li>
				<li><a href="index.php?cod=usuario" style="color: #FFFFFF; font-size: 16px;">Usuário</a></li>
				<li><a href="#" style="color: #FFFFFF; font-size: 16px;" ></a></li>
				<li><a href="Logout.php" style="color: #FFFFFF; font-size: 16px;" ></a></li>
				
			</ul>
			<?php endif;?>
		</div>
	</div>
</nav>