<?php/*--------------------------------------------------------------# Copyright (C) joomla-monster.com# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only# Website: http://www.joomla-monster.com# Support: info@joomla-monster.com---------------------------------------------------------------*/defined('_JEXEC') or die;//get template width type$templatewidthtype = $this->params->get('templateWidthType', '0');$fluid = ($templatewidthtype != '0') ? '-fluid' : '';//get logo and site description$logo = htmlspecialchars($this->params->get('logo'));$logotext = htmlspecialchars($this->params->get('logoText'));$sitedescription = htmlspecialchars($this->params->get('siteDescription'));$app = JFactory::getApplication();$sitename = $app->getCfg('sitename');//check modules$logoexist = '';if(($logo != '') or ($logotext != '') or ($sitedescription != '')) {    $logoexist = '1';} else {    $logoexist = '0';}$logobarcount = '';if(($logoexist == '1') and $this->countModules('logo-bar1') and $this->countModules('logo-bar2')) {    $logobarcount = '_3';} else if(($logoexist == '1') and $this->countModules('logo-bar1') and !$this->countModules('logo-bar2')) {    $logobarcount = '_2';} else if(($logoexist == '1') and !$this->countModules('logo-bar1') and $this->countModules('logo-bar2')) {    $logobarcount = '_2';   } else if(($logoexist == '0') and $this->countModules('logo-bar1') and $this->countModules('logo-bar2')) {    $logobarcount = '_2';   } else if(($logoexist == '1') and !$this->countModules('logo-bar1') and !$this->countModules('logo-bar2')) {    $logobarcount = '_1';   } else if(($logoexist == '0') and !$this->countModules('logo-bar1') and $this->countModules('logo-bar2')) {    $logobarcount = '_1';   } else if(($logoexist == '0') and $this->countModules('logo-bar1') and !$this->countModules('logo-bar2')) {    $logobarcount = '_1';} else {    $logobarcount = '_0';}   ?><?php if(($logo != '') or ($logotext != '') or ($sitedescription != '') or $this->countModules('logo-bar1') or $this->countModules('logo-bar2')) : ?><section id="jm-logo-bar" class="count<?php echo $logobarcount; ?>">    <div id="jm-logo-bar-in" class="container<?php echo $fluid ?>">        <div id="jm-logo-bar-space" class="clearfix">            <div class="row">                <?php if (($logo != '') or ($logotext != '') or ($sitedescription != '')) : ?>                <div id="jm-logo-sitedesc">                    <?php if (($logo != '') or ($logotext != '')) : ?>                    <h1 id="jm-logo">                        <a href="<?php echo JURI::base(); ?>" onfocus="blur()" >                            <?php if ($logo != '') : ?>                            <img src="<?php echo JURI::base(), $logo; ?>" alt="<?php if(!$logotext) { echo $sitename; } else { echo $logotext; }; ?>" border="0" />                            <?php else : ?>                            <?php echo '<span>'.$logotext.'</span>';?>                            <?php endif; ?>                        </a>                    </h1>                    <?php endif; ?>                    <?php if ($sitedescription != '') : ?>                    <div id="jm-sitedesc">                        <?php echo $sitedescription; ?>                    </div>                    <?php endif; ?>                </div>                <?php endif; ?>                <?php if($this->countModules('logo-bar1')) : ?>                <div id="jm-logo-bar1">                    <jdoc:include type="modules" name="logo-bar1" style="jmmoduleraw" />                </div>                <?php endif; ?>                 <?php if($this->countModules('logo-bar2')) : ?>                <div id="jm-logo-bar2">                    <jdoc:include type="modules" name="logo-bar2" style="jmmoduleraw" />                </div>                <?php endif; ?>            </div>        </div>    </div>             </section><?php endif; ?>