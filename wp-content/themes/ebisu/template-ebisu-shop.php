<?php
/**
 *
 * Template Name: Ebisu Shop
 *
 */

get_header(); ?>
<?

$ebisu_page_title = get_field('page_title');
$ebisu_top_banner = get_field('top_banner');

$post = get_post( $post );
$title = isset( $post->post_title ) ? $post->post_title : '';
$ebisu_page_title = empty($ebisu_page_title)? $title : $ebisu_page_title;
?>

  <div id="primary" class="content-area cart">

    <div class="top-banner" style="background-image: url(<?=$ebisu_top_banner?>)">
      <h2><?=$ebisu_page_title?></h2>
    </div>


    <main id="main" class="site-main col-full" role="main">

      <?php while ( have_posts() ) : the_post();

        get_template_part( 'content', 'page' );

      endwhile; // End of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
