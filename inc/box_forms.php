<div class="sliderimg__box">
  <style scoped>
    .sliderimg__box{
      display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
    }
    p{
      display: contents;
    }
  </style>
  <p>
    <label for="slider_img_url">Slider Image URL</label>
    <input type="text" name="slider_img_url" id="slider_img_url" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'slider_img_url', true ) ); ?>">
  </p>
  <p>
    <label for="slider_alt">Slider Alt</label>
    <input type="text" name="slider_alt" id="slider_alt" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'slider_alt', true ) ); ?>">
  </p>

</div>
