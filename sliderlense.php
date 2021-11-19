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
Description: This is a custom carousel plugin, it can be embedded using a plugin shortcode, slider-lense on the homepage, in the hero section. Its using Slick, a jQuery plugin
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

  public function __construct()
  {
    // Enqueue Scripts.
    add_action( 'wp_enqueue_scripts', array( $this, 'sl_load_assets' ) );

    // Add shortcode.
    add_shortcode( 'slider-lense', array( $this, 'sl_load_shortcode' ) );
  }

  // Load Assets.
  public function sl_load_assets(){
    wp_enqueue_script("jquery");
    // Register Styles & Scripts.
    wp_register_style( 'sliderlense-css', SL_PLUGIN_URL . 'css/sliderlense.css', [], time(), 'all' );
    wp_register_style( 'slick-lense-css', SL_PLUGIN_URL . 'css/slick/slick.css', [], false, 'all' );
    wp_register_style( 'slick-theme-lense-css', SL_PLUGIN_URL . 'css/slick/slick-theme.css', ['slick-lense-css'], false, 'all' );
    wp_register_style( 'animate-css', SL_PLUGIN_URL . 'css/animate/animate.min.css', [], '4.1.1', 'all' );
    wp_register_script( 'slick-lense-js', SL_PLUGIN_URL . 'js/slick/slick.js', ['jquery'], false, true );
    wp_register_script( 'sliderlense-js', SL_PLUGIN_URL . 'js/sliderlense.js', ['jquery', 'slick-lense-js'], time(), 'all' );

    // Enqqueue Scripts & Styles
    wp_enqueue_style( 'slick-lense-css' );
    wp_enqueue_style( 'slick-theme-lense-css' );
    wp_enqueue_style( 'sliderlense-css' );
    wp_enqueue_style( 'animate-css' );
    wp_enqueue_script( 'slick-lense-js' );
    wp_enqueue_script( 'sliderlense-js' );

  }

  // Shortcode function
  public function sl_load_shortcode(){
    ?>
      <section>
        <div class="slider__wrapper">
          <div class="slider__hero--img animate__animated animate__fadeInRight">
              <img class="fill" src="<?php echo SL_PLUGIN_URL ?>img/slide01.jpg" alt="Harvestor">
              <img class="fill" src="<?php echo SL_PLUGIN_URL ?>img/slide02.jpg" alt="In the Field">
              <img class="fill" src="<?php echo SL_PLUGIN_URL ?>img/slider03.jpg" alt="On Tour">
              <img class="fill" src="<?php echo SL_PLUGIN_URL ?>img/slider04.jpg" alt="On Tour">
              <img class="fill" src="<?php echo SL_PLUGIN_URL ?>img/slider05.jpg" alt="On Work">
          </div>
          <div class="slider__hero--desc animate__animated animate__fadeInDown">
            <div class="slider__hero--caption">
              <div class="slider__hero--caption-info">
                <h2>Welcome to Zimbabwe Land Commission</h2>
                <p>Zimbabwe Land Commission is a Centre of Excellence in Equitable and Sustainable Land Administration and Management.</p>
              </div>
              <div class="slider__hero--controls">
                <div class="readmore">
                  <a class="readmore--post" href="<?php echo bloginfo( 'url' ) . '/mandate-and-strategic-direction'; ?>">Read More</a>
                </div>
                <div class="slider__hero--buttons">
                  <a class="left__control" href="#"><span class="material-icons">arrow_back</span></a>
                  <a class="right__control" href="#"><span class="material-icons">arrow_forward</span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php
  }

}

new SliderLense;
?>
