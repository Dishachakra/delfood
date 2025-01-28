<?php
/** Template Name: Sign In */
get_header('new');
?>
<section class="login_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2><?php echo the_title(); ?></h2>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="heading_container heading_center">
                    <h3>Welcome, <span id="user-name"></span></h3>
                </div>
                <div class="newsign" id="sign-info">
                    <p>Username: <span id="user-username"></span></p>
                    <p>Email: <span id="user-email"></span></p>
                    <p>Password: <span id="user-password"></span></p> <!-- Added password display -->
                    <a type="button" href="http://localhost/my-site/dashboard" class="edit_btn" id="editbtn">Edit</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Retrieve user data from sessionStorage
        var name = sessionStorage.getItem('name');
        var email = sessionStorage.getItem('email');
        var username = sessionStorage.getItem('username');
        var password = sessionStorage.getItem('password'); // Retrieve password

        // Check if the user data exists
        if (name && email && username && password) {
            // Populate the user information on the page
            $('#user-name').text(name);
            $('#user-email').text(email);
            $('#user-username').text(username);
            $('#user-password').text(password); // Display password
        } else {
            // If no user data is available, redirect to the login page
            window.location.href = '<?php echo home_url('/login/'); ?>';
        }
    });
</script>

<?php
get_footer();
?>