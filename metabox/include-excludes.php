<?php 
 
 //This function initializes the meta box.
 function ytc_include_exclude_meta_box() {    
   add_meta_box ( 
   	  'ytc_include_exclude_meta_box', 
   	  __('Include/Excludes', 'yala-travel-companion') , 
   	  'ytc_include_exclude', 
   	  'product',
   	  'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
	    'default' // Priority relative to other metaboxes
   );
 }
 
 //Displaying the meta box
 function ytc_include_exclude($post) {          
      $content = get_post_meta($post->ID, 'ytc_include_exclude', true);
      
      //This function adds the WYSIWYG Editor 
      wp_editor ( 
      	$content , 
      	'ytc_include_exclude', 
      	array ( "media_buttons" => true ) 
      );
 }
  
 //This function saves the data you put in the meta box
 function ytc_include_exclude_save_postdata($post_id) {
        
    if( isset( $_POST['ytc_include_exclude_nonce'] ) ) {

        //Not save if the user hasn't submitted changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
        } 

        // Verifying whether input is coming from the proper form
        if ( ! wp_verify_nonce ( $_POST['ytc_include_exclude_nonce'] ) ) {
        return;
        } 

        // Making sure the user has permission
       if( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
       }

    } 

    if (!empty($_POST['ytc_include_exclude'])) {
        $ytc_allowed_html = ytc_allowed_html();
        $data             = wp_kses($_POST['ytc_include_exclude'],$ytc_allowed_html);
        update_post_meta($post_id, 'ytc_include_exclude', $data);
        
    }
 }
 
add_action('save_post', 'ytc_include_exclude_save_postdata');

add_action('admin_init', 'ytc_include_exclude_meta_box');

?>