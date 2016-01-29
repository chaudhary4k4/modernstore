<?php defined('_JEXEC') or die('Restricted access');

$related = $viewData['related'];
$customfield = $viewData['customfield'];
$thumb = $viewData['thumb'];
?>

<div class="product">

	<div class="spacer">
		
		<?php if($thumb) : ?>
		<div class="vm-product-media-container">
			
			<?php
			//juri::root() For whatever reason, we used this here, maybe it was for the mails
			echo JHtml::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id), $thumb, array('title' => $related->product_name,'target'=>'_blank'));?>

		</div>
		<?php endif; ?>
		
		<div class="vm-product-content">
		
		<h2><?php echo JHtml::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id), $related->product_name, array('title' => $related->product_name,'target'=>'_blank'));?></h2>
		
		<?php
		if($customfield->wPrice){
			$currency = calculationHelper::getInstance()->_currencyDisplay;
			echo '<div class="product-price">';
			echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $related->prices);
			echo $currency->createPriceDiv ('taxAmount', 'COM_VIRTUEMART_PRODUCT_TAX_AMOUNT', $related->prices);
			echo '</div>';
		}
		if($customfield->wDescr){
			echo '<div class="product_s_desc">'.$related->product_s_desc.'</div>';
		}
		?>
		<div class="vm-details-button">
			<?php // Product Details Button
			$link = empty($related->link)? $related->canonical:$related->link;
			echo JHtml::link($link.$ItemidStr,vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $related->product_name, 'class' => 'product-details' ) );
			//echo JHtml::link ( JRoute::_ ( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id , FALSE), vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );
			?>
		</div>
		</div>
	</div>

</div>