<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
//do_action( 'woocommerce_account_navigation' ); 

?>

<div class="woocommerce-MyAccount-content">
	<?php
		//do_action( 'woocommerce_account_content' );

    $woo_countries = new WC_Countries();
    $default_country = $woo_countries->get_base_country();
    $states = $woo_countries->get_states( $default_country );

    global $current_user;

    $fullname   = trim(get_user_meta($current_user->ID, 'first_name', true ) . " " . get_user_meta($current_user->ID, 'last_name', true ));
    $name       = empty($fullname)? $current_user->data->user_login : $fullname;
    $email      = $current_user->data->user_email;
    $phone      = get_user_meta($current_user->ID, 'billing_phone', true );
    $addr       = get_user_meta($current_user->ID, 'billing_address_1', true );

    $billing_address_1  = get_user_meta($current_user->ID, 'billing_address_1', true );
    $billing_address_2  = get_user_meta($current_user->ID, 'billing_address_2', true );
    $billing_city       = get_user_meta($current_user->ID, 'billing_city', true );
    $billing_state      = get_user_meta($current_user->ID, 'billing_state', true );
    $billing_postcode   = get_user_meta($current_user->ID, 'billing_postcode', true );

    $billing_address = "";
    $billing_address .= empty($billing_address_1)? "" : $billing_address_1;
    $billing_address .= empty($billing_address_2)? "" : "$billing_address_2";
    $billing_address .= empty($billing_city)? "" : ", $billing_city, ";
    $billing_address .= "<BR>";
    $billing_address .= empty($billing_state)? "" : $states[$billing_state];


    $shipping_address_1  = get_user_meta($current_user->ID, 'shipping_address_1', true );
    $shipping_address_2  = get_user_meta($current_user->ID, 'shipping_address_2', true );
    $shipping_city       = get_user_meta($current_user->ID, 'shipping_city', true );
    $shipping_state      = get_user_meta($current_user->ID, 'shipping_state', true );
    $shipping_postcode   = get_user_meta($current_user->ID, 'shipping_postcode', true );

    $shipping_address = "";
    $shipping_address .= empty($shipping_address_1)? "" : $shipping_address_1;
    $shipping_address .= empty($shipping_address_2)? "" : "$shipping_address_2";
    $shipping_address .= empty($shipping_city)? "" : ", $shipping_city, ";
    $shipping_address .= "<BR>";
    $shipping_address .= empty($shipping_state)? "" : $states[$shipping_state];

    
    $customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
      'numberposts' => $order_count,
      'meta_key'    => '_customer_user',
      'meta_value'  => get_current_user_id(),
      'post_type'   => wc_get_order_types( 'view-orders' ),
      'post_status' => array_keys( wc_get_order_statuses() )
    )));

	?>

  
  <h4>Hello <i><?=$name?></i>, consectetur adipiscing elit. Donec tempus turpis felis, el porttitor purus blandit in. Integer sodales varius neque, ac ornare elit molestie eget. <a href="/my-account/customer-logout/">SIGN OUT</a> from this account,</h4>

  <div class="simple-profile">
    <div><?=$name?></div>
    <div>

      <? if(!empty($email)): ?>
      <span><?=$email?></span>
      <? endif; ?>

      <? if(!empty($phone)): ?>
      <span><?=$phone?></span>
      <? endif; ?>

      <? if(!empty($addr)): ?>
      <span><?=$addr?></span>
      <? endif; ?>

    </div>
    <a id="edit-simple-profile" href="/my-account/edit-account/"><i class="fa fa-pencil" aria-hidden="true"></i></a>
  </div>


  <div class="bill-address">
    <h5>My Billing Address</h5>
    <p>
      <?=$billing_address?>
    </p>
    <h5>My Shipping Address</h5>
    <p>
      <?=$shipping_address?>
    </p>
    <a id="edit-address" href="/my-account/edit-address/"><i class="fa fa-pencil" aria-hidden="true"></i></a>
  </div>

  <div class="my-order">
    <h5>My Orders</h5>
    <table>
      <thead>
        <tr>
          <th>order</th>
          <th>date</th>
          <th>amount</th>
          <th>view &amp; track</th>
        </tr>
      </thead>
      <tbody>
      <? //my-order
      foreach ( $customer_orders as $customer_order ) :
        $order      = wc_get_order( $customer_order );
        $item_count = $order->get_item_count();
      ?>
        <tr>
          <td>
            <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>"><?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?></a>
          </td>
          <td><? echo date( 'Y-m-d', strtotime( $order->order_date ) ); ?></td>
          <td><?php echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); ?></td>
          <td>
            <a href="/my-account/view-order/<?=$order->get_order_number()?>"><i class="fa fa-search" aria-hidden="true"></i></a>
            <!-- <a href="#!"><i class="fa fa-print" aria-hidden="true"></i></a> -->
          </td>
        <tr>
      <? endforeach; ?>
      </tbody>
    </table>
  </div>


</div>

<?
/*
echo "<pre>";
//print_r($current_user);
print_r(get_user_meta($current_user->ID));
echo "</pre>";
*/