<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stier
 */

get_header();
?>
<?php
while (have_posts()) :
	the_post(); ?>

	<div class="section_single_post">
		<main id="primary" class="site-main container">
			<article class="post_main">
				<?php
				the_title('<h1 class="title-1">', '</h1>');
				echo wp_kses_post(get_field('intro'));
				echo get_the_date();
				the_content(); ?>
			</article>
			<aside class="post_sidebar">
				<h2>Ostali postovi</h2>
				<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3,
					'post__not_in' => array(get_the_ID()), // da ne prikazuje trenutni post
				);

				$query = new WP_Query($args);

				if ($query->have_posts()) : ?>
					<div class="posts_grid">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<div class="grid_item">
								<div class="gi_image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium'); ?>
									</a>
								</div>
								<div class="gi_title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</div>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				<?php else : ?>
					<p>Nema drugih postova.</p>
				<?php endif; ?>
			</aside>


		</main><!-- #main -->

		<div class="container">
		<?php the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'stier') . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'stier') . '</span> <span class="nav-title">%title</span>',
			)
		);
	endwhile; // End of the loop.
		?>
		</div>
	</div>


	<?php
	get_footer();
