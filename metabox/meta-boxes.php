<?php

/**
 * @package Yala_Travel_Companion
 */

add_action('admin_init', 'ytc_add_meta_boxes', 1);

function ytc_add_meta_boxes() {
	add_meta_box( 'Itinerary Fields', 'Itinerary Builder', 'ytc_repeatable_meta_box_display', 'product', 'normal','default');
}

function ytc_repeatable_meta_box_display() {

	global $post;

	$ytc_itinerary_repeatable_fields = get_post_meta($post->ID, 'ytc_itinerary_repeatable_fields', true);
	
	wp_nonce_field( 'ytc_repeatable_meta_box_nonce', 'ytc_repeatable_meta_box_nonce' );
	?>
	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-row screen-reader-text' );
			row.insertBefore( '#repeatable-fieldset-one div:last' );
			return false;
		});
  	
		$( '.remove-row' ).on('click', function() {
			$(this).parents('.repeater-section').remove();
			return false;
		});
	});
	</script>
  	<style>
  		.repeater-section div{
  			padding: 10px 0 10px 0px;
  		}	

  		.repeater-section .item{
  			display: flex;
  		}

		.w20{
			width:20%;
		}
  	</style>
	<div id="repeatable-fieldset-one" width="100%">
	<?php
	
	if ( $ytc_itinerary_repeatable_fields ) :
	
	foreach ( $ytc_itinerary_repeatable_fields as $field ) {
	?>
	<div class="repeater-section">
		<div class="item">
			<label for="name" class="w20"><?php esc_html_e('Title','yala-travel-companion');?></label>
			<input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" />
		</div>
		<div class="item">
			<label for="description"  class="w20"><?php esc_html_e('Description','yala-travel-companion');?></label>
			<textarea class="widefat" name="desc[]"><?php echo wp_kses_post($field['desc']); ?></textarea>
		</div>
		<div>
			<td><a class="button remove-row" href="#"><?php esc_html_e('Remove','yala-travel-companion');?></a></td>
		</div>
	</div>
	<?php
	}
	else :
	// show a blank one
	?>
	<div class="repeater-section">
		<div class="item">
			<label for="name" class="w20"><?php esc_html_e('Title','yala-travel-companion');?></label>
			<input type="text" class="widefat" name="name[]" />
		</div>
		<div class="item">
			<label for="description" class="w20"><?php esc_html_e('Description','yala-travel-companion');?></label>
			<textarea class="widefat" name="desc[]"></textarea>
		</div>
		<div>
			<a class="button remove-row" href="#"><?php esc_html_e('Remove','yala-travel-companion');?></a>
		</div>
	</div>
	<?php endif; ?>
	<div class="repeater-section">
	<!-- empty hidden one for jQuery -->
		<div class="empty-row item screen-reader-text">
			<label for="name" class="w20"><?php esc_html_e('Title','yala-travel-companion');?></label>
			<input type="text" class="widefat" name="name[]" />
		</div>
		<div class="empty-row item screen-reader-text">
			<label for="description" class="w20"><?php esc_html_e('Description','yala-travel-companion');?></label>
			<textarea class="widefat" name="desc[]"></textarea>
		</div>
		<div class="empty-row item screen-reader-text">
			<a class="button remove-row" href="#"><?php esc_html_e('Remove','yala-travel-companion');?></a>
		</div>
	</div>
	</div>
	
	<p><a id="add-row" class="button" href="#"><?php esc_html_e('Add another','yala-travel-companion');?></a></p>
	<?php
}

add_action('save_post', 'ytc_repeatable_meta_box_save');

function ytc_repeatable_meta_box_save($post_id) {
	if ( ! isset( $_POST['ytc_repeatable_meta_box_nonce'] ) ||
	! wp_verify_nonce( $_POST['ytc_repeatable_meta_box_nonce'], 'ytc_repeatable_meta_box_nonce' ) )
		return;
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	
	if (!current_user_can('edit_post', $post_id))
		return;
	
	$old = get_post_meta($post_id, 'ytc_itinerary_repeatable_fields', true);
	$new = array();

	
	$names = isset( $_POST['name'] ) ? (array) $_POST['name'] : array();
	$descs = isset( $_POST['desc'] ) ? (array) $_POST['desc'] : array();
	
	$count = count( $names );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $names[$i] != '' ) :
			$new[$i]['name'] = sanitize_text_field( $names[$i] ); //sanitize

			if ( $descs[$i] == '' )
				$new[$i]['desc'] = '';
			else
				$new[$i]['desc'] = sanitize_textarea_field( $descs[$i] ); //sanitize
		endif;
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'ytc_itinerary_repeatable_fields', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'ytc_itinerary_repeatable_fields', $old );
}
?>