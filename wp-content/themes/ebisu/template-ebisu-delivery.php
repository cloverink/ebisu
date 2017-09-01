<?php
/**
 *
 * Template Name: Ebisu Delivery
 *
 */

get_header(); ?>

<?

$ebisu_page_title     = get_field('page_title');
$ebisu_top_banner     = get_field('top_banner');

$page_sub_title       = get_field('page_sub_title');
$page_description     = get_field('page_description');

$icon                 = get_field("icon");
$delivery_title       = get_field('delivery_title');
$delivery_sub_title   = get_field('delivery_sub_title');

$delivery_day         = get_field('delivery_day');
$delivery_time        = get_field('delivery_time');
$delivery_note        = get_field('delivery_note');

$delivery_headline              = get_field("delivery_headline");
$delivery_description           = get_field("delivery_description");
$delivery_other_province        = get_field("delivery_other_province");
$delivery_other_province_value  = get_field("delivery_other_province_value");
$delivery_world_wide            = get_field("delivery_world_wide");
$delivery_world_wide_value      = get_field("delivery_world_wide_value");

$post = get_post( $post );
$title = isset( $post->post_title ) ? $post->post_title : '';
$ebisu_page_title = empty($ebisu_page_title)? $title : $ebisu_page_title;

?>

  <div id="primary" class="content-area delivery">

    <div class="top-banner" style="background-image: url(<?=$ebisu_top_banner?>)">
      <h2><?=$ebisu_page_title?></h2>
    </div>

    <div class="col-full page-desc">
      <h3><?=$page_sub_title?></h3>
      <p><?=$page_description?></p>
    </div>


    <table class="col-full delivery-desc">
      <tr>
        <td class="avt" style="background-image: url(<?=$icon?>);">
          <h4><?=$delivery_title?></h4>
          <h5><?=$delivery_sub_title?></h5>
          <div class="delivery_day"><?=$delivery_day?></div>
          <div class="delivery_time"><?=$delivery_time?></div>
          <div class="delivery_note"><?=$delivery_note?></div>
        </td>
        <td class="desc">
          <h4><?=$delivery_headline?></h4>
          <p><?=$delivery_description?></p>
          <div class="other">
            <div>
              <h5><?=$delivery_other_province?></h5>
              <h6><?=$delivery_other_province_value?></h6>
            </div>
            <div>
              <h5><?=$delivery_world_wide?></h5>
              <h6><?=$delivery_world_wide_value?></h6>
            </div>
          </div>
        </td>
      </tr>
    </table>


  </div><!-- #primary -->

<?php
get_footer();
