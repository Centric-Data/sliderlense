console.log( 'Slider js loaded!' );

// $ = jQuery.noConflict(true);

jQuery(document).ready(function( $ ){
  $('.slider__hero--img').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
  });
});
