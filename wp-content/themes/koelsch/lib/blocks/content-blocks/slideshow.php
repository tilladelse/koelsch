<?php if(have_rows('photo_&_video')){ ?>
<section class="gallery-section">
	<div class="container-md">
		<div class="media-gallery">
		<?php while(have_rows('photo_&_video')){ the_row(); ?>
			<?php if(get_row_layout() == 'photo'){
				$image = get_sub_field('image') ? wp_get_attachment_image_url(get_sub_field('image'), 'slideshow_image') : '';
				$image_2x = get_sub_field('image_2x') ? wp_get_attachment_image_url(get_sub_field('image_2x'), 'slideshow_image_2x') : '';
				$image_sm = get_sub_field('image_small') ? wp_get_attachment_image_url(get_sub_field('image_small'), 'slideshow_image_small') : '';
				$image_sm_2x = get_sub_field('image_small_2x') ? wp_get_attachment_image_url(get_sub_field('image_small_2x'), 'slideshow_image_small_2x') : '';
				if($image && $image_2x && $image_sm && $image_sm_2x){ ?>
					<div>
						<picture>
							<source srcset="<?php echo $image_sm; ?>, <?php echo $image_sm_2x; ?> 2x" media="(max-width: 767px)">
							<source srcset="<?php echo $image; ?>, <?php echo $image_2x; ?> 2x">
							<img src="<?php echo $image; ?>" alt="image description">
						</picture>
					</div>
				<?php } ?>
			<?php } ?>
			
			<?php if(get_row_layout() == 'video'){
				$type = get_sub_field('type');
				$video_file = get_sub_field('video_file'); $video_code = get_sub_field('video_code'); 
				$video = $type == 'html5' ? $video_file : $video_code; ?>
				<div>
					<div class="video-block" data-video='{"type": "<?php echo $type ?>", "video": "<?php echo esc_attr($video); ?>", "autoplay": false, "fluidWidth": false}'></div>
				</div>
			<?php } ?>
		<?php } ?>
		</div>
	</div>
</section>
<?php } ?>