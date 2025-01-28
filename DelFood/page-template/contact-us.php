<?php
/**Template Name: Contact*/
if(is_page('home')){
    get_header();
}
else{
    get_header('new');
}
?>
<!-- contact section -->
<section class="contact_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                <?php echo the_title();?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <?php echo do_shortcode('[contact-form-7 id="b78cc09" title="Contact Us"]'); ?>
            </div>
        </div>
    </div>
</section>
<!-- end contact section -->
<?php
get_footer();
?>