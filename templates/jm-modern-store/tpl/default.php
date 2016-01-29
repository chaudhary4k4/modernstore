<?php
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $direction; ?>">
	<?php $this->renderBlock('head'); ?>
	<body>
		<div id="jm-allpage" class="<?php echo $currentscheme.' '.$schemeoption.' '.$responsiveoff; ?>">
			<?php $this->renderBlock('topbar'); ?>
			<?php $this->renderBlock('logobar'); ?>
			<?php $this->renderBlock('djmenu'); ?>
			<?php $this->renderBlock('header'); ?>
			<?php $this->renderBlock('content'); ?>
			<?php $this->renderBlock('bottom1'); ?>
			<?php $this->renderBlock('bottom2'); ?>
			<?php $this->renderBlock('footer-mod'); ?>
			<?php $this->renderBlock('footer'); ?>
	</body>
</html>