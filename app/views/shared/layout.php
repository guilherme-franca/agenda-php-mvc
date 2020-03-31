<?php include_once 'config/config.php'; use \app\core\Page; ?>
<!DOCTYPE html>
<html ng-app lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title><?php echo Page::$title; ?> - Agenda </title>
		<link rel="shortcut icon" href="<?php echo IMG; ?>favicon.ico">
		<link rel="stylesheet" href="<?php echo APP_PATH.DS; ?>vendor/semantic/ui/dist/semantic.css">
		<link rel="stylesheet" href="<?php echo CSS; ?>style.css">
		
		<script src="<?php echo JS; ?>jquery.min.js"></script>
		
	</head>
	<body id="<?php echo Page::$menu; ?>" class="body-page">
		<!-- HEADER -->
		<header class="header-page">
			<div class="img-logo">
				<img src="<?php echo IMG; ?>agenda-logo.png" alt="Logo Agenda">
			</div>
			<nav class="menu">
				<a href="<?php echo APP_PATH.DS; ?>"         class="menu-item <?php if (Page::$menu == 'home') {echo 'active';} ?>">Home</a>
				<a href="<?php echo APP_PATH.DS; ?>events"   class="menu-item <?php if (Page::$menu == 'events') {echo 'active';} ?>">Eventos</a>
				<a href="<?php echo APP_PATH.DS; ?>contacts" class="menu-item <?php if (Page::$menu == 'contacts') {echo 'active';} ?>">Contatos</a>
			</nav>
		</header>
		<!-- MAIN  -->
		<main class="main-page">

			<?php echo Page::view(); ?>

		</main>
		<!-- FOOTER -->
		<footer class="footer-page">

			<p><?php echo date('Y'); ?>  <i class="copyright icon"></i> Todos os direitos reservados.</p>

		</footer>

		
		<script src="<?php echo APP_PATH.DS; ?>vendor/semantic/ui/dist/semantic.js"></script>
		
		<script src="<?php echo JS; ?>input-file.js"></script>
		<script src="<?php echo JS; ?>functions.js"></script>
	</body>
</html>