<?php
/**Template Name: Testimonial Page*/
if(is_page('home')){
    get_header();
}
else{
    get_header('new');
}
?>
<!-- client section -->
     <section class="client_section layout_padding">
        <div class="container">
            <div class="col-md-11 col-lg-10 mx-auto">
                <div class="heading_container heading_center">
                    <h2><?php the_field('testimonial_heading', 167);?></h2>
                </div>
                <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $wpfeature = array(
                            'post_type' => 'testimonial',
                            'orderby'    => 'date',
                            'post_status' => 'publish',
                            'order'    => 'ASC',
                            'posts_per_page' => 3,
                            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                        );
                        $featurequery = new WP_Query($wpfeature);
                        $post_count = 0; // Counter to track the post index
                        while($featurequery->have_posts()){
                        $featurequery->the_post();
                                $imagepath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            $post_count++;
                            ?>
                            <div class="carousel-item <?php echo $post_count === 2 ? 'active' : ''; ?>">
                                <div class="detail-box">
                                    <h4><?php the_title(); ?></h4>
                                    <?php the_content(); ?>
                                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                                </div>
                            </div>
                        <?php
                        wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev d-none" href="#customCarousel1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
  <!-- end client section -->
<?php
get_footer();
?>