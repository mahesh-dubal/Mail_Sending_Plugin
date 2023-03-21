<?php
/*
Plugin Name: Sending Daily Post Summary using 
Plugin URI: wordpress.org/plugins
Description: A simple WordPress plugin to send daily published post report.
Version: 1.0.0
Author: Mahesh Dubal
Author URI: https://mahesh.dubal@wisdmlabs.com/
License: GPL2
*/

register_activation_hook( __FILE__, 'register_schedule');

//Schedule register when plugin is installed
function register_schedule() {
  if (!wp_next_scheduled('my_daily_event')) {
    wp_schedule_event(time(), '1minute', 'my_daily_event');
  }
}

add_action('my_daily_event', 'send_daily_post_details');


//To unschedule event when plugin deactivated
register_deactivation_hook( __FILE__, 'remove_schedule');

function remove_schedule() {
  wp_clear_scheduled_hook('my_daily_event');
}


//Scheduling cron for every minute
add_filter('cron_schedules', 'custom_cron_schedules');

function custom_cron_schedules($schedules) {
  if (!isset($schedules['1minute'])) {
    $schedules['1minute'] = array(
      'interval' => 60,
      'display' => __('Once every minute'));
  }
 
  return $schedules;
}