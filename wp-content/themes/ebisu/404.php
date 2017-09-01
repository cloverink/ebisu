<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */



get_header(); ?>

	<div id="primary" class="content-area page404">

  <div class="top-banner" style="background-image: url(<?=$GLOBALS['cgv']['top-banner-404']?>)">
    <h2>404</h2>
  </div>

  <div class="col-full page-desc">
    <h3>Oops! That page can&rsquo;t be found.</h3>
    <p>Nothing was found at this location. Try searching, or check out the links below.</p>
  </div>

		<main id="main" class="site-main col-full" role="main">

			<section class="error-404 not-found">

				<div class="page-content">
					
					<?php
					if ( is_woocommerce_activated() ) {
						the_widget( 'WC_Widget_Product_Search' );
					} else {
						get_search_form();
					}

					if ( is_woocommerce_activated() ) {

						echo '<div class="fourohfour-columns-2">';

							echo '<div class="col-1">';

								storefront_promoted_products();

							echo '</div>';

							echo '<div class="col-2">';

							echo '<h2>' . esc_html__( 'Product Categories', 'storefront' ) . '</h2>';

							the_widget( 'WC_Widget_Product_Categories', array(
																			'count'		=> 1,
							) );
							echo '</div>';

						echo '</div>';

						echo '<h2>' . esc_html__( 'Popular Products', 'storefront' ) . '</h2>';

						echo storefront_do_shortcode( 'best_selling_products', array(
																			'per_page' 	=> 4,
																			'columns'	=> 4,
						) );
					}
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
