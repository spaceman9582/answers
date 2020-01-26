<?php defined( 'THUMBSUP_DOCROOT' ) or exit( 'No direct script access.' ) ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"//www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="//www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars( $pagetitle ) ?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo THUMBSUP_WEBROOT . 'thumbsup/admin/css/admin.css' ?>" media="screen" />

	<script type="text/javascript">document.documentElement.className = 'js';</script>

</head>
<body>

	<div id="header">
		<h1><a href="<?php echo THUMBSUP_WEBROOT . 'thumbsup/admin/' ?>">ThumbsUp Admin</a></h1>
		<p>
			<?php if ( ThumbsUp_Admin::is_logged_in() ) { ?>
				You are logged in as <strong><?php echo htmlspecialchars( $_SESSION['thumbsup_admin'] ) ?></strong> •
				<a href="?action=logout">Logout</a>
			<?php } else { ?>
				You are not logged in
			<?php } ?>
		</p>
	</div>

	<div id="content">
		<?php if ( ! empty( $error ) ) { ?>
			<p class="alert"><strong>
				<?php echo htmlspecialchars( $error ) ?>
				<a class="cancel" href="#">cancel</a>
			</strong></p>
		<?php } ?>

		<?php echo $content ?>
	</div>

	<div id="footer">
		<p id="copyright">
			<a href="//themeforest.net/?ref=GeertDD">ThumbsUp</a> • Copyright ©2009<br />
			By <a href="//themeforest.net/user/GeertDD?ref=GeertDD">Geert De Deckere</a>
		</p>
		<p id="back2site">
			<a href="<?php echo THUMBSUP_WEBROOT ?>">Back to the website</a>
		</p>
	</div>

	<script type="text/javascript" src="<?php echo THUMBSUP_WEBROOT . 'thumbsup/admin/javascript/jquery-1.3.2.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo THUMBSUP_WEBROOT . 'thumbsup/admin/javascript/jquery-admin.js.php' ?>"></script>

</body>
</html>
