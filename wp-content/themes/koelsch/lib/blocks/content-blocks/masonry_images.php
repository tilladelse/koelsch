<?php if(have_rows('masonry_images')){ ?>
<section class="section-instagram">
	<ul class="instagram-list">
		<?php while(have_rows('masonry_images')){ the_row(); ?>		
		<li>
			<?php if(get_row_layout() == 'photo'){
				$image = get_sub_field('image') ? wp_get_attachment_image_url(get_sub_field('image'), 'slideshow_image') : '';
				if($image){ ?>
					<img src="<?php echo $image; ?>" alt="image description">
				<?php }
			} ?>			
			<?php if(get_row_layout() == 'video'){
				$type = get_sub_field('type');
				$video_file = get_sub_field('video_file'); $video_code = get_sub_field('video_code'); 
				$video = $type == 'html5' ? $video_file : $video_code;
				$image = get_sub_field('image') ? wp_get_attachment_image_url(get_sub_field('image'), 'slideshow_image') : '';
				if($image && $video){ ?>
					<a href="#" data-video='{"type": "<?php echo $type ?>", "video": "<?php echo esc_attr($video); ?>", "fluidWidth": true}'><img src="<?php echo $image; ?>" alt="image description"></a>
				<?php }
			} ?>
			<?php } ?>
		</li>
	</ul>
</section>
<?php } ?>