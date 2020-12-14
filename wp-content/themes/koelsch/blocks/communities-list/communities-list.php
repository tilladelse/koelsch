<?php
$username = 'webuser';
$password = 'J7r4MdRUPE7F';
$context = stream_context_create(array (
    'http' => array (
        'header' => 'Authorization: Basic ' . base64_encode("$username:$password")
    )
));
$data = file_get_contents( get_template_directory_uri() . '/assets/inc/map-data.json' , false, $context);
$data = json_decode( $data );
?>
<section class="section section-alt">
	<div class="container-md">
		<?php if ( $title = get_sub_field( 'title' ) ): ?>
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
											<li><?php echo $marker->community; ?> <?php _e('Inn','genesis'); ?>
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
</section>