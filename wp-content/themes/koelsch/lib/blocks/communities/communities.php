<div class="community-section" data-markers="<?php echo get_template_directory_uri(); ?>/assets/data/map-data.json" data-template="popup_tmpl">
	<div class="section-wrapp">
		<div class="community-popup">
			<div class="map-container">
			</div>
		</div>
	</div>
	<section class="section">
		<div class="container-md">
			<?php if ( $title = get_field( 'title' ) ): ?>
				<h3><?php echo $title; ?></h3>
			<?php endif; ?>
			<div class="row row-sm communities-section" data-json="<?php echo get_template_directory_uri(); ?>/assets/data/map-data.json" data-template="item_tmpl">
				<script type="text/html" id="item_tmpl">
					<div class="col">
						<div class="card-community">
							<div class="card-img">
								<a href="<%=url%>"><img src="<?php echo get_template_directory_uri(); ?>/assets/<%=image%>" alt="image description"></a>
							</div>
							<div class="card-body">
								<div class="card-head">
									<h4><%=community%></h4>
									<strong class="distance"><%=distance%>mi</strong>
								</div>
								<p><%=address%></p>
								<% if (description !== '') { %>
								<em class="card-category"><%=description%></em>
								<% } %>
							</div>
						</div>
					</div>
				</script>
			</div>
		</div>
	</section>
</div>
