<?php // no direct access
defined('_JEXEC') or die('Restricted access');
vmJsApi::jPrice();
?>
<div class="vmgroup<?php echo $params->get( 'moduleclass_sfx' ) ?>">

<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
<?php } ?>

<div class="vmproduct single <?php echo $params -> get('moduleclass_sfx'); ?>">
<?php foreach ($products as $product) { ?>
	<div><div class="spacer"><div>
<?php echo '<div class="vm-product-media-container">';
if (!empty($product -> images[0]))
	$image = $product -> images[0] -> displayMediaThumb('class="featuredProductImage" ', false);
else
	$image = '';
echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product -> virtuemart_product_id . '&virtuemart_category_id=' . $product -> virtuemart_category_id), $image, array('title' => $product -> product_name));
echo '</div>';
$url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product -> virtuemart_product_id . '&virtuemart_category_id=' . $product -> virtuemart_category_id);
 ?>		
<div class="vm-product-content">	
<div class="slide-box">	
<h3><a href="<?php echo $url ?>"><?php echo $product->product_name ?></a></h3>
<?php
// $product->prices is not set when show_prices in config is unchecked
if ($show_price and isset($product -> prices)) {
	echo '<div class="product-price">';
	// 		echo $currency->priceDisplay($product->prices['salesPrice']);
	if (!empty($product -> prices['salesPrice'])) {
		echo $currency -> createPriceDiv('salesPrice', '', $product -> prices, FALSE, FALSE, 1.0, TRUE);
	}
	// 		if ($product->prices['salesPriceWithDiscount']>0) echo $currency->priceDisplay($product->prices['salesPriceWithDiscount']);
	// if (!empty($product->prices['salesPriceWithDiscount']) ) echo $currency->createPriceDiv('salesPriceWithDiscount','',$product->prices,true);
	echo '</div>';
}
if ($show_addtocart)
	echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product));
 ?>
 </div></div></div></div></div>

	<?php } ?>
<?php if ($footerText) { ?>
	<div class="vmheader"><?php echo $footerText ?></div>
<?php } ?>
</div>