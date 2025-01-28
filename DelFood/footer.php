<div class="footer_container">
    <!-- info section -->
    <section class="info_section ">
      <div class="container">
        <div class="contact_box">
          <a href="<?php echo get_option('address');?>">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
          </a>
          <a href="tel:<?php echo get_option('phone');?>">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </a>
          <a href="mailto:<?php echo get_option('email');?>">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </a>
        </div>
        <div class="info_links">
         <?php
            wp_nav_menu(
              array(
                'theme_location'    =>  'header-menu',
                'container'         =>  'nav',
                'menu_class'        =>  'footer-menu'
                // 'fallback_cb'       =>  '__return_false',
                // 'walker'            =>  new bootstrap_5_wp_nav_menu_walker()
              )
            );
          ?>
        </div>
        <div class="social_box">
          <a href="<?php echo get_option('facebook');?>">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="<?php echo get_option('twitter');?>">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a href="<?php echo get_option('linkedin');?>">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>
    <!-- end info_section -->
<!-- footer section -->
<footer class="footer_section">
      <div class="container">
        <p>
          &copy; <?php echo date('Y');?> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a><br>
          Developed By: <a href="javascript:void(0)">Wordpress Developer</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->
<?php wp_footer();?>
  </div>
</body>
</html>