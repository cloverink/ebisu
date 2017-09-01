<?php
/**
 * WooCommerce Template Functions.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_before_content' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function storefront_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}


if ( ! function_exists( 'storefront_after_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function storefront_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action( 'storefront_sidebar' );
	}
}

if ( ! function_exists( 'storefront_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array            Fragments to refresh via AJAX
	 */
	function storefront_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		storefront_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		ob_start();
		storefront_handheld_footer_bar_cart_link();
		$fragments['a.footer-cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

if ( ! function_exists( 'storefront_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function storefront_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'storefront_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  1.0.0
	 * @uses  is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function storefront_product_search() {
		if ( is_woocommerce_activated() ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 * @since  1.0.0
	 * @uses  is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function storefront_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<ul class="site-header-cart menu">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php storefront_cart_link(); ?>
			</li>
			<li>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_upsell_display' ) ) {
	/**
	 * Upsells
	 * Replace the default upsell function with our own which displays the correct number product columns
	 *
	 * @since   1.0.0
	 * @return  void
	 * @uses    woocommerce_upsell_display()
	 */
	function storefront_upsell_display() {
		woocommerce_upsell_display( -1, 3 );
	}
}

if ( ! function_exists( 'storefront_sorting_wrapper' ) ) {
	/**
	 * Sorting wrapper
	 *
	 * @since   1.4.3
	 * @return  void
	 */
	function storefront_sorting_wrapper() {
		echo '<div class="storefront-sorting">';
	}
}

if ( ! function_exists( 'storefront_sorting_wrapper_close' ) ) {
	/**
	 * Sorting wrapper close
	 *
	 * @since   1.4.3
	 * @return  void
	 */
	function storefront_sorting_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'storefront_shop_messages' ) ) {
	/**
	 * Storefront shop messages
	 *
	 * @since   1.4.4
	 * @uses    storefront_do_shortcode
	 */
	function storefront_shop_messages() {
		if ( ! is_checkout() ) {
			echo wp_kses_post( storefront_do_shortcode( 'woocommerce_messages' ) );
		}
	}
}

if ( ! function_exists( 'storefront_woocommerce_pagination' ) ) {
	/**
	 * Storefront WooCommerce Pagination
	 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
	 * but since Storefront adds pagination before that function is excuted we need a separate function to
	 * determine whether or not to display the pagination.
	 *
	 * @since 1.4.4
	 */
	function storefront_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

if ( ! function_exists( 'storefront_promoted_products' ) ) {
	/**
	 * Featured and On-Sale Products
	 * Check for featured products then on-sale products and use the appropiate shortcode.
	 * If neither exist, it can fallback to show recently added products.
	 *
	 * @since  1.5.1
	 * @param integer $per_page total products to display.
	 * @param integer $columns columns to arrange products in to.
	 * @param boolean $recent_fallback Should the function display recent products as a fallback when there are no featured or on-sale products?.
	 * @uses  is_woocommerce_activated()
	 * @uses  wc_get_featured_product_ids()
	 * @uses  wc_get_product_ids_on_sale()
	 * @uses  storefront_do_shortcode()
	 * @return void
	 */
	function storefront_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
		if ( is_woocommerce_activated() ) {

			if ( wc_get_featured_product_ids() ) {

				echo '<h2>' . esc_html__( 'Featured Products', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'featured_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
			} elseif ( wc_get_product_ids_on_sale() ) {

				echo '<h2>' . esc_html__( 'On Sale Now', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'sale_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
			} elseif ( $recent_fallback ) {

				echo '<h2>' . esc_html__( 'New In Store', 'storefront' ) . '</h2>';

				echo storefront_do_shortcode( 'recent_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
			}
		}
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar' ) ) {
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar() {
		$links = array(
			'my-account' => array(
				'priority' => 10,
				'callback' => 'storefront_handheld_footer_bar_account_link',
			),
			'search'     => array(
				'priority' => 20,
				'callback' => 'storefront_handheld_footer_bar_search',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'storefront_handheld_footer_bar_cart_link',
			),
		);

		if ( wc_get_page_id( 'myaccount' ) === -1 ) {
			unset( $links['my-account'] );
		}

		if ( wc_get_page_id( 'cart' ) === -1 ) {
			unset( $links['cart'] );
		}

		$links = apply_filters( 'storefront_handheld_footer_bar_links', $links );
		?>
		<section class="storefront-handheld-footer-bar">
			<ul class="columns-<?php echo count( $links ); ?>">
				<?php foreach ( $links as $key => $link ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<?php
						if ( $link['callback'] ) {
							call_user_func( $link['callback'], $key, $link );
						}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
		<?php
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar_search' ) ) {
	/**
	 * The search callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar_search() {
		echo '<a href="">' . esc_attr__( 'Search', 'storefront' ) . '</a>';
		storefront_product_search();
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar_cart_link' ) ) {
	/**
	 * The cart callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar_cart_link() {
		?>
			<a class="footer-cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
				<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'storefront_handheld_footer_bar_account_link' ) ) {
	/**
	 * The account callback function for the handheld footer bar
	 *
	 * @since 2.0.0
	 */
	function storefront_handheld_footer_bar_account_link() {
		echo '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_attr__( 'My Account', 'storefront' ) . '</a>';
  }
}

if ( ! function_exists( 'storefront_woocommerce_init_structured_data' ) ) {
  /**
   * Generate product category structured data...
   * Hooked into the `woocommerce_before_shop_loop_item` action...
   * Apply the `storefront_woocommerce_structured_data` filter hook for structured data customization...
   */
  function storefront_woocommerce_init_structured_data() {
    if ( ! is_product_category() ) return;
    global $product;

    $json['@type']             = 'Product';
    $json['name']              = get_the_title();
    $json['image']             = wp_get_attachment_url( $product->get_image_id() );
    $json['description']       = get_the_excerpt();
    $json['sku']               = $product->get_sku();
    $json['brand']             = array(
      '@type'                  => 'Thing',
      'name'                   => $product->get_attribute( __( 'brand', 'storefront' ) )
    );
    if ( $product->get_rating_count() ) {
      $json['aggregateRating'] = array(
        '@type'                => 'AggregateRating',
        'ratingValue'          => $product->get_average_rating(),
        'reviewCount'          => $product->get_rating_count()
      );
    }
    $json['offers']            = array(
      '@type'                  => 'Offer',
      'priceCurrency'          => get_woocommerce_currency(),
      'price'                  => $product->get_price(),
      'itemCondition'          => 'http://schema.org/NewCondition',
      'availability'           => 'http://schema.org/' . $stock = ( $product->is_in_stock ? 'InStock' : 'OutOfStock' ),
      'seller'                 => array(
        '@type'                => 'Organization',
        'name'                 => get_bloginfo( 'name' )
      )
    );
    if ( ! isset( $json ) ) return;
    Storefront::set_structured_data( apply_filters( 'storefront_woocommerce_structured_data', $json ) );
  }
}













































if ( ! function_exists( 'ebisu_before_content' ) ) {
  /**
   * Before Content
   */
  function ebisu_before_content() {

    $cat_class = is_product_category() ?  "page-product-category" : "";

    ?>
    <div id="primary" class="content-area">
      <main id="main" class="site-main" role="main">
        <div id="wrapper" class="col-full <?=$cat_class?>">
          <? if ( is_product_category() ) : ?>
            <?= ebisu_category_sidebar() ?>
          <? endif; ?>
          <div class="content">
    <?php
  }
}

if ( ! function_exists( 'ebisu_after_content' ) ) {
  /**
   * After Content
   */
  function ebisu_after_content() {
    ?>
            </div><!--  -->
          </div><!--.wrapper-->
        </div><!--.col-full-->
      </main><!-- #main -->
    </div><!-- #primary -->

    <?php
  }
}


if ( ! function_exists( 'ebisu_category_sidebar' ) ) {
  function ebisu_category_sidebar() {
?>
<div class="cat-sidebar">

  <h3>Categories</h3>
  <ul class="ebisu_category_sidebar">
  <?
    $terms = get_terms( 'product_cat', array('parent' => '0'));

    foreach ( $terms as $term ) {
      $id    = $term->term_id;
      $link  = esc_url( get_term_link( $term ) );
      $name  = $term->name;
      $slug  = $term->slug;

      echo "<li class='$slug'>";
      echo "<a href='$link' class='$slug'>$name</a>";
        $subterms = get_terms( 'product_cat', array('parent' => $id));
        if(count($subterms) > 0) {
          echo "<div class='expand'><div></div><div></div></div>";
          echo "<ul class='ebisu_category_sidebar_sub'>";
          foreach ($subterms as $subterm) {
            $sublink  = esc_url( get_term_link( $subterm ) );
            $subname  = $subterm->name;
            $subslug  = $subterm->slug;

            echo "<li class='$subslug'>";
            echo "<a href='$sublink' class='$slug'>$subname</a>";
            echo "</li>";

          }
          echo "</ul>";
        }

      echo "</li>";
    }
  ?>
  </ul>
</div>
<script>
jQuery(document).ready(function($){
  $(".cat-sidebar .expand").on('click', function(){
    var parent = $(this).parent();
    parent.toggleClass("expanded");
  });
});
</script>
<?
  }
}





if ( ! function_exists( 'ebisu_catalog_ordering' ) ) {

  function ebisu_catalog_ordering() {
    global $wp_query;

    if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
      return;
    }

    $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
      'menu_order' => __( 'Default sorting', 'woocommerce' ),
      'popularity' => __( 'popularity', 'woocommerce' ),
      'rating'     => __( 'average rating', 'woocommerce' ),
      'date'       => __( 'newness', 'woocommerce' ),
      'price'      => __( 'price: low to high', 'woocommerce' ),
      'price-desc' => __( 'price: high to low', 'woocommerce' )
    ) );

    if ( ! $show_default_orderby ) {
      unset( $catalog_orderby_options['menu_order'] );
    }

    if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
      unset( $catalog_orderby_options['rating'] );
    }

    wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
  }
}


/*


function woocommerce_quantity_input() {
    global $product;

  $defaults = array(
    'input_name'    => 'quantity',
    'input_value'   => '1',
    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
    'step'    => apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
    'style'   => apply_filters( 'woocommerce_quantity_style', 'float:left; margin-right:10px;', $product )
  );
  if ( ! empty( $defaults['min_value'] ) )
    $min = $defaults['min_value'];
  else $min = 1;

  if ( ! empty( $defaults['max_value'] ) )
    $max = $defaults['max_value'];
  else $max = 10;
  if ( ! empty( $defaults['step'] ) )
    $step = $defaults['step'];
  else $step = 1;

  $options = '';
  for ( $count = $min; $count <= $max; $count = $count+$step ) {
    $options .= '<option value="' . $count . '">' . $count . '</option>';
  }
  echo '<div class="quantity_select" style="' . $defaults['style'] . '"><select name="' . esc_attr( $defaults['input_name'] ) . '" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="qty">' . $options . '</select></div>';
}
*/