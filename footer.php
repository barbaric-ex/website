<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s-tier
 */

?>


<?php if (have_rows('footer', 'options')) : ?>
	<?php while (have_rows('footer', 'options')) : the_row();

		$logo = get_sub_field('logo_image');
		$adress = get_sub_field('adress_text');
		$background = get_sub_field('background');




	?>
		<footer id="colophon" class="site-footer space_3" style="background-color:<?php echo $background ?> ;">
			<div class="footer_inner container">

				<div class="col">
					<div class="logo">


						<?php if ($logo): ?>
							<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
						<?php endif; ?>
					</div>
				</div>



				<div class="col">
					<h3>Menu</h3>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-bottom',
							'walker'		 => new CustomMenuWalker
						)
					);
					?>
				</div>

				<div class="col">
					<h3>Adress</h3>
					<p><?php echo $adress; ?></p>
				</div>

				<div class="col">
					<div class="info_wrap">
						<h3>Info</h3>

						<?php
						$link = get_sub_field('email');
						if ($link) :
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>



							<a class="email" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>


							</a>
						<?php endif; ?>

						<?php
						$link = get_sub_field('tel');
						if ($link) :
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>



							<a class="tel" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>


							</a>
						<?php endif; ?>
					</div>

				</div>
				<div class="col copy">
					© <?php echo date('Y'); ?> <?php bloginfo(); ?>
				</div>
			</div>
		</footer>

	<?php endwhile; ?>
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
<!--
	         (__)
     `\------(oo)
       ||    (__) <(What are you looking for?)
       ||w--||
-->
<?php echo get_field('body_bottom_script', 'option'); ?> <!-- Body Bottom External Code -->
</body>

</html>