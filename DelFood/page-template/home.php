<?php
/**Template Name: Home Page*/
if(is_page('home')){
    get_header();
}
else{
    get_header('new');
}
?>
    <!-- slider section --> 
    <section class="slider_section ">
      <div class="container ">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div class="detail-box">
              <h1><?php the_field('banner_heading');?></h1>
              <p>
                <?php the_field('banner_content');?>
              </p>
            </div>
            <div class="find_container ">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <form id="restaurant-search-form">
                        <div class="form-row">
                            <div class="form-group col-lg-5">
                                <input type="text" class="form-control" id="search-name" name="s" placeholder="Restaurant Name">
                            </div>
                            <div class="form-group col-lg-3">
                                <input type="text" class="form-control" id="search-location" name="location" placeholder="All Locations">
                                <span class="location_icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="form-group col-lg-3">
                                <div class="btn-box">
                                    <button type="button" id="search-submit" class="btn">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="search-results"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider_container">
        <?php
        if(have_rows('banner_image_portion')){
            while(have_rows('banner_image_portion')){
                the_row();
        ?>
        <div class="item">
            <div class="img-box">
                <img src="<?php the_sub_field('image');?>" alt="" />
            </div>
        </div>
        <?php
            }
        }
        ?>
      </div>
    </section>
    <!-- end slider section -->
    </div>
    <!-- recipe section -->
    <section class="recipe_section layout_padding-top">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                <?php the_field('popular_recipes');?>
                </h2>
            </div>
            <div class="row">
                <?php
                    if(have_rows("food_repeater")){
                    while(have_rows("food_repeater")){
                        the_row();
                ?>
                    <div class="col-sm-6 col-md-4 mx-auto">
                        <div class="box">
                            <div class="img-box">
                                <img src="<?php the_sub_field('image');?>" class="box-img" alt="">
                            </div>
                            <div class="detail-box">
                                <?php
                                    $food_btn= get_sub_field('button');
                                ?>
                                <h4>
                                    <?php echo $food_btn['title']; ?>
                                </h4>
                                <a href="<?php echo $food_btn['url']; ?>">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="btn-box">
                <?php $ordr_btn= get_field('order_button');?>
                <a href="<?php echo $ordr_btn['url'];?>">
                <?php echo $ordr_btn['title'];?>
                </a>
            </div>
        </div>
    </section>
    <!-- end recipe section -->
    <!-- app section -->
    <section class="app_section">
        <div class="container">
            <div class="col-md-9 mx-auto">
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                        <div class="detail-box">
                            <h2><?php the_field('app_heading');?></h2>
                            <p><?php the_field('app_content');?></p>
                            <div class="app_btn_box">
                                <?php
                                if(have_rows('app_repeater')){
                                    while(have_rows('app_repeater')){
                                        the_row();
                                ?>
                                <?php $innr_btn= get_sub_field('button');?>
                                <a href="<?php echo $innr_btn['url'];?>" target="_blank" class="mr-1">
                                    <img src="<?php the_sub_field('image');?>" class="box-img" alt="">
                                </a>
                                <?php
                                    }
                                }
                                ?>                            
                            </div>
                            <?php $app_btn= get_field('download_button');?>
                            <a href="<?php echo $app_btn['url'];?>" class="download_btn" download>
                                <?php echo $app_btn['title'];?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="img-box">
                            <img src="<?php the_field('app_image');?>" class="box-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <!-- end app section -->
    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container">
            <div class="col-md-11 col-lg-10 mx-auto">
                <div class="heading_container heading_center">
                    <h2> <?php the_field('about_heading');?> </h2>
                </div>
                <div class="box">
                    <div class="col-md-7 mx-auto">
                        <div class="img-box">
                            <img src="<?php the_field('about_image');?>" class="box-img" alt="">
                        </div>
                    </div>
                    <div class="detail-box">
                        <p> <?php the_field('about_content');?> </p>
                        <?php $about_btn= get_field('about_button');?>
                        <a href="<?php echo $about_btn['url'];?>" target="_blank">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->
    <!-- Blog section -->
    <section class="news_section">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                <?php the_field('blog_heading');?>
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
    <!-- client section -->
    <section class="client_section layout_padding">
        <div class="container">
            <div class="col-md-11 col-lg-10 mx-auto">
                <div class="heading_container heading_center">
                    <h2><?php the_field('testimonial_heading');?></h2>
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
<script>
jQuery(document).ready(function($) {
    $('#search-submit').on('click', function() {
        var name = $('#search-name').val();
        var location = $('#search-location').val();

        // Perform the AJAX request
        $.ajax({
            url: ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'restaurant_search',
                name: name,
                location: location
            },
            beforeSend: function() {
                $('#search-results').html('Searching...'); // Display loading message
            },
            success: function(response) {
                $('#search-results').html(response); // Display the results
            },
            error: function() {
                $('#search-results').html('There was an error with the search.');
            }
        });
    });
});
</script>