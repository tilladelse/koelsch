<?php
/**
 * Map Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

global $post;
$gold_title = get_field('gold_title');
$title = get_field('title');
$description = get_field('description');

if(have_rows('categories')){
	if(!is_admin()){ ?>
		<section class="section-search"
		data-token="<?php echo MAPBOX_TOKEN;?>"
		data-template="popup_tmpl"
		data-styles="<?php echo MAPBOX_STYLE;?>"
		>
		<div class="search-container top-panel align-bottom">
			<?php if($gold_title || $title || $description){ ?>
				<div class="col-sm">
					<?php if($gold_title) echo '<strong class="title">'.$gold_title.'</strong>'; ?>
					<?php if($title) echo '<h2>'.$title.'</h2>'; ?>
					<?php echo $description; ?>
				</div>
			<?php } ?>
			<div class="col-md">
				<img class="divider-vertical" src="<?php echo get_template_directory_uri() ?>/images/divider-vertical.jpg" alt="divider">
				<ul class="filter-list">
					<?php $points = array(); $i=0;
					while(have_rows('categories')){ the_row();
						$_name = get_sub_field('name'); ?>
						<li <?php if($i == 0) echo 'class="active"'; ?>><a href="#"><?php echo $_name; ?></a></li>
						<?php
						if(have_rows('locations')){
							while(have_rows('locations')){ the_row();
								$_address = get_sub_field('address');
								$address = $_address ? '<address>'.$_address.'</address>' : '';
								$coordinates = get_sub_field('coordinates');
								// $coordinates = is_array($coordinates) ? '<span class="coordinates hidden">'.implode(', ',$coordinates).'</span>' : '';
								$coordinates = $coordinates && is_array($coordinates) ? '<span class="coordinates hidden">'.implode(', ', array_reverse($coordinates)).'</span>' : '';
								//$direction = get_sub_field('direction') ? '<span class="direction hidden">'.get_sub_field('direction').'</span>' : '';

								$directions = array(
									'url'=>'https://www.google.com/maps?daddr='.urlencode(strip_tags($_address)),
									'title'=>'Get Directions',
									'target'=>'_blank'
								);
								$directions = (BaseACFLinkHelper::isLink($directions)) ? BaseACFLinkHelper::getLink( $directions, array( 'directions' )) : '';

								$name = get_sub_field('name');
								$link = array(
									'url'=>get_sub_field('link'),
									'title'=>'Website',
									'target'=>'_blank'
								);
								$link = (BaseACFLinkHelper::isLink($link)) ? BaseACFLinkHelper::getLink( $link, array( 'link' )) : '';

								$points[] = '<div class="services-card">
													<h5>'.$name.'</h5>
													'.get_sub_field('description').'
													'.$address.'
													'.$link.'
													'.$coordinates.'
													<span class="category hidden">'.$_name.'</span>
													</ion-icon> '.$directions.'
												</div>';
							}
						} ?>
						<?php $i++;
					} ?>
				</ul>
			</div>
		</div>
		<?php if(is_array($points) && !empty($points) && !is_admin()){ ?>
		<div class="search-holder bottom-panel">
			<div class="search-container">
				<div class="col-sm">
					<div class="heading">
						<img class="divider-vertical" src="<?php echo get_template_directory_uri() ?>/images/divider-vertical.jpg" alt="divider">
						<h3 class="title-category"></h3>
					</div>
					<div class="card-wrapp">
						<?php echo implode(' ', $points); ?>
					</div>
				</div>
				<div class="col-md">
					<div class="map-container">
						<script type="text/html" id="popup_tmpl">
							<h5><%=title%></h5>
							<address><%=address%></address>
							<a class="btn-direction" target="_blank" href="<%=directions%>"><?php _e('Directions'); ?></a>
						</script>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</section>
	<?php } else{
		if($gold_title || $title || $description){ ?>
			<div class="col-sm">
				<?php if($gold_title) echo '<strong class="title">'.$gold_title.'</strong>'; ?>
				<?php if($title) echo '<h2>'.$title.'</h2>'; ?>
				<?php echo $description; ?>
			</div>
		<?php }
		echo '<p><em>Map and Tab Categories will be shown on front end.</em></p>';
	} ?>
<?php } ?>
