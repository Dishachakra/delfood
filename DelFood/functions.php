<?php
function custom_css()
{
    wp_enqueue_style('bootstrap_css',get_template_directory_uri().'/assets/css/bootstrap.css',array(), 1.0, 'all');
    wp_enqueue_style('font-awesome_min_css', get_template_directory_uri(). '/assets/css/font-awesome.min.css', array(), 1.0 , 'all');
    wp_enqueue_style('nice_select_min_css',"https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" ,array(), 1.0, 'all');
    wp_enqueue_style('slick_min_css',"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" ,array(), 1.0, 'all');
    wp_enqueue_style('slick-theme_min_css_map',"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css.map" ,array(), 1.0, 'all');
    wp_enqueue_style('style_css', get_template_directory_uri(). '/assets/css/style.css', array(), 1.0 , 'all');
    wp_enqueue_style('responsive_css', get_template_directory_uri(). '/assets/css/responsive.css', array(), 1.0 , 'all');
}
add_action('wp_enqueue_scripts','custom_css');
function custom_js()
{
    wp_enqueue_script('jquery-3_4_1_min_js', get_template_directory_uri(). '/assets/js/jquery-3.4.1.min.js', array(), '', 'true');
    wp_enqueue_script('bootstrap_js', get_template_directory_uri(). '/assets/js/bootstrap.js', array(), '', 'true');
    wp_enqueue_script('slick_js',"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js", array(), '','true');
    wp_enqueue_script('slick_js',"https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js", array(), '','true');
    wp_enqueue_script('custom_js', get_template_directory_uri(). '/assets/js/custom.js', array(), '', 'true');
}
add_action('wp_enqueue_scripts','custom_js');
/**Header Logo */
add_theme_support('custom_header');
add_theme_support('post-thumbnails');
function theme_setup()
{
    add_theme_support('custom-logo');
    add_image_size('mytheme-logo',160, 90);
    add_theme_support(
        'custom-logo',
        array(
            'size' => 'mytheme-logo'
        )
    );
}
add_action('after_theme_setup', 'theme_setup');
/**Nav Menus */
register_nav_menus(
    array(
        'header-menu'   =>  'Header Menu',
        'footer-menu'   =>  'Footer Menu'
    )
);

/**Custom Adding extra fields at setting of admin dashboard */
add_filter('admin_init', 'register_fields');
function register_fields() 
{
    register_setting('general', 'address', 'esc_attr');
    add_settings_field('address', '<label for="address">' .__('Address', 'address'). '</label>', 'address', 'general');

    register_setting('general', 'phone', 'esc_attr');
    add_settings_field('phone', '<label for="phone">' .__('Phone Number', 'phone'). '</label>', 'phone', 'general');

    register_setting('general', 'email', 'esc_attr');
    add_settings_field('email', '<label for="email">' .__('Email', 'email'). '</label>', 'email', 'general');

    register_setting('general', 'facebook', 'esc_attr');
    add_settings_field('facebook', '<label for="facebook">' .__('Facebook', 'facebook'). '</label>', 'facebook', 'general');

    register_setting('general', 'twitter', 'esc_attr');
    add_settings_field('twitter', '<label for="twitter">' .__('Twitter', 'twitter'). '</label>', 'twitter', 'general');

    register_setting('general', 'linkedin', 'esc_attr');
    add_settings_field('linkedin', '<label for="linkedin">' .__('Linkedin', 'linkedin'). '</label>', 'linkedin', 'general');

}
function address()
{
    $value = get_option( 'address', '');
    echo '<input type="text" id="address" name="address" value="' . $value . '" />';
}
function phone()
{
    $value = get_option( 'phone', '');
    echo '<input type="text" id="phone" name="phone" value="' . $value . '" />';
}
function email()
{
    $value = get_option( 'email', '');
    echo '<input type="text" id="email" name="email" value="' . $value . '" />';
}
function facebook()
{
    $value = get_option( 'facebook', '');
    echo '<input type="text" id="facebook" name="facebook" value="' . $value . '" />';
}
function twitter()
{
    $value = get_option( 'twitter', '');
    echo '<input type="text" id="twitter" name="twitter" value="' . $value . '" />';
}
function linkedin()
{
    $value = get_option( 'linkedin', '');
    echo '<input type="text" id="linkedin" name="linkedin" value="' . $value . '" />';
}
/**Food Menus Custom Post Type */
function food_menus_init() {
    // Registering the custom post type
    register_post_type(
        'foodmenu',
        [
            'labels'    =>  [
                'name'          =>  __('All Posts'), 
                'singular_name' =>  __('Food-menu'), 
                'menu_name'     =>  __('Food menu'), 
                'all_items'     =>  __('All Posts'), 
                'add_new'       =>  __('Add New Post'), 
                'add_new_item'  =>  __('Add New Post'), 
                'edit_item'     =>  __('Edit Post'), 
                'new_item'      =>  __('New Post'), 
                'view_item'     =>  __('View Post'),
                'search_items'  =>  __('Search Posts'),
                'not_found'     =>  __('No Posts Found'),
                'not_found_in_trash' => __('No Posts Found in Trash'),
            ],
            'public'        => true,
            'has_archive'   => true,
            'show_ui'       => true,
            'supports'      => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'rewrite'       => ['slug' => 'food-menu'],
            'menu_icon'     => 'dashicons-food',
        ]
    );
    // Registering the categories (taxonomy)
    register_taxonomy('food_category', 'foodmenu', [
        'labels' => [
            'name' => __('Categories'),
            'singular_name' => __('Category'),
        ],
        'hierarchical' => true,
        'public'    => true,
        'show_ui'   => true,
        'rewrite'   => ['slug' => 'food-category'],
    ]);
    register_taxonomy('food_tag', 'foodmenu', [
        'labels' => [
            'name' => __('Tags'),
            'singular_name' => __('Tag'),
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_ui'      => true,
        'rewrite'      => ['slug'   =>  'food-tag'],
    ]);
}
add_action('init', 'food_menus_init');
/**Testimonial Custom Post Type*/
function testimonial_init()
{
    register_post_type('testimonial',[
        'labels'    =>  [
            'name'          =>  __('Testimonial'),
            'singular_name' =>  __('Testimonial'), 
        ],
        'public'            =>  true,
        'has_archive'       =>  true,
        'show_ui'           =>  true,
        'supports'          =>  ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'rewrite'           =>  ['slug' => 'testimonial'],
        'menu_icon'         =>  'dashicons-editor-quote',
    ]);
}
add_action('init', 'testimonial_init');
/**Showing JSON format for contact form 7 in unserialize way*/
// Register REST API endpoint
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/contact-data/', array(
        'methods' => 'GET',
        'callback' => 'fetch_form_data',
        'permission_callback' => '__return_true', // Public access (adjust as necessary)
    ));
});
// Callback for fetching data from the database
function fetch_form_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'db7_forms'; // Replace with your actual table name
    // Fetch data from the database
    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    if (!empty($results)) {
        $unserialized_results = array();
        foreach ($results as $row) {
            // Assume the serialized data is in a column named 'form_value' (adjust column name as needed)
            if (isset($row['form_value'])) {
                $row['form_value'] = unserialize($row['form_value']);
            }
            $unserialized_results[] = $row;
        }
        return rest_ensure_response($unserialized_results);
    } else {
        return rest_ensure_response(array('success' => false, 'message' => 'No data found.'));
    }
}
/**Custom Signup functionality */
add_action('init', 'custom_signup_form_handler');
function custom_signup_form_handler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup_submit'])) {
        // Sanitize inputs
        $username = sanitize_text_field($_POST['username']); // New field
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $confirm_password = sanitize_text_field($_POST['confirm_password']);

        // Basic validation
        if (empty($username) || empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            echo "<script>alert('All fields are required!');</script>";
            return;
        }
        
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!');</script>";
            return;
        }

        // Insert user data into the custom table
        global $wpdb;
        $table_name = $wpdb->prefix . 'registration_custom';

        // Hash the password
        $hashed_password = wp_hash_password($password);

        // Insert into table
        $wpdb->insert(
            $table_name,
            [
                'username' => $username,
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
            ],
            ['%s', '%s', '%s', '%s']
        );

        // Success message or redirect
        echo "<script>alert('Registration successful!');</script>";
        wp_redirect(home_url('/login/')); // Redirect to login page
        exit;
    }
}
/**Custom Login Functionality */
function custom_login_form_handler() {
    // Check if it's an AJAX request
    if (isset($_POST['login_submit']) && isset($_POST['email_or_username']) && isset($_POST['password'])) {
        // Sanitize input
        $input = sanitize_text_field($_POST['email_or_username']); // Email or Username
        $password = sanitize_text_field($_POST['password']); // Password

        // Validate the input
        if (empty($input) || empty($password)) {
            echo json_encode(array('success' => false, 'message' => 'All fields are required.'));
            wp_die(); // End AJAX request
        }

        // Check if the input is an email or username
        global $wpdb;
        $table_name = $wpdb->prefix . 'registration_custom';

        if (is_email($input)) {
            // Query by email
            $user = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM $table_name WHERE email = %s",
                $input
            ));
        } else {
            // Query by username
            $user = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM $table_name WHERE username = %s",
                $input
            ));
        }

        // Check if the user exists
        if ($user) {
            // Verify password
            if (wp_check_password($password, $user->password, $user->ID)) {
                // Password is correct, log the user in
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID);

                // Respond with success and user data (return necessary user info, not password)
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Login successful',
                    'data' => array(
                        'name' => $user->name,
                        'email' => $user->email,
                        'username' => $user->username,
                        'password' => $password,
                    )
                ));
            } else {
                // Password doesn't match
                echo json_encode(array('success' => false, 'message' => 'Incorrect password.'));
            }
        } else {
            // User doesn't exist
            echo json_encode(array('success' => false, 'message' => 'No user found with this email or username.'));
        }

        wp_die(); // End AJAX request
    }
}
add_action('wp_ajax_custom_login_form', 'custom_login_form_handler');
add_action('wp_ajax_nopriv_custom_login_form', 'custom_login_form_handler');
function my_theme_enqueue_scripts() {
    // Enqueue your custom script
    wp_enqueue_script('my-login-script', get_template_directory_uri() . '/js/login.js', array('jquery'), null, true);

    // Localize script to pass ajaxurl to the JavaScript file
    wp_localize_script('my-login-script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
// Register AJAX actions(Update Function)
add_action('wp_ajax_update_user_info', 'update_user_info');
add_action('wp_ajax_nopriv_update_user_info', 'update_user_info');
function update_user_info() {
    global $wpdb;
    // Check if the request is valid
    if (!isset($_POST['email'])) {
        wp_send_json_error('Invalid request.');
        return;
    }
    // Validate and sanitize input data
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);
    // Hash the password using wp_hash_password (more secure than MD5)
    $hashed_password = wp_hash_password($password);
    // Define the custom table name
    $table_name = $wpdb->prefix . 'registration_custom';
    // Check if the email exists in the custom table
    $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));
    if (!$user) {
        wp_send_json_error('User not found in the custom table.');
        return;
    }
    // Update user data in the custom table
    $updated = $wpdb->update(
        $table_name,
        [
            'name'     => $name,
            'username' => $username,
            'password' => $hashed_password, // Save the hashed password
        ],
        ['email' => $email],
        ['%s', '%s', '%s'],
        ['%s']
    );

    if ($updated === false) {
        wp_send_json_error('Failed to update user information.');
    } else {
        wp_send_json_success('User information updated successfully.');
    }
}
/**New custom contact form function handler */
function enqueue_form_scripts() {
    wp_enqueue_script('enrollment-form-js', get_template_directory_uri() . '/js/enrollment-form.js', array('jquery'), null, true);

    wp_localize_script('enrollment-form-js', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('enrollment_form_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_form_scripts');

// Prevent redeclaration of the function
if (!function_exists('handle_enrollment_form_submission')) {
    function handle_enrollment_form_submission() {
        // Verify nonce for security
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'enrollment_form_nonce')) {
            wp_send_json_error(array('message' => 'Invalid nonce.'));
        }

        // Process form data (e.g., save to the database)
        $response_message = 'Form submitted successfully!';
        wp_send_json_success(array('message' => $response_message));
    }
}

add_action('wp_ajax_submit_enrollment_form', 'handle_enrollment_form_submission');
add_action('wp_ajax_nopriv_submit_enrollment_form', 'handle_enrollment_form_submission');
/**form handler function */
function handle_enrollment_form_submission() {
    // Verify nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'enrollment_form_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce.'));
    }

    // Get the submitted form data
    $full_name = sanitize_text_field($_POST['full_name']);
    $dob = sanitize_text_field($_POST['dob']);
    $gender = sanitize_text_field($_POST['gender']);
    $nationality = sanitize_text_field($_POST['nationality']);
    $mobile = sanitize_text_field($_POST['mobile']);
    $email = sanitize_email($_POST['email']);
    $current_address = sanitize_textarea_field($_POST['current_address']);
    $qualification = sanitize_text_field($_POST['qualification']);
    $college_name = sanitize_text_field($_POST['college_name']);
    $course_applied = sanitize_text_field($_POST['course_applied']);
    $photograph = $_FILES['photograph']; // File upload handling (you can save this if needed)
    $signature = sanitize_text_field($_POST['signature']);

    // Process form data (e.g., save to the database, send email, etc.)
    global $wpdb;
    $table_name = $wpdb->prefix . 'enrollments'; // Ensure this is your correct table name

    $wpdb->insert($table_name, array(
        'full_name' => $full_name,
        'dob' => $dob,
        'gender' => $gender,
        'nationality' => $nationality,
        'mobile' => $mobile,
        'email' => $email,
        'current_address' => $current_address,
        'qualification' => $qualification,
        'college_name' => $college_name,
        'course_applied' => $course_applied,
        'photograph' => $photograph['name'], // Store the file name (or you can handle the file upload)
        'signature' => $signature
    ));

    // Send a success response
    wp_send_json_success(array('message' => 'Form submitted successfully!'));
}

// 1. Register Custom Post Type: Restaurant
function create_restaurant_cpt() {
    $labels = array(
        'name' => __('Restaurants', 'textdomain'),
        'singular_name' => __('Restaurant', 'textdomain'),
        'menu_name' => __('Restaurants', 'textdomain'),
        'add_new' => __('Add New Restaurant', 'textdomain'),
        'add_new_item' => __('Add New Restaurant', 'textdomain'),
        'edit_item' => __('Edit Restaurant', 'textdomain'),
        'new_item' => __('New Restaurant', 'textdomain'),
        'view_item' => __('View Restaurant', 'textdomain'),
        'search_items' => __('Search Restaurants', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'restaurants'),
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
    );

    register_post_type('restaurant', $args);
}
add_action('init', 'create_restaurant_cpt');
/**Function handler for search */
function ajax_restaurant_search() {
    // Get search term values
    $search_name = sanitize_text_field($_POST['name']);
    $search_location = sanitize_text_field($_POST['location']);

    // Query arguments to filter by name
    $args = array(
        'post_type'  => 'restaurant',
        'posts_per_page' => -1, // Show all results
        's'          => $search_name, // Search for restaurant name
    );

    // WP Query to fetch the results
    $query = new WP_Query($args);

    // Initialize a flag to track if any results were found
    $found_restaurants = false;

    if ($query->have_posts()) {
        echo '<ul class="restaurant-list">';
        while ($query->have_posts()) {
            $query->the_post();

            // Get the featured image URL
            $image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : 'https://via.placeholder.com/150';

            // Get the ACF repeater field for locations
            $locations = get_field('location_repeater'); // Assuming the repeater field's name is 'location_repeater'

            $matching_location = false; // Flag to check if location matches

            // Check if the location matches the search term
            if ($locations) {
                foreach ($locations as $location) {
                    if (strpos(strtolower($location['locations']), strtolower($search_location)) !== false) {
                        $matching_location = true;
                        break;
                    }
                }
            }
            // Show the restaurant if either:
            // 1. Location matches or search location is empty
            // 2. Restaurant name matches
            if ($matching_location || empty($search_location)) {
                $found_restaurants = true; // At least one restaurant was found
                echo '<div class="restaurant-item">';
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr(get_the_title()) . '" class="restaurant-image">';
                echo '<div class="restaurant-content">';
                echo '<h3 class="restaurant-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                
                // Display location if it matches
                if ($locations) {
                    foreach ($locations as $location) {
                        if (strpos(strtolower($location['locations']), strtolower($search_location)) !== false) {
                            echo '<p class="restaurant-location">Location: ' . esc_html($location['locations']) . '</p>';
                        }
                    }
                }

                echo '</div>';
                echo '</div>';
            }
        }
        echo '</ul>';
    }

    // If no matching restaurant was found, show a message
    if (!$found_restaurants) {
        echo '<p>No restaurants found matching your location.</p>';
    }

    wp_die(); // End the AJAX request
}
add_action('wp_ajax_restaurant_search', 'ajax_restaurant_search');
add_action('wp_ajax_nopriv_restaurant_search', 'ajax_restaurant_search');

function enqueue_custom_script() {
    wp_enqueue_script('restaurant-search', get_template_directory_uri() . '/js/restaurant-search.js', array('jquery'), null, true);
    wp_localize_script('restaurant-search', 'ajax_obj', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');
?>