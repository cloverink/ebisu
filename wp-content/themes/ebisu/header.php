<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(array('ebisu')); ?>>

<div class="topnav">
  <div class="col-full">

    <div class="dd pull-left">
      <label>english</label>
      <dd>
        <a>english</a>
        <a lang="th">ไทย</a>
      </dd>
    </div>
    
    <div class="dd pull-left">
      <label>thb</label>
      <dd>
        <a>thb</a>
        <a>usd</a>
      </dd>
    </div>

    <label class="label pull-left">
      <?php echo $GLOBALS['cgv']['topmenu_ebisu_phone'] ?>
    </label>

    <? if(is_user_logged_in()) : ?>
      <a href="/my-account" class="lnk pull-right">My Account</a>
      <a href="/my-account/customer-logout/" class="lnk pull-right logout">Logout</a>
    <? else: ?>
      <a id="lnkRegister" href="/my-account" class="lnk pull-right">Register</a>
      <a id="lnkLogin" href="/my-account" class="lnk pull-right">Login</a>
    <? endif; ?>
  
  </div>
</div>

<div class="tophead">
  <div class="col-full">
    <div class="row">
      <h1>
      <?
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $ebisu_logo = wp_get_attachment_image_src( $custom_logo_id, 'full', false, array(
          'class'    => 'custom-logo',
          'itemprop' => 'logo',
        ));
      ?>
      <a href="/" style="background-image:url(<?=$ebisu_logo[0]?>)"></a>
      </h1>
      <?=wp_nav_menu(array('menu'=>'TOP_MENU'));?>
      <div class="menu-search-cart">
        <input id="txtSearch" type="text" placeholder="Search">
        <a id="linkSearchButton" href="#search"><i class="fa fa-search" aria-hidden="true"></i></a>        
        <a href="/cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
      </div>
      <script>
      jQuery(document).ready(function($){
        $("#linkSearchButton").on("click", function(){
          if($("#txtSearch").hasClass("actived")) {
            var searchtext = $("#txtSearch").val();
            window.location.href = "/?s="+ searchtext +"&post_type=product";
          } else {
            $("#txtSearch").addClass("actived");
          }
        });
        $("#txtSearch").on('keypress', function (e) {
          if(e.which === 13){
            var searchtext = $("#txtSearch").val();
            window.location.href = "/?s="+ searchtext +"&post_type=product";
          }
        });
      });
      </script>
    </div>
  </div>
</div>
<div class="tophead mega">
  <div class="col-full">
    <div class="row">
      <?=wp_nav_menu(array('menu'=>'MEGA_MENU', 'depth' => 3));?>
    </div>
  </div>
</div>



<div id="page" class="hfeed site">

	<?php do_action( 'storefront_before_header' ); ?>

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">


		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );
