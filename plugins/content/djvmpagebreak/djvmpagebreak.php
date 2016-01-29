<?php
/**
 * @package DJ-VMPagebreak Content Plugin
 * @copyright Copyright (C) 2010 Blue Constant Media LTD, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://design-joomla.eu
 * @author email contact@design-joomla.eu
 * @developer Michal Olczyk - michal.olczyk@design-joomla.eu
 *
 *
 * DJ-VMPagebreak is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-VMPagebreak is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-VMPagebreak. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// No direct access.
defined('_JEXEC') or die ;

jimport('joomla.html.pagination');
jimport('joomla.html.html.sliders');
jimport('joomla.html.html.tabs');

class plgContentDjvmpagebreak extends JPlugin {
    public function __construct(&$subject, $config) {
        parent::__construct($subject, $config);
        $this -> loadLanguage();
    }
    
    // Virtuemart handles plug-ins in Joomla 1.5 manner.
    public function onPrepareContent(&$row, &$params, $page = 0) {
        $option = JRequest::getVar('option');
        $view = JRequest::getVar('view');
        $context = $option . '.' . $view;

        return $this -> onContentPrepare($context, $row, $params, $page);
    }

    public function onContentPrepare($context, &$row, &$params, $page = 0) {
        $allowed = array('com_virtuemart.productdetails');
		$canProceed = false;

        if (in_array($context, $allowed)) {
            $canProceed = true;
        }

        if (!$canProceed) {
            return;
        }
        
        $document = JFactory::getDocument();
        if ($this->params->get('include_css', '0') == '1') {
            $document->addStyleSheet(JURI::base().'plugins/content/djvmpagebreak/css/pagebreak.css');
        }

        $style = $this->params->get('style','tabs');

        // Expression to search for.
        $regex = '#<hr(.*)class="system-pagebreak"(.*)\/>#iU';

        $print = JRequest::getBool('print');
        $showall = JRequest::getBool('showall');

        if ($print) {
            $row -> text = preg_replace($regex, '<br />', $row -> text);
            return true;
        }

        // Simple performance check to determine whether bot should process further.
        if (JString::strpos($row -> text, 'class="system-pagebreak') === false) {
            return true;
        }

        $db = JFactory::getDbo();
        $view = JRequest::getString('view');
        $full = JRequest::getBool('fullview');

        if (!$page) {
            $page = 0;
        }

        // Find all instances of plugin and put in $matches.
        $matches = array();
        preg_match_all($regex, $row -> text, $matches, PREG_SET_ORDER);

        if ($showall) {
            $row -> text = preg_replace($regex, '<br />', $row -> text);
            return true;
        }

        // Split the text around the plugin.
        $text = preg_split($regex, $row -> text);

        // Count the number of pages.
        $n = count($text);

        // We have found at least one plugin, therefore at least 2 pages.
        if ($n > 1) {

            // Reset the text, we already hold it in the $text array.
            $row -> text = '';
            $t[] = $text[0];

            $t[] = (string)JHtml::_($style . '.start');

            foreach ($text as $key => $subtext) {

                if ($key >= 1) {
                    $match = $matches[$key - 1];
                    $match = (array)JUtility::parseAttributes($match[0]);
                    if (isset($match['alt'])) {
                        $title = stripslashes($match["alt"]);
                    } elseif (isset($match['title'])) {
                        $title = stripslashes($match['title']);
                    } else {
                        $title = JText::sprintf('PLG_CONTENT_DJVMPAGEBREAK_TAB_NUM', $key);
                    }
                    $t[] = (string)JHtml::_($style . '.panel', $match['title'], 'basic-details');
                }
                $t[] = (string)$subtext;
            }

            $t[] = (string)JHtml::_($style . '.end');

            $row -> text = implode(' ', $t);
        }
        return true;
    }

}
