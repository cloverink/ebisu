<?php
/**
 *
 * Template Name: Ebisu Order Tracking
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

?>

  <div id="primary" class="content-area order-tracking">

    <div class="top-banner" style="background-image: url(<?=$ebisu_top_banner?>)">
      <h2><?=$ebisu_page_title?></h2>
    </div>

    <div class="col-full page-desc">
      <h3><?=$page_sub_title?></h3>
      <p><?=$page_description?></p>
    </div>


    <table class="col-full order-form">
      <tr>
        <td class="avt">
         <img src="<?=$ebisu_display_image?>">
        </td>
        <td class="desc">
          <h4>Please fill in details below :</h4>
          <form method="post">
            <input type="text" name="track_order_email" placeholder="Email">
            <input type="text" name="track_order_no" placeholder="Order No">
            <input type="submit" value="track order now">
            
          </form>
            
        </td>
      </tr>
    </table>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

$track_order_email  = trim($_POST["track_order_email"]);
$track_order_no     = trim($_POST["track_order_no"]);



$order            = new WC_Order($track_order_no);
$shipping_address = $order->get_shipping_address();
$billing_email    = $order->billing_email;
$status           = $order->status;
$user_id          = $order->user_id;


$user_order   = new WP_User($user_id);
$email        = $user_order->user_email;

?>


    <div class="col-full order-tracking-result">

    <h4>Tracking Order No : <span><?=$track_order_no?></span> </h4>
    <h4>Tracking Order Email : <span><?=$track_order_email?></span> </h4>

    <? 



      if($track_order_email === $billing_email) {

        $aftership = $GLOBALS['aftership'];
        
    ?>

      <div class="result">
        <div class="order-status"> Order status: <span><?=$status?></span></div>

        <?

          $values = $aftership->display_tracking_value($track_order_no);

          $track_provider   = $values['aftership_tracking_provider'];
          $track_number     = $values['aftership_tracking_number'];
          $link_tracking    = "";

          if($track_provider == "thailand-post") {
            $link_tracking    = "http://track.aftership.com/$track_number";
          } elseif($track_provider == "kerry-logistics") {
            $link_tracking    = "http://track.aftership.com/kerry-logistics/$track_number";
          } else {

          }


          echo "<div class='track-container'>";
          echo "<div class='track-provider'>Your order was shipped via : <span>" . $values['aftership_tracking_provider_name'] . "</span></div>";
          echo "<div class='track-number'>Tracking number is : <span>" . $values['aftership_tracking_number'] . "</span>" . $required_fields_msg . "</div>";
          if(!empty($link_tracking)) {
            echo "<a href='$link_tracking' class='btn-ebisu btn-tracking' target='_blank'>View tracking status</a>";
          }
          echo "</div>";

        ?>
      </div>

    <?
      } else {
        echo "<div class='error'>Order doesn't match with email and Order No.</error>";
      }      
    ?>

    

    </div>

<? endif; ?>


  </div><!-- #primary -->


<?php



get_footer();
