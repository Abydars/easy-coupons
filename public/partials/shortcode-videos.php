<?php foreach ( $videos as $video ) :
	$featured_image = get_the_post_thumbnail_url( $video->ID );
	?>
    <div class="ec-video" style="background-image: url('<?= $featured_image ?>');" data-id="<?= $video->ID ?>">
        <h3><?= $video->post_title ?></h3>
    </div>
<?php endforeach; ?>
