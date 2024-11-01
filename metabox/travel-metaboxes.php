<?php
/**
 * Create the metabox
 * @link https://developer.wordpress.org/reference/functions/add_meta_box/
 */
function ytc_additional_info_create_metabox() {
	add_meta_box(
		'ytc_additional_info_metabox', // Metabox ID
		'Additional info', // Title to display
		'ytc_additional_info_render_metabox', // Function to call that contains the metabox content
		'product', // Post type to display metabox on
		'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
		'default'// Priority relative to other metaboxes
	);
}
add_action( 'add_meta_boxes', 'ytc_additional_info_create_metabox' );

/**
 * Create the metabox default values
 * This allows us to save multiple values in an array, reducing the size of our database.
 * Setting defaults helps avoid "array key doesn't exit" issues.
 * @todo
 */
function ytc_additional_info_metabox_defaults() {
	return array(
		'group_size' => '',
		'trip_duration' => '',
		'trekking_duration'=>'',
		'max_altitude' => '',
		'difficulty' => '',
		'best_season'=>'',
		'accomodation' => '',
		'remoteness' =>'',
		'restricted_permits' => '',
		'required_permits' => ''
	);
}
/**
 * Render the metabox markup
 * This is the function called in `ytc_additional_info_create_metabox()`
 */
function ytc_additional_info_render_metabox($post) {
	
	$saved = get_post_meta( $post->ID, 'ytc_additional_info', true ); // Get the saved values
	$defaults = ytc_additional_info_metabox_defaults(); // Get the default values
	$details = wp_parse_args( $saved, $defaults ); // Merge the two in case any fields don't exist in the saved data
	?>
		<style>
  		.repeater-section div{
  			padding: 10px 0 10px 0px;
  		}	

  		.repeater-section .item{
  			display: flex;
  		}
		
		.repeater-section .w70{
  			width: 70%;
  		}
		.w20{
			width:30%;
		}
  	</style>
	<div class="repeater-section">
		<div class="item">
			<label for="ytc_additional_info_custom_metabox_group_size" class="w20">
				<?php
				esc_attr_e( 'Group Size', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[group_size]" id="group_size" value="<?php echo esc_attr( $details['group_size'] ); ?>" class="w70">
		</div>

		<div class="item">
			<label for="ytc_additional_info_custom_metabox_trip_duration" class="w20">
				<?php
				esc_attr_e( 'Trip Duration (10 Nights/ 11 Days)', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[trip_duration]" id="trip_duration" value="<?php echo esc_attr( $details['trip_duration'] ); ?>" class="w70">
		</div>

		<div class="item">
			<label for="ytc_additional_info_custom_metabox_trekking_duration" class="w20">
				<?php
				esc_attr_e( 'Trekking duration', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[trekking_duration]" id="trekking_duration" value="<?php echo esc_attr( $details['trekking_duration'] ); ?>" class="w70">
		</div>
		<!-- Max altitude -->
		<div class="item">
			<label for="ytc_additional_info_custom_metabox_max_altitude" class="w20">
				<?php
				esc_attr_e( 'Max Altitude', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[max_altitude]" id="max_altitude" value="<?php echo esc_attr( $details['max_altitude'] ); ?>" class="w70">
		</div>		

		<div class="item">
			<label for="ytc_additional_info_custom_metabox_difficulty" class="w20">
				<?php
				esc_attr_e( 'Difficulty', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[difficulty]" id="difficulty"
			value="<?php echo esc_attr( $details['difficulty'] ); ?>" class="w70">
		</div>

		<div class="item">
			<label for="ytc_additional_info_custom_metabox_best_season" class="w20">
				<?php
				esc_attr_e( 'Best season', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[best_season]" id="best_season"
			value="<?php echo esc_attr( $details['best_season'] ); ?>" class="w70">
		</div>

		<div class="item">
			<label for="ytc_additional_info_custom_metabox_accomodation" class="w20">
				<?php
				esc_attr_e( 'Accomodation', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[accomodation]" id="accomodation"
			value="<?php echo esc_attr( $details['accomodation'] ); ?>" class="w70">
			
		</div>

		<div class="item">
			<label for="ytc_additional_info_custom_metabox_remoteness" class="w20">
				<?php
				esc_attr_e( 'Remoteness', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[remoteness]" id="remoteness"
			value="<?php echo esc_attr( $details['remoteness'] ); ?>" class="w70">
		</div>
		
		<div class="item">
			<label for="ytc_additional_info_custom_metabox_restricted_permits" class="w20">
				<?php
				esc_attr_e( 'Restricted Permits', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[restricted_permits]" id="restricted_permits"
			value="<?php echo esc_attr( $details['restricted_permits'] ); ?>" class="w70">
		</div>
		
		<div class="item">
			<label for="ytc_additional_info_custom_metabox_required_permits" class="w20">
				<?php
				esc_attr_e( 'Required permits', 'yala-travel-companion' );
				?>
			</label>
			<input type="text" name="ytc_additional_info_custom_metabox[required_permits]" id="required_permits"
			value="<?php echo esc_attr( $details['required_permits'] ); ?>" class="w70">
		</div>
	</div>

	<?php

	wp_nonce_field( 'ytc_additional_info_form_metabox_nonce', 'ytc_additional_info_form_metabox_process' );
}

//
// Save our data
//
/**
 * Save the metabox
 * @param  Number $post_id The post ID
 * @param  Array  $post    The post data
 */
function ytc_additional_info_save_metabox( $post_id, $post ) {
	// Verify that our security field exists. If not, bail.
	if ( !isset( $_POST['ytc_additional_info_form_metabox_process'] ) ) return;
	// Verify data came from edit/dashboard screen
	if ( !wp_verify_nonce( $_POST['ytc_additional_info_form_metabox_process'], 'ytc_additional_info_form_metabox_nonce' ) ) {
		return $post->ID;
	}
	// Verify user has permission to edit post
	if ( !current_user_can( 'edit_post', $post->ID )) {
		return $post->ID;
	}
	// Check that our custom fields are being passed along
	// This is the `name` value array. We can grab all
	// of the fields and their values at once.
	if ( !isset( $_POST['ytc_additional_info_custom_metabox'] ) ) {
		return $post->ID;
	}
	/**
	 * Sanitize all data
	 * This keeps malicious code out of our database.
	 */
	// Set up an empty array
	$sanitized = array();
	// Loop through each of our fields
	foreach ( $_POST['ytc_additional_info_custom_metabox'] as $key => $detail ) {
		// Sanitize the data and push it to our new array
		// `wp_filter_post_kses` strips our dangerous server values
		// and allows through anything you can include a post.
		$sanitized[$key] = wp_filter_post_kses( $detail );
	}
	// Save our submissions to the database
	update_post_meta( $post->ID, 'ytc_additional_info', $sanitized );
}
add_action( 'save_post', 'ytc_additional_info_save_metabox', 1, 2 );
//
// Save a copy to our revision history
// This is optional, and potentially undesireable for certain data types.
// Restoring a a post to an old version will also update the metabox.
/**
 * Save additional_infos data to revisions
 * @param  Number $post_id The post ID
 */
function ytc_additional_info_save_revisions( $post_id ) {
	// Check if it's a revision
	$parent_id = wp_is_post_revision( $post_id );
	// If is revision
	if ( $parent_id ) {
		// Get the saved data
		$parent = get_post( $parent_id );
		$details = get_post_meta( $parent->ID, 'ytc_additional_info', true );
		// If data exists and is an array, add to revision
		if ( !empty( $details ) && is_array( $details ) ) {
			// Get the defaults
			$defaults = ytc_additional_info_metabox_defaults();
			// For each default item
			foreach ( $defaults as $key => $value ) {
				// If there's a saved value for the field, save it to the version history
				if ( array_key_exists( $key, $details ) ) {
					add_metadata( 'post', $post_id, 'ytc_additional_info_' . $key, $details[$key] );
				}
			}
		}
	}
}
add_action( 'save_post', 'ytc_additional_info_save_revisions' );
/**
 * Restore additional_infos data with post revisions
 * @param  Number $post_id     The post ID
 * @param  Number $revision_id The revision ID
 */
function ytc_additional_info_restore_revisions( $post_id, $revision_id ) {
	// Variables
	$post = get_post( $post_id ); // The post
	$revision = get_post( $revision_id ); // The revision
	$defaults = ytc_additional_info_metabox_defaults(); // The default values
	$details = array(); // An empty array for our new metadata values
	// Update content
	// For each field
	foreach ( $defaults as $key => $value ) {
		// Get the revision history version
		$detail_revision = get_metadata( 'post', $revision->ID, 'ytc_additional_info_' . $key, true );
		// If a historic version exists, add it to our new data
		if ( isset( $detail_revision ) ) {
			$details[$key] = $detail_revision;
		}
	}
	// Replace our saved data with the old version
	update_post_meta( $post_id, 'ytc_additional_info', $details );
}
add_action( 'wp_restore_post_revision', 'ytc_additional_info_restore_revisions', 10, 2 );
/**
 * Get the data to display on the revisions page
 * @param  Array $fields The fields
 * @return Array The fields
 */
function ytc_additional_info_get_revisions_fields( $fields ) {
	// Get our default values
	$defaults = ytc_additional_info_metabox_defaults();
	// For each field, use the key as the title
	foreach ( $defaults as $key => $value ) {
		$fields['ytc_additional_info_' . $key] = ucfirst( $key );
	}
	return $fields;
}
add_filter( '_wp_post_revision_fields', 'ytc_additional_info_get_revisions_fields' );
/**
 * Display the data on the revisions page
 * @param  String|Array $value The field value
 * @param  Array        $field The field
 */
function ytc_additional_info_display_revisions_fields( $value, $field ) {
	global $revision;
	return get_metadata( 'post', $revision->ID, $field, true );
}
add_filter( '_wp_post_revision_field_my_meta', 'ytc_additional_info_display_revisions_fields', 10, 2 );