<?php
/**Template Name: About Us */
if(is_page('home')){
    get_header();
}
else{
    get_header('new');
}
?>
    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container">
            <div class="col-md-11 col-lg-10 mx-auto">
                <div class="heading_container heading_center">
                    <h2> <?php the_field('about_heading', 167);?> </h2>
                </div>
                <div class="box">
                    <div class="col-md-7 mx-auto">
                        <div class="img-box">
                            <img src="<?php the_field('about_image', 167);?>" class="box-img" alt="">
                        </div>
                    </div>
                    <div class="detail-box">
                        <p> <?php the_field('about_content', 167);?> </p>
                        <?php $about_btn= get_field('about_button', 167);?>
                        <a href="<?php echo $about_btn['url'];?>" target="_blank">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->
<?php
get_footer();
?>