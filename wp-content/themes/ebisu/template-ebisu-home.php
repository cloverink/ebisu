<?php
/**
 *
 * Template name: Ebisu Home
 *
 */
get_header();?> 

<? /* mega slider */
echo do_shortcode("[metaslider id=121]"); 
?> 

<? /* OUR PRODUCTS Section */
$our_products_title     = get_field('our_products_title');
$our_products_subtitle  = get_field('our_products_subtitle');
?>
<div class="home-section our-products col-full">
  <h2 class="title"><?=$our_products_title?></h2>
  <p class="subtitle"><?=$our_products_subtitle?></p>
  <?=wp_nav_menu(array('menu' => 'MEGA_MENU', 'depth' => 1 ));?>
  <? do_action( 'ebisu_section_our_products' ) ?>
</div>

<? /* mega slider */
echo do_shortcode("[metaslider id=163]"); 
?> 


<? /* BEST SELLER Section */
$best_seller_title     = get_field('best_seller_title');
$best_seller_subtitle  = get_field('best_seller_subtitle');
?>

<div class="home-section best-seller col-full">
  <h2 class="title"><?=$best_seller_title?></h2>
  <p class="subtitle"><?=$best_seller_subtitle?></p>
  <? do_action( 'ebisu_section_best_seller' ) ?>
</div>


<? /* Newsletter */
$newsletter_title     = get_field('newsletter_title');
$newsletter_subtitle  = get_field('newsletter_subtitle');
$newsletter_bg        = get_field('newsletter_background_image');
$mailchimp_form       = get_field('mailchimp_form');


?>
<div class="home-section newsletter">
  <img src="<?=$newsletter_bg?>">
  <h2 class="title"><?=$newsletter_title?></h2>
  <p class="subtitle"><?=$newsletter_subtitle?></p>

<!--   <form>
    <input type="text" placeholder="YOUR EMAIL ADDRESS">
    <input type="button" value="subscribe">
  </form>
 -->
  <? echo do_shortcode($mailchimp_form); ?>

</div>

<script>
jQuery(document).ready(function($){
  window.$ = $;
  slickMe();


  $(".our-products .menu-mega_menu-container .menu-cat-meat").addClass("actived");
  $(".our-products .menu-mega_menu-container a").on('click', function(e){
    e.preventDefault();

    $(".our-products .menu-mega_menu-container li").removeClass("actived");
    $(this).parent().addClass("actived");

    href = $(this).attr("href");
    path = loc(href);
    cat = path.split("/").pop();

    $(".slider-container.prod-out-product > div").slick('slickUnfilter');
    $(".slider-container.prod-out-product > div").slick('slickFilter','.prod-'+cat);
  });

});

function slickMe() {

  $(".slider-container").each(function(k,v){
    $v = $(v);
    $parent = $v.parent();
    $(">div", $v).on('init', function(event, slick){
      if($v.parent().hasClass(".prod-out-product")) {
        $(".slider-container.prod-out-product > div").slick('slickFilter','.prod-meat');    
      }
    }).slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      prevArrow: $(".entypo-left-open-big", $v),
      nextArrow: $(".entypo-right-open-big", $v),
      speed: 300,
      autoplay: true,
      autoplaySpeed: 5000,
      lazyLoad: 'ondemand',
      responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
    });
    $v.removeClass("hide");
    
  });
}



</script>

<?php
get_footer();
