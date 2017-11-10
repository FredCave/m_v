<?php

	add_action( 'wp_ajax_similarity', 'get_similarity' );
	add_action( 'wp_ajax_nopriv_similarity', 'get_similarity' );

	function get_similarity () {

		// IF NO INPUT DATA
		if ( !isset( $_REQUEST ) ) {
			return;
		}

		include_once('phasher.class.php');
		$I = PHasher::Instance();

		// INPUT IS ID OF SELECTED IMAGE
    	$imgId = $_REQUEST['id'];
    	$orig_url = wp_get_attachment_image_src( $imgId, "thumbnail" );
    	$orig_file = "../wp-content/uploads/" . explode( "uploads/", $orig_url )[1];
    	// GET HASH
    	$orig_hash = $I->FastHashImage( $orig_file, $size=16 );

		// LOOP THROUGH IMAGES: COMPARE TO INPUT IMAGE
    	$data = array();

    	$query = new WP_Query("name=images");
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				// START OF ACF LOOP
				if ( have_rows("images") ) :
					while ( have_rows("images") ) : the_row();

						// GET SAVED HASH
						$saved_hash = get_sub_field("hash");
						// COMPARE TO CLICKED IMAGE
						$compare_value = $I->CompareHashes( $orig_hash, $saved_hash );
						// SAVE TO ARRAY
						$img_data = array(
							'id'			=> get_sub_field("image")["id"],
							'similarity'	=> $compare_value
						);
						$data[] = $img_data;

					endwhile;
				endif;
				// END OF ACF LOOP
			endwhile;
			wp_reset_postdata();
		endif;    	

		// RETURN DATA OBJECT: IMG ID & SIMILARITY VALUE
    	echo json_encode($data);

	    // ALWAYS DIE IN FUNCTIONS ECHOING AJAX CONTENT
	    wp_die();

	}

?>