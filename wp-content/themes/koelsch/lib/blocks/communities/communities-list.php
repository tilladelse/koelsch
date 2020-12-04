<?php
$data = file_get_contents( get_template_directory_uri() . '/assets/data/map-data.json');
$data = json_decode( $data );
$blockClasses = 'community-list';
$blockClasses .= isset($block['className']) ? ' '.$block['className'] : '';
?>
<div class="<?php echo $blockClasses;?>">
		<?php if ( $title = get_field( 'title' ) ): ?>
			<h3><?php echo $title; ?></h3>
			<?php
		endif;
		if ( have_rows( 'description_list' ) ) :
			?>
			<ul class="description-list">
				<?php while ( have_rows( 'description_list' ) ) : the_row(); ?>
					<li>
						<?php if ( $abbreviation = get_sub_field( 'abbreviation' ) ): ?>
							<span class="abbr"><?php echo $abbreviation; ?></span>=
							<?php
						endif;
						if ( $text = get_sub_field( 'text' ) ):
							?>
							<em class="text"><?php echo $text; ?></em>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php
		endif;
		if ( have_rows( 'column' ) ) :
			?>
			<div class="row row-sm">
				<?php while ( have_rows( 'column' ) ) : the_row(); ?>
					<div class="col">
						<?php
						while ( have_rows( 'list' ) ) : the_row();
							if ( $state = get_sub_field( 'state' ) ):
								?>
								<h4><?php echo $state; ?></h4>
								<ul class="communities-list">
									<?php
									foreach( $data->markers as $marker ):
										if( $marker->state == $state && !empty($marker->community) ):
											?>
											<li>
												<?php echo $marker->community; ?>
												<span class="abbr abbr-outline"><?php echo $marker->careLevel; ?></span>
											</li>
											<?php
									endif;
								endforeach;
								?>
							</ul>
							<?php
						endif;
					endwhile;
					?>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>
</div>
