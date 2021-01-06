<?php if(have_rows('masonry_images')){ ?>
<section class="section-instagram"<?php echo isset($block['anchor']) ? ' id="'.$block['anchor'].'"' : '';?>>
	<ul class="instagram-list">
		<?php while(have_rows('masonry_images')){ the_row(); ?>
		<li>
			<?php if(get_row_layout() == 'photo'){
				retina_image(get_sub_field('image'), 'image_set_small', 'image_set', 'resource-listing-sm-2x', 'image_set_small');
			} ?>
			<?php if(get_row_layout() == 'video'){
				$type = get_sub_field('type');
				$video_file = get_sub_field('video_file'); $video_code = get_sub_field('video_code');
				$video = $type == 'html5' ? $video_file : $video_code;
				if($video){ ?>
					<a href="#" data-video='{"type": "<?php echo $type ?>", "video": "<?php echo esc_attr($video); ?>", "fluidWidth": true}'>
						<?php retina_image(get_sub_field('image'), 'image_set_small', 'image_set', 'resource-listing-sm-2x', 'image_set_small');?>
					</a>
				<?php }
			} ?>
			<?php } ?>
		</li>
	</ul>
</section>
<?php } ?>
