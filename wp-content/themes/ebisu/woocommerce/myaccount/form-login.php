<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h3>Login - My account </h3>

		<form method="post" class="login">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input placeholder="<?php _e( 'Username or email address', 'woocommerce' ); ?>" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" autocomplete="off" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input placeholder="<?php _e( 'Password', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
        <a class="lnkForgotMyPass" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot my password ?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row submit-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        <input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="hidden" id="rememberme" value="forever" />
				<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
        <span class="or">or</span>
			</p>

      <?php do_action('facebook_login_button');?>

      <? /*
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Forgot my password ?', 'woocommerce' ); ?></a>
			</p>
      */ ?>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h3>Registration</h3>

    <div class="tab-register-type">
      <div id="tab-Customer" class="actived">Customer</div>
      <div id="tab-Wholesale">Wholesale buyer</div>
      <div class="dummy"></div>
    </div>
    <script>
      jQuery(document).ready(function($){
        $(".tab-register-type > div").on('click', function(e){
          e.preventDefault();

          if($(this).hasClass("dummy")) return;
          $(".tab-register-type > div").removeClass("actived");
          $(this).addClass("actived");
          if($(this).attr("id") == "tab-Wholesale") {
            $(".my_account #customer_login form.register .or").addClass("hide");
            $(".my_account #customer_login form.register .css-fbl.js-fbl").addClass("hide");
            $("#role").val(roles[1]);
          } else {
            $(".my_account #customer_login form.register .or").removeClass("hide");
            $(".my_account #customer_login form.register .css-fbl.js-fbl").removeClass("hide");
            $("#role").val(roles[0]);
          }

        });
      });
    </script>

		<form method="post" class="register" autocomplete="off">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
          <label class="error"></label>
					<input placeholder="<?php _e( 'Username', 'woocommerce' ); ?>" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>"  autocomplete="off"/>
				</p>

			<?php endif; ?>

			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
        <label class="error"></label>
				<input placeholder="<?php _e( 'Email address', 'woocommerce' ); ?>" type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>"  autocomplete="off" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
          <label class="error"></label>
					<input placeholder="<?php _e( 'Password', 'woocommerce' ); ?> " type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
				</p>

        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
          <label class="error"></label>
          <input placeholder="<?php _e( 'Confirm Password', 'woocommerce' ); ?> " type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password2" id="reg_password2" />
        </p>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<div class="form-row submit-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

        <?php do_action('facebook_login_button');?>
        <span class="or">or</span>
				<input type="submit" class="woocommerce-Button button btn-ebisu" name="register" value="<?php esc_attr_e( 'Signup', 'woocommerce' ); ?>" />

			</div>
    
			<?php do_action( 'woocommerce_register_form_end' ); ?>

      <input id="role" type="hidden" value= ""  name="role"/>
      <script>
      <?
      $roles = array();       
      foreach (get_roles() as $k => $v) {        
        array_push($roles, $k);
      }
      echo "var roles = " . json_encode($roles, true) . ";";
      ?>

      jQuery(document).ready(function($){
        $("#role").val(roles[0]);
      });

      </script>
      

		</form>
    <script>
    jQuery(document).ready(function($){
      $("form.register input[type=submit]").on("click", function(e){

        var flag = true;
        $("form.register label.error").text("");

        var username = $("form.register input[name=username]");
        if(username.val() == "") {
          username.parent().find("label.error").text("Please input username");
          flag = false;
        }

        var email = $("form.register input[name=email]");
        if(email.val() == "") {
          email.parent().find("label.error").text("Please input your email");
          flag = false;
        } else if(!validateEmail(email.val())) {
          email.parent().find("label.error").text("Wrong Email format.");
          flag = false;
        } 

        var password = $("form.register input[name=password]");
        var password2 = $("form.register input[name=password2]");
        if(password.val() == "") {
          password.parent().find("label.error").text("Please input your password");
          flag = false;
        } else if(password2.val() == "") {
          password2.parent().find("label.error").text("Please input your Confirm password");
          flag = false;
        } else if(password.val() != password2.val()) {
          password2.parent().find("label.error").text("Password confirmation doesn't match Password");
          flag = false;
        }

        

        if(!flag)
          e.preventDefault();


        
        
        
      });
    });
    </script>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
