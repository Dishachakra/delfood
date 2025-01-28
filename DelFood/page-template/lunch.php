<?php
/**Template Name: Lunch Page */
if(is_page('home')){
get_header();
}
else{
    get_header('new');
}
?>
<!-- product details section -->
<section class="product_details_section layout_padding">
    <div class="container">
        <div class="row">
            <?php
            // Arguments for WP_Query
            $wpfeature = array(
                'post_type'     => 'foodmenu', // Custom post type
                'tax_query'     => array(
                    array(
                        'taxonomy' => 'food_category', // Replace with your taxonomy slug
                        'field'    => 'slug',         // Use 'slug', 'id', or 'name'
                        'terms'    => 'lunch',    // Replace with your term slug
                    ),
                ),
                'orderby'       => 'date',
                'post_status'   => 'publish',
                'order'         => 'ASC',
                'posts_per_page'=> 2,
                'paged'         => get_query_var('paged') ? get_query_var('paged') : 1,
            );
            $featurequey = new WP_Query($wpfeature);
            if ($featurequey->have_posts()) :
                while ($featurequey->have_posts()) : $featurequey->the_post();
                    $imagepath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                    ?>
                    <div class="col-md-6 foodmen">
                        <div class="box">
                            <div class="img-box">
                                <img src="<?php echo esc_url($imagepath[0]); ?>" alt="Product Image" class="img-fluid" />
                            </div>
                            <div class="detail-box">
                                <h4><?php the_title(); ?></h4>
                                <?php echo the_excerpt();?>
                                <?php echo the_content();?>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();

                // Pagination
                $pagination_args = array(
                    'total'        => $featurequey->max_num_pages,
                    'current'      => max(1, get_query_var('paged')),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'list',
                    'prev_text'    => '<i class="fa-solid fa-angles-left"></i>', // Font Awesome left arrow
                    'next_text'    => '<i class="fa-solid fa-angles-right"></i>', // Font Awesome right arrow
                );
                echo '<div class="pagination">';
                echo paginate_links($pagination_args);
                echo '</div>';
            endif;
            ?>
        </div>
    </div>
</section>
<!-- end product details section -->
<?php
get_footer();
?>