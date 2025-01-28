<?php
/**Template Name: Blog */
get_header('new');
?>
<!-- Blog section -->
    <section class="news_section">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                <?php the_field('blog_heading', 167);?>
                </h2>
            </div>
            <div class="row">
                <?php
                $wpfeature=array(
                    'post_type'=>'post',
                    'orderby'    => 'date',
                    'post_status' => 'publish',
                    'order'    => 'ASC',
                    'posts_per_page' => 3,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
                );
                $featurequery=new Wp_Query($wpfeature);
                while($featurequery->have_posts()){
                    $featurequery->the_post();
                    $imagepath=wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
                ?>
                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            <img src="<?php echo $imagepath[0];?>" class="box-img" alt="">
                        </div>
                        <div class="detail-box">
                            <h4>
                                <?php echo the_title();?>
                            </h4>
                            <?php echo the_content();?>
                            <a href="">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </section>
    <!-- end Blog section -->
<?php
get_footer();
?>