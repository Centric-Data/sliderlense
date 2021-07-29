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

// const heroDesc = document.querySelector('.slider__hero--caption');
//
// setTimeout( () => {
//   heroDesc.style.backgroundColor = 'black';
// }, 4000 );
//
// setTimeout( () => {
//   heroDesc.style.backgroundColor = 'red';
// }, 8000 );
