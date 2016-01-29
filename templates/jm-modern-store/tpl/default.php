<?php/*--------------------------------------------------------------# Copyright (C) joomla-monster.com# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only# Website: http://www.joomla-monster.com# Support: info@joomla-monster.com---------------------------------------------------------------*/ defined('_JEXEC') or die;// get direction$direction = $this->params->get('direction', 'ltr');// get scheme option$schemeoption = $this->params->get('schemeOption', 'lcr');$currentscheme = $this->params->get('currentScheme');//check modulesif($this->params->get('responsiveLayout')!='0') { $responsiveoff = ''; } else { $responsiveoff = 'responsiveoff'; };?>
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
			<?php $this->renderBlock('footer'); ?>		</div>
	</body>
</html>