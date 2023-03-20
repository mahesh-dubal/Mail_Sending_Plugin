<?php
/*
Plugin Name: Mail Sending Plugin using cron job
Plugin URI: mail-plugin.org/plugins
Description: A simple WordPress plugin that executes many times in a certain interval.
Version: 1.0.0
Author: Mahesh Dubal
Author URI: https://www.mahesh.dubal.xyz/
License: GPL2
*/

//To register schedule after plugin activation
register_activation_hook( __FILE__, 'register_schedule');


function register_schedule() {
  if (!wp_next_scheduled('my_daily_event')) {
    wp_schedule_event(time(), '1minutes', 'my_daily_event');
  }
}

// add_action('my_daily_event', 'send_mail_to_admin');

// function send_mail_to_admin() {
   
//  //wp_mail('dev-email@wpengine.local', 'Morning Message', 'Good Morning! Have a nice day. :)');
// }

// register_deactivation_hook( __FILE__, 'remove_schedule');

// function remove_schedule() {
//   wp_clear_scheduled_hook('my_daily_event');
// }

// add_filter('cron_schedules', 'custom_cron_schedules');

// function custom_cron_schedules($schedules) {
//   if (!isset($schedules['1minutes'])) {
//     $schedules['1minutes'] = array(
//       'interval' => 60,
//       'display' => __('Once every 1 minute'));
//   }
  
//   return $schedules;
// }