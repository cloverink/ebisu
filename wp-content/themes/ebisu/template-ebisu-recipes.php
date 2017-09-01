<?php
/**
 *
 * Template Name: Ebisu Recipes
 *
 */

get_header(); ?>

<?

$ebisu_page_title = get_field('page_title');
$ebisu_top_banner = get_field('top_banner');
$post = get_post( $post );
$title = isset( $post->post_title ) ? $post->post_title : '';
$ebisu_page_title = empty($ebisu_page_title)? $title : $ebisu_page_title;


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array( 'post_type' => 'post', 'posts_per_page' => 6, 'paged' => $paged );
$wp_query = new WP_Query($args);

?>

  <div id="primary" class="content-area recipes">

    <div class="top-banner" style="background-image: url(<?=$ebisu_top_banner?>)">
      <h2><?=$ebisu_page_title?></h2>
    </div>


    <main id="main" class="site-main col-full" role="main">

      <div class="recipes-list">

<?
foreach ($wp_query->posts as $k => $v) :
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





<!-- then the pagination links -->
<?php next_posts_link( '&larr; Older posts', $wp_query ->max_num_pages); ?>
<?php previous_posts_link( 'Newer posts &rarr;' ); ?>


    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
