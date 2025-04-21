<?php
// Uzimamo vrijednosti s ACF polja
$video  = get_field('background_video');      // ACF: file field (video)
$image  = get_field('background_image');      // ACF: image field
$option = get_field('image__video_background'); // ACF: select field (returns "Background Image" or "Background Video")
$background_overlay = get_field('background_overlay');

// Debug (ako trebaš testirati vrijednosti)
// echo '<pre>'; print_r($option); echo '</pre>';
?>

<?php if ($option === 'Background Video' && $video): ?>
    <div class="video_wrap">
        <video disableRemotePlayback loop playsinline muted autoplay>
            <source src="<?php echo ($video); ?>" type="video/mp4">
        </video>
    </div>

<?php elseif ($option === 'Background Image' && $image): ?>
    <div class="image_background" style="background-image: url('<?php echo ($image['sizes']['large']); ?>');">
    </div>
<?php endif; ?>
<div class="overlay" style="background-color:<?php echo ($background_overlay); ?>;"></div>