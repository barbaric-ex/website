<?php

$title = get_field('title');
$tag = get_field('heading_tag');

if( $title ) { ?>
<<?php echo esc_html($tag); ?> class="intro_title"><?php echo $title; ?></<?php echo esc_html($tag); ?>>
<?php }
