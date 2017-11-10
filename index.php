<?php get_header(); ?>

	<div id="wrapper">

		<?php 
		$image_query = new WP_Query( "name=images" );
		if ( $image_query->have_posts() ) :
			while ( $image_query->have_posts() ) : $image_query->the_post(); ?>
				
				<ul id="images_wrapper">

					<?php 
					// LOOP THROUGH IMAGES
					if ( have_rows("images") ) {
						while ( have_rows("images") ) : the_row("image"); ?>

							<li class="image_wrapper">
								<?php 
								// IMAGE
								image_object( get_sub_field("image") ); ?>

								<div class="image_info">

									<?php 
									// INFO : IF NO ATTACHED INFO
									if ( !get_sub_field("text") ) {
										// GET IMAGE TITLE
										$img = get_sub_field("image");
										echo $img["filename"];
									} else {
										// SHOW INFO
										the_sub_field("text");
									} ?>

								</div>

							</li>

						<?php 
						endwhile;
					} // END OF IMAGES LOOP ?>

				</ul>

			<?php	
			endwhile;
		endif;
		?>

	</div>

<?php get_footer(); ?>