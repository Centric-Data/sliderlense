<?php
    /**
     * @package slides
     */
?>
<?php

    $args = array(
        'post_type'         =>  'slider_images',
        'post_status'       =>  'publish',
        'posts_per_page'    =>  5,
        'order'             =>  'DESC',
    );

    $query  =  new WP_Query( $args );

?>

<section>
        <div class="slider__wrapper">
          <div class="slider__hero--img animate__animated animate__fadeInRight">
              <?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    $imgsrc = esc_attr( get_post_meta( get_the_ID(), 'slider_img_url', true ) );
                    $imgalt = esc_attr( get_post_meta( get_the_ID(), 'slider_alt', true ) );
                ?>
                <img class="fill" src="<?php echo $imgsrc; ?>" alt="<?php echo $imgalt; ?>">
                <?php endwhile; else: echo esc_html__( 'Sorry, no slides for the slider', 'sliderlense' ); endif; ?>
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
