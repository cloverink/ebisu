<?php
/**
 *
 * Template Name: Ebisu Contact Us
 *
 */

get_header(); ?>

<?

$ebisu_page_title     = get_field('page_title');
$ebisu_top_banner     = get_field('top_banner');

$page_sub_title       = get_field('page_sub_title');
$page_description     = get_field('page_description');

$ebisu_display_image  = get_field('display_image');


$post = get_post( $post );
$title = isset( $post->post_title ) ? $post->post_title : '';
$ebisu_page_title = empty($ebisu_page_title)? $title : $ebisu_page_title;


  // $roles = array();       
  // foreach (get_roles() as $k => $v) {        
  //   array_push($roles, $k);
  // } 

  // print_r($roles);
  // echo "<BR>";
  // echo get_current_user_id();
  // echo "<BR>";

  // $userdata = array();
  // $userdata['ID'] = get_current_user_id();
  // $userdata['role'] = "customer";


  // print_r($userdata);
  // if(in_array("customers", $roles, true)) {
  //   echo 123;
  // }
  // //wp_update_user($userdata);

  // // $roles = array();       
  // // foreach (get_roles() as $k => $v) {        
  // //   array_push($roles, $k);
  // // } 

  // // if(in_array("customers", $roles, true)) {
  // //   wp_update_user($userdata);
  // // }

?>

  <div id="primary" class="content-area contactus">

    <div class="top-banner" style="background-image: url(<?=$ebisu_top_banner?>)">
      <h2><?=$ebisu_page_title?></h2>
    </div>

    <div class="col-full page-desc">
      <h3><?=$page_sub_title?></h3>
      <p><?=$page_description?></p>
    </div>

    <div class="col-full">
      <?php while ( have_posts() ) : the_post();


        get_template_part( 'content', 'page' );


      endwhile; // End of the loop. ?>
    </div>


  </div><!-- #primary -->

<?php
get_footer();
