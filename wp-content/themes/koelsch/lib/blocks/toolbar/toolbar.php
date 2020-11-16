<div class="find-panel">
	<div class="container-md">
		<img class="img-decor" src="<?php echo get_template_directory_uri(); ?>/assets/images/map-decor.svg" alt="map">
		<?php if ( $title = get_field( 'title' ) ): ?>
			<h4><?php echo $title; ?></h4>
		<?php endif; ?>
		<form class="find-form" action="<?php echo esc_url(get_field( 'page_for_search' )); ?>" data-json="<?php echo get_template_directory_uri(); ?>/assets/inc/map-data.json">
			<div class="controls">
				<div class="state-box">
					<select class="state-select" data-filter-group="state" name="state">
						<option class="hideme"><?php _e('By State','genesis'); ?></option>
					</select>
				</div>
				<div class="hidden city-box">
					<select class="city-select" data-filter-group="city" name="city">
						<option class="hideme"><?php _e('By State','genesis'); ?></option>
					</select>
				</div>
				<span class="or"><?php _e('Or','genesis'); ?></span>
				<div class="form-group">
					<input class="form-control zipcode-fields" type="text" placeholder="<?php _e('By Zipcode','genesis'); ?>">
					<a class="btn-outline sm btn-search" href="#"><?php _e('GO','genesis'); ?></a>
				</div>
			</div>
		</form>
	</div>
</div>