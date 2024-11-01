<?php 
 
 //This function initializes the meta box.
 function ytc_map_route_meta_box() {    
           add_meta_box ( 
           	  'ytc_map_route_meta_box', 
           	  __('Map Route(Google Map or Image)', 'yala-travel-companion') , 
           	  'ytc_map_route', 
           	  'product',
           	  'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
				'default'// Priority relative to other metaboxes
           );

 }
 
 //Displaying the meta box
 function ytc_map_route($post) {          
      $content = get_post_meta($post->ID, 'ytc_map_route', true);
      
      //This function adds the WYSIWYG Editor 
      wp_editor ( 
      	$content , 
      	'ytc_map_route', 
      	array ( "media_buttons" => true ) 
      );
 }
  
 //This function saves the data you put in the meta box
 function ytc_map_route_save_postdata($post_id) {
        
    if( isset( $_POST['ytc_map_route_nonce'] ) ) {

        //Not save if the user hasn't submitted changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
        } 

        // Verifying whether input is coming from the proper form
        if ( ! wp_verify_nonce ( $_POST['ytc_map_route_nonce'] ) ) {
        return;
        } 

       if( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
       }
        
    } 

    if (!empty($_POST['ytc_map_route'])) {
        $ytc_allowed_html = ytc_allowed_html();
        $data             = wp_kses($_POST['ytc_map_route'],$ytc_allowed_html);
        update_post_meta($post_id, 'ytc_map_route', $data);
    }
 }
 
add_action('save_post', 'ytc_map_route_save_postdata');

add_action('admin_init', 'ytc_map_route_meta_box');

?>