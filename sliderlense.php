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

    // Create Meta Boxes in CPT slider_images
    add_action( 'add_meta_boxes', array( $this, 'sl_custom_meta_boxes' ) );

    // Register a CPT
    add_action( 'init', array( $this, 'sl_slider_cpt' ) );

    // CPT Custom Columns
    add_filter( 'manage_slider_images_posts_columns', array( $this, 'sl_slides_columns' ) );

    // Save Meta Box Data
    add_action( 'save_post', array( $this, 'sl_save_meta_box' ) );

    // Fetch Meta Data
    add_action( 'manage_slider_images_posts_custom_column', array( $this, 'sl_custom_column_data' ), 10, 2 );

    // Register REST Route
    add_filter( 'rest_route_for_post', array( $this, 'sl_rest_route_cpt' ), 10, 2 );

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

  // Create meta boxes
  public function sl_custom_meta_boxes(){
    add_meta_box( 'slider_fields', __( 'Slider Image' ), array( $this, 'sl_render_sliderimgbox' ), 'slider_images', 'advanced', 'high' );
  }

  // Render Meta-boxes html
  public function sl_render_sliderimgbox( $post ){
    include( SL_LOCATION . '/inc/box_forms.php' );
  }

  // Shortcode function
  public function sl_load_shortcode(){
    include( SL_LOCATION . '/inc/shortcodehtml.php' );
  }

  // Register a route
  public function sl_rest_route_cpt( $route, $post ){
    if ( $post->post_type === 'slider_images' ) {
      $route = '/wp/v2/slides/' . $post->ID;
    }
    return $route;
  }

  // Create a CPT
  public function sl_slider_cpt(){
    $labels = array(
      'name'        =>  _x( 'Slides', 'Post type general name', 'sliderlense' ),
      'singular'    =>  _x( 'Slide', 'Post type singular', 'sliderlense' ),
      'menu_name'   =>  _x( 'Slides', 'Admin Menu Text', 'sliderlense' ),
      'name_admin_bar'  =>  _x( 'Slide', 'Add New on Toolbar', 'sliderlense' ),
      'add_new'         =>  __( 'Add New', 'sliderlense' ),
      'add_new_item'    =>  __( 'Add New Slide', 'sliderlense' ),
      'new_item'        =>  __( 'New Slide' ),
      'edit_item'       =>  __( 'Edit Slide', 'sliderlense' ),
      'view_item'       =>  __( 'View Slide', 'sliderlense' ),
      'all_items'       =>  __( 'All Slides', 'sliderlense' ),
    );
    $args   = array(
      'labels'          =>  $labels,
      'public'          =>  true,
      'has_archive'     =>  'slider_images',
      'rewrite'         =>  array(
        'slug'          =>  'slider_images/%slidescat%',
        'with_front'    =>  FALSE
      ),
      'hierarchical'    =>  false,
      'show_in_rest'    =>  true,
      'rest_base'       =>  'slides',
      'rest_controller_class' =>  'WP_REST_Posts_Controller',
      'supports'        =>  array( 'title', 'editor' ),
      'capability_type' =>  'post',
      'menu_icon'       =>  'dashicons-cover-image'
    );
    register_post_type( 'slider_images', $args );
  }

  // Custom Slides CPT Columns
  public function sl_slides_columns( $columns ){
    $newColumns = array();
      $newColumns['title'] = 'Slide Title';
      $newColumns['details'] = 'Slide Description';
      $newColumns['date'] = 'Date';

      return $newColumns;
  }

  // Save data from meta boxes
  public function sl_save_meta_box( $post_id ){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( $parent_id = wp_is_post_revision( $post_id ) ){
      $post_id = $parent_id;
    }
    $fields = [
      'slider_img_url',
      'slider_alt'
    ];
    foreach ( $fields as $field ) {
      if ( array_key_exists( $field, $_POST ) ) {
        update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
      }
    }
  }

  // Fetch and populate slider data
  public function sl_custom_column_data( $column, $post_id ){
    switch ( $column ) {
      case 'details':
        echo get_the_excerpt();
        break;
      default:
        # code...
        break;
    }
  }

}

new SliderLense;
?>
