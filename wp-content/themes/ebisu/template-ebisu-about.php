<?php
/**
 *
 * Template Name: Ebisu About Us
 *
 */

get_header(); ?>

<?

$ebisu_page_title     = get_field('page_title');
$ebisu_top_banner     = get_field('top_banner');
$ebisu_bottom_banner  = get_field('bottom_banner');
$ebisu_bottom_title   = get_field('bottom_title');

$page_sub_title_left  = get_field('page_sub_title_left');
$page_content_left    = get_field('page_content_left');
$page_sub_title_right = get_field('page_sub_title_right');
$page_content_right   = get_field('page_content_right');

$about_us_slider = trim(get_field('slider'));

$post = get_post( $post );
$title = isset( $post->post_title ) ? $post->post_title : '';
$ebisu_page_title = empty($ebisu_page_title)? $title : $ebisu_page_title;

?>

  <div id="primary" class="content-area about-us">

    <div class="top-banner" style="background-image: url(<?=$ebisu_top_banner?>)">
      <h2><?=$ebisu_page_title?></h2>
    </div>

    <div class="about-us-desc col-full">
      <div class="">
        <h4><?=$page_sub_title_left?></h4>
        <p><?=$page_content_left?></p>
      </div>
      <div class="">
        <h4><?=$page_sub_title_right?></h4>
        <p><?=$page_content_right?></p>
      </div>
    </div>
    <div class="col-full about-us-slider">
      <?php  echo do_shortcode($about_us_slider);  ?>
    </div>

    <div class="bottom-banner" style="background-image: url(<?=$ebisu_bottom_banner?>)">
      <h3><?=$ebisu_bottom_title?></h3>
      <a href="/" class="btn-ebisu">View All</a>
    </div>

  </div><!-- #primary -->

<?php
get_footer();
