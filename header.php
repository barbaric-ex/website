<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s-tier
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!--
	Insert site main color
	<meta name="theme-color" content="#45eba5" />
	-->
	<?php echo get_field('head_script', 'option'); ?> <!-- Head External Code -->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php echo get_field('body_top_script', 'option'); ?> <!-- Body Top External Code -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'stier' ); ?></a>
	<div class="top_bar">
		<div class="top_bar_inner container">
			<?php echo wp_kses_post( get_field('top_bar_message', 'option') ); ?>
		<?php
		$cta_link = get_field('cta_link', 'option');
		if( $cta_link ):
			$cta_link_url = $cta_link['url'];
			$cta_link_title = $cta_link['title'];
			$cta_link_target = $cta_link['target'] ? $cta_link['target'] : '_self';
			?>
			<a class="" href="<?php echo esc_url( $cta_link_url ); ?>" target="<?php echo esc_attr( $cta_link_target ); ?>"><span><?php echo esc_html( $cta_link_title ); ?></span></a>
		<?php endif; ?>
	</div>

	</div>
	<header id="masthead" class="header-main">
		<div class="header-main_inner container">
			<figure class="site-logo">
				<?php
				the_custom_logo(); ?>
			</figure><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<!-- Mobile Nav Button -->
				<div class="hamburger">
				<label for="nav-toggle">Navigation Menu</label>
				<input type="checkbox" class="menu-toggle" id="nav-toggle">

				<div></div></div>
				<!-- Mobile Nav Button -->
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main',
						'menu_id'        => 'primary-menu',
						'walker'		 => new CustomMenuWalker
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
