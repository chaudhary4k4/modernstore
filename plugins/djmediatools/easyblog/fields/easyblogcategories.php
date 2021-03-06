<?php
/**
 * @version $Id: easyblogcategories.php 33 2014-04-28 11:19:14Z szymon $
 * @package DJ-Suggester
 * @copyright Copyright (C) 2012 DJ-Extensions.com LTD, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Szymon Woronowski - szymon.woronowski@design-joomla.eu
 *
 * DJ-Suggester is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-Suggester is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-Suggester. If not, see <http://www.gnu.org/licenses/>.
 *
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldEasyblogCategories extends JFormField
{
	protected $type = 'EasyblogCategories';

	protected function getInput()
	{
		if(!JFile::exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php')){
			return JText::_('PLG_DJMEDIATOOLS_EASYBLOG_COMPONENT_DISABLED');
		}
		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php' );
		require_once( EBLOG_HELPERS . DIRECTORY_SEPARATOR  . 'helper.php' );

		$mainframe	= JFactory::getApplication();
		$db			= EasyBlogHelper::db();
		$doc 		= JFactory::getDocument();

		JFactory::getLanguage()->load( 'com_easyblog' , JPATH_ROOT );

		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'categories.php' );
		$model		= new EasyBlogModelCategories();
		$categories	= $model->getAllCategories();

		if( !is_array( $this->value ) )
		{
			$this->value	= array( $this->value );
		}

		ob_start();
		?>
		<select name="<?php echo $this->name;?>[]" multiple="multiple" style="width:220px;height:200px;" class="<?php echo $this->element['class'];?>">
		<?php $selected	= in_array( 'all' , $this->value ) ? ' selected="selected"' : ''; ?>
		<option value="all"<?php echo $selected;?>><?php echo JText::_('COM_EASYBLOG_ALL_CATEGORIES'); ?></option>
		<?php		
		foreach($categories as $category)
		{
			$selected	= in_array( $category->id , $this->value ) ? ' selected="selected"' : '';
		?>
			<option value="<?php echo $category->id;?>"<?php echo $selected;?>><?php echo $category->title;?></option>
		<?php
		}
		?>
		</select>
		<?php
		$html	= ob_get_contents();
		ob_end_clean();
		
		return $html;
	}

}
