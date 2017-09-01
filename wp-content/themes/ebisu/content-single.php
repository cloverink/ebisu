<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */


$post_id          = get_the_ID();
$post_title       = get_the_title();
$post_top_banner  = get_field('top_banner', $post_id);


$relate_post = array();

$tags = wp_get_post_tags($post_id);
if ($tags) {
  $tag_ids = array();
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

  $args=array(
    'tag__in'           => $tag_ids,
    'post__not_in'      => array($post_id),
    'posts_per_page'    => 3,
    'caller_get_posts'  => 1
  );
  $relate_post_tags = new WP_Query($args);

  if($relate_post_tags) {
    foreach ($relate_post_tags->posts as $k => $v) {
      array_push($relate_post, $v);
    }
  }

} else {
  $args = array( 
    'post_type'       => 'post', 
    'post__not_in'    => array($post_id),
    'posts_per_page'  => 3, 
    'paged'           => 1 
  );
  $relate_post_temp = new WP_Query($args);
  if($relate_post_temp) {
    foreach ($relate_post_temp->posts as $k => $v) {
      array_push($relate_post, $v);
    }
  }
}

// if($relate_post) {
//   echo "<pre>";
//   print_r($relate_post);
//   echo "</pre>";
// }

?>

<div class="top-banner" style="background-image: url(<?=$post_top_banner?>)">
  <h2><?=$post_title?></h2>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-full'); ?>>


  <div class="pull-left releate-item">
    <h5>new arrivals</h5>

    <?
      $products = ebisu_get_product_new_arrivals();
      foreach ($products as $k => $v) {
        $product = new WC_product($v->ID);

        $image_id   = $product->get_image_id();
        $image_url  = wp_get_attachment_image_src($image_id, 'thumbnail')[0];
        $prod_name  = $product->get_title(); 
        $prod_price = $product->get_price();
        $prod_url   = $product->get_permalink();

        echo "<div class='product-box $class'>";
        echo "<a href='$prod_url' class='product-image'><img src='$image_url'></a>";
        echo "<a href='$prod_url' class='product-title'><h3>$prod_name</h3></a>";
        echo "<div class='product-price'>$prod_price</div>";
        echo "<button class=''>add to cart</button>";
        echo "</div>";
      
        break;
      }

    ?>


    <h5>best seller</h5>

    <?
      $products = ebisu_get_product_best_seller();
      foreach ($products as $k => $v) {
        $product = new WC_product($v->ID);

        $image_id   = $product->get_image_id();
        $image_url  = wp_get_attachment_image_src($image_id, 'thumbnail')[0];
        $prod_name  = $product->get_title(); 
        $prod_price = $product->get_price();
        $prod_url   = $product->get_permalink();

        echo "<div class='product-box $class'>";
        echo "<a href='$prod_url' class='product-image'><img src='$image_url'></a>";
        echo "<a href='$prod_url' class='product-title'><h3>$prod_name</h3></a>";
        echo "<div class='product-price'>$prod_price</div>";
        echo "<button class=''>add to cart</button>";
        echo "</div>";
      
        break;
      }

    ?>

  </div>

	<?php
	/**
	 * Functions hooked into storefront_single_post add_action
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_meta            - 20
	 * @hooked storefront_post_content         - 30
	 * @hooked storefront_init_structured_data - 40
	 */
	//do_action( 'storefront_single_post' );
  storefront_post_content();


	?>
</article><!-- #post-## -->


<div class="col-full relate-list-container">
  <h4>Releate Recipes</h4>
  <div class="relate-list">

<?
foreach ($relate_post as $k => $v) :
  $post_id = $v->ID;
  $post_thumpnail = wp_get_attachment_url( get_post_thumbnail_id($post_id), 'full' );
  $post_title = $v->post_title;
  $post_short_desc = get_field('short_description', $post_id);
  $post_date = $v->post_date;
  $post_url = esc_url(get_permalink($post_id));
?>        

      <a href="<?=$post_url?>">
        <div class="avt" style="background-image: url(<?=$post_thumpnail?>)">
          <div class="btn">View Recipe</div>
          <div class="dt"><? echo date( 'dS M Y', strtotime( $post_date ) ); ?></div>
        </div>
        <div class="desc">
          <h3><?=$post_title?></h3>
          <p><?=$post_short_desc?></p>
        </div>
      </a>

<? endforeach; ?>

  </div>
</div>