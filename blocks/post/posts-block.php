<?php
$layout = get_field_object('layout');
$stack = get_field_object('stack');

$padding = get_field_object('padding');

$class = 'st_block st_posts';
if (! empty($block['className'])) {
    $class .= ' ' . $block['className'];
}

$anchor = 'blog_section';
if (! empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

if (! empty($padding)) {
    $class .=  ' ' . $padding['value'];
}

$sec_in_class = 'st_section_inner container';
if (! empty($layout)) {
    $sec_in_class .=  ' ' . $layout['value'];
}

if (! empty($stack)) {
    $sec_in_class .=  ' ' . $stack['value'];
}

?>

<section id="<?php echo $anchor; ?>" class="<?php echo $class; ?>">
    <?php get_template_part('components/background'); ?>
    <div class="<?php echo $sec_in_class ?>">
        <?php
        $title = get_field('title');
        $text = get_field('text'); ?>

        <div class="wrapper">
            <h2 class="st_posts_title"><?php echo $title; ?></h2>
            <div class="st_posts_text"><?php echo $text ?></div>

        </div>

        <div class="post_list_wrap">
            <div class="post_wrapper">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3, // ili koliko želiš
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) : ?>
                    <div class="posts_grid">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php get_template_part('template-parts/content', 'post'); ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>


    </div>
</section>