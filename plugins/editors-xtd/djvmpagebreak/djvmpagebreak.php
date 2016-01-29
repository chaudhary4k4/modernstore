<?php
/**
 * @package DJ-VMPagebreak Editor Plugin
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

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Editor Pagebreak buton
 *
 * @package		Joomla.Plugin
 * @subpackage	Editors-xtd.pagebreak
 * @since 1.5
 */
class plgButtonDjvmpagebreak extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * Display the button
	 *
	 * @return array A two element array of (imageName, textToInsert)
	 */
	public function onDisplay($name)
	{
		$app = JFactory::getApplication();
        
		$allowed = array('com_virtuemart.product.edit', 'com_virtuemart.product.add');
        
        $option = JRequest::getVar('option');
        $view = JRequest::getVar('view');
        $task = JRequest::getVar('task');
        
        $context = $option.'.'.$view.'.'.$task;
        
        if (!in_array($context, $allowed)) {
            return null;
        }
        

		$doc = JFactory::getDocument();
		$template = $app->getTemplate();

		$link = 'index.php?option=com_content&amp;view=article&amp;layout=pagebreak&amp;tmpl=component&amp;e_name='.$name;

		JHtml::_('behavior.modal');

		$button = new JObject;
		$button->set('modal', true);
		$button->set('link', $link);
		$button->set('text', JText::_('PLG_EDITORSXTD_DJVMPAGEBREAK_BUTTON_PAGEBREAK'));
		$button->set('name', 'pagebreak');
		$button->set('options', "{handler: 'iframe', size: {x: 400, y: 100}}");

		return $button;
	}
}
