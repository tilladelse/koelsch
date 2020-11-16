	<?php if ( $title = get_field( 'title' ) ): ?>
		<h3><?php echo $title; ?></h3>
	<?php endif; ?>
	<div class="row row-sm communities-section" data-json="<?php echo get_template_directory_uri(); ?>/assets/data/map-data.json" data-template="item_tmpl">
		<script type="text/html" id="item_tmpl">
			<div class="col">
				<div class="card-community">
					<div class="card-img">
						<a href="<%=url%>"><img src="<%=image%>" alt="image description"></a>
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
