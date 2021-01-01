<?php if(have_rows('photo_&_video')){ ?>
<section class="gallery-section"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
	<div class="container-md">
		<div class="media-gallery">
		<?php while(have_rows('photo_&_video')){ the_row(); ?>
			<?php if(get_row_layout() == 'photo'){
				$img = get_sub_field('image');
				if($img){ ?>
					<div>
						<?php retina_image($img, 'slideshow_image', 'slideshow_image_2x', 'slideshow_image_small', 'slideshow_image_small_2x'); ?>
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
