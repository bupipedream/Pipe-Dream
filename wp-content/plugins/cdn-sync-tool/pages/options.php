<div class="wrap">
	<h2>CDN Sync Tool - Options</h2>

	<div id="nav">
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if (!isset($_GET['section']) || $_GET['section'] == 'main') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=main'; ?>">Sync</a>
			<a class="nav-tab <?php if (isset($_GET['section']) && $_GET['section'] == 'cdn') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=cdn'; ?>">CDN Options</a>
			<a class="nav-tab <?php if (isset($_GET['section']) && $_GET['section'] == 'js') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=js'; ?>">JS</a>
			<a class="nav-tab <?php if (isset($_GET['section']) && $_GET['section'] == 'css') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=css'; ?>">CSS</a>
			<a class="nav-tab <?php if (isset($_GET['section']) && $_GET['section'] == 'help') { echo 'nav-tab-active'; } ?>" href="<?php echo CST_URL.'?page=cst&amp;section=help'; ?>">Help</a>
		</h2>
	</div>
<?php
	if (isset($_GET['section']) && $_GET['section'] == 'js') {
		require_once CST_DIR.'pages/options/js.php';
	} else if (isset($_GET['section']) && $_GET['section'] == 'css') { 
		require_once CST_DIR.'pages/options/css.php';
	} else if (isset($_GET['section']) && $_GET['section'] == 'cdn') {
		require_once CST_DIR.'pages/options/cdn.php';
	} else if (isset($_GET['section']) && $_GET['section'] == 'help') {
		require_once CST_DIR.'pages/options/help.php';
	} else {
		require_once CST_DIR.'pages/options/main.php';
	}
?></div>
