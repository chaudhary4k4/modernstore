<?php
/*--------------------------------------------------------------
# Copyright (C) joomla-monster.com
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Website: http://www.joomla-monster.com
# Support: info@joomla-monster.com
---------------------------------------------------------------*/

defined('_JEXEC') or die;

//get template width type
$templatewidthtype = $this->params->get('templateWidthType', '0');
$fluid = ($templatewidthtype != '0') ? '-fluid' : '';

?>

<?php if ($this->countModules('bottom0') or $this->countModules('bottom1')) : ?>
<section id="jm-bottom1">
    <?php if ($this->countModules('bottom0')) : ?>
    <div id="jm-bottom0">
        <jdoc:include type="modules" name="bottom0" style="jmmodule2"/>
    </div>
    <?php endif; ?>
    <?php if ($this->countModules('bottom1')) : ?>
    <div id="jm-bottom1-in" class="container<?php echo $fluid ?>">
        <div id="jm-bottom1-space">
            <?php echo DJModuleHelper::renderModules('bottom1','jmmodule', $fluid); ?>
        </div>     
    </div>
    <?php endif; ?>
</section>
<?php endif; ?>