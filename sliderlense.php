<?php

/**
 * Slider-Lense Carousel
 *
 * @package     Slider-Lense Carousel
 * @author      Centric Data
 * @copyright   2021 Centric Data
 * @license     GPL-2.0-or-later
 *
*/
/*
Plugin Name: Slider-Lense Carousel
Plugin URI:  https://github.com/Centric-Data/sliderlense
Description: This is a custom contact form plugin, it can be used in the contact page. Its using a two column layout, with custom css (no-blotted-frameworks)
Author: Centric Data
Version: 1.0.0
Author URI: https://github.com/Centric-Data
Text Domain: sliderlense
*/
/*
Slider-Lense Carousel is free software: you can redistribute it and/or modify it under the terms of GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.

Slider-Lense Carousel is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Contact-Lense Form.
*/

/* Exit if directly accessed */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define variable for path to this plugin file.
define( 'SL_LOCATION', dirname( __FILE__ ) );
define( 'SL_LOCATION_URL' , plugins_url( '', __FILE__ ) );
define( 'SL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 *
 */
class SliderLense
{

  public function __construct(argument)
  {
    // Enqueue Scripts.
    add_action( 'wp_enqueue_scripts', array( $this, 'sl_load_assets' ) );

    // Add shortcode.
    add_shortcode( 'slider-lense', array( $this, 'sl_load_shortcode' ) );
  }

  // Load Assets.
  public function sl_load_assets(){
    // Register Styles & Scripts.
    wp_register_style( 'sliderlense-css', SL_PLUGIN_URL . 'css/sliderlense.css', [], time(), 'all' );
    wp_register_style( 'slick-lense-css', SL_PLUGIN_URL . 'css/slick/slick.css', [], false, 'all' );
    wp_register_style( 'slick-theme-lense-css', SL_PLUGIN_URL . 'css/slick/slick-theme.css', ['slick-lense-css'], false, 'all' );
    wp_register_script( 'slick-lense-js', SL_PLUGIN_URL . 'js/slick/slick.js', ['jquery'], false, true );
    wp_register_script( 'sliderlense-js', SL_PLUGIN_URL . 'js/sliderlense.js', ['jquery', 'slick-lense-js'], time(), 'all' );

    // Enqqueue Scripts & Styles
    wp_enqueue_style( 'sliderlense-css' );
    wp_enqueue_style( 'slick-lense-css' );
    wp_enqueue_style( 'slick-theme-lense-css' );
    wp_enqueue_script( 'sliderlense-js' );
    wp_enqueue_script( 'slick-lense-js' );

  }

  // Shortcode function
  public function sl_load_shortcode(){
    ?>
      <h3>Slider shortcode here!</h3>
    <?php
  }

}


?>
