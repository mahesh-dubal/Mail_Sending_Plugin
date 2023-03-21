<?php

//To send daily post details to Author
function send_daily_post_details() {
   
    $to = get_option( 'admin_email' );
    $subject = 'Daily Post Details';
    $post_details = get_daily_post_details();
    $message = '';

    foreach ( $post_details as $post_data ) {
        $message .= 'Post Title: ' . $post_data['post_title'] . "\n";
        $message .= 'Post URL: ' . $post_data['post_url'] . "\n";
        $message .= 'Meta Title: ' . $post_data['meta_title'] . "\n";
        $message .= 'Meta Description: ' . $post_data['meta_description'] . "\n";
        $message .= 'Meta Keywords: ' . $post_data['meta_keywords'] . "\n";
        $message .= 'Page Speed Score: ' . $post_data['page_speed'] . " seconds \n";
        $message .= "\n";
    }
    $headers = array(
        'From: mahesh.dubal@wisdmlabs.com',
    );

    wp_mail( $to , $subject, $message , $headers);
}