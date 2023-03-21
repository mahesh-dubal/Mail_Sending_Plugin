<?php 

//To get details of all posts published on a day
function get_daily_post_details(){

    $today = date('Y-m-d');
    $args = array(
       'post_type' => 'post',
       'post_status' => 'publish',
       'date_query' => array(
           array(
               'year' => date('Y', strtotime($today)),
               'month' => date('m', strtotime($today)),
               'day' => date('d', strtotime($today)),
           )
       )
   );

    $query = new WP_Query( $args );
    $posts = $query->posts;
    $post_details = array();

    foreach ( $posts as $post ) {

        $meta_title_of_post = get_post_meta( $post->ID, '_yoast_wpseo_title', true );
        if ( empty( $meta_description ) ) {
            $meta_title_of_post = "No Meta title found";
        }

        $meta_description = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
        if ( empty( $meta_description ) ) {
            $meta_description = "No meta description available";
        }
        
        $meta_keywords = get_post_meta( $post->ID, '_yoast_wpseo_focuskw', true );
        if ( empty( $meta_keywords ) ) {
            $meta_keywords = "No meta keywords available";
        }


        $post_data = array(
            'post_title' => $post->post_title,
            'post_url' => get_permalink( $post->ID ),
            'meta_title' => $meta_title_of_post,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'page_speed' => get_page_speed_score(get_permalink( $post->ID )),
        );
        array_push( $post_details, $post_data );
    
    }

    return $post_details;
}