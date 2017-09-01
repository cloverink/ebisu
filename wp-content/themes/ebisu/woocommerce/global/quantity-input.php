<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$strInputName = esc_attr( $input_name );

?>
<div class="quantity hide">
	<input type="number" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo $strInputName; ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text" size="4" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" />
</div>
<div class="quantity_select" style="">
<select name="<?php echo $strInputName; ?>" class="qty">
<?
  $value = intval(esc_attr( $input_value ));
  $value = empty($value)? "1" : $value;
  for ($i=1; $i <= 10; $i++) { 
    $select = ($i == $value)? "selected" : "";
    echo "<option value='$i' $select>$i</option>";
  }
?>
</select>
</div>
<script>
jQuery(document).ready(function($){
  $("select[name='<?=$strInputName?>']").on("change", function(){
    $("input[name='<?=$strInputName?>']").val($(this).val());
  });

});
</script>