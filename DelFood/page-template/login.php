<?php
/** Template Name: Login */
if(is_page('home')){
    get_header();
} else {
    get_header('new');
}
?>
<!-- login section -->
<section class="login_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2><?php echo the_title(); ?></h2>
        </div>
        
        <!-- User Info Display -->
        <div id="login-info"></div> <!-- This will show user info after login -->
        
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form method="POST" id="signin-form">
                    <div class="form-group">
                        <label for="inputEmail">EMAIL or USERNAME</label>
                        <input type="text" class="form-control" id="inputEmail" name="email_or_username" placeholder="EMAIL or USERNAME" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">PASSWORD</label>
                        <input type="password" class="form-control password-field login" id="inputPassword" name="password" placeholder="PASSWORD" required>
                        <span class="toggle-password login" toggle="#inputPassword">
                            <i class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                    <input type="submit" class="custom-btn mx-auto d-block" value="SIGN IN" name="login_submit">
                </form>
                <div class="nwlg text-center mt-3">
                    <p><a href="#" class="text-decoration-none">Forgot Password?</a></p>
                    <p>New user? <a href="<?php echo home_url('/sign-up/');?>" class="text-decoration-none">Sign up here</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end login section -->

<?php
get_footer();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome Library -->
<script>
   $(document).ready(function () {
    // Toggle password visibility
    $('.toggle-password').click(function () {
        var inputField = $($(this).attr('toggle'));

        // Toggle between password and text type
        if (inputField.attr('type') === 'password') {
            inputField.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye-slash').addClass('far fa-eye'); // Change to "show" icon
        } else {
            inputField.attr('type', 'password');
            $(this).find('i').removeClass('far fa-eye').addClass('fa-eye-slash'); // Change to "hide" icon
        }
    });

    // Prevent form submission and handle login via AJAX
    $('#signin-form').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var emailOrUsername = $('#inputEmail').val();
        var password = $('#inputPassword').val();

        // Log the form data to the console
        // console.log('Email or Username: ' + emailOrUsername);
        // console.log('Password: ' + password);

        // AJAX request to handle login
        $.ajax({
            url: ajaxurl, // This will now be available
            type: 'POST',
            data: {
                action: 'custom_login_form', // The AJAX action hook
                email_or_username: emailOrUsername,
                password: password,
                login_submit: true
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.success) {
                    console.log('Login successful');

                    // Update the page content with the user data
                    $('#login-info').html(
                        '<h3>Welcome, ' + res.data.name + '!</h3>' +
                        '<p>Email: ' + res.data.email + '</p>' +
                        '<p>Username: ' + res.data.username + '</p>' +
                        '<p>Password: ' + res.data.password + '</p>' + // This is where the password is displayed
                        '<a href="http://localhost/my-site/dashboard" class="edit_btn" id="editbtn">Edit</a>'
                    );

                    // Optionally, you could hide the login form after successful login
                    $('#signin-form,.nwlg').hide();

                    // Store user data in sessionStorage, including the password
                    sessionStorage.setItem('name', res.data.name);
                    sessionStorage.setItem('email', res.data.email);
                    sessionStorage.setItem('username', res.data.username);
                    sessionStorage.setItem('password', res.data.password);  // Storing password in sessionStorage

                    // // Redirect to the Dashboard page after successful login
                    window.location.href = 'http://localhost/my-site/sign-in';
                } else {
                    console.error(res.message); // Display error message
                    alert(res.message); // Show the error message to the user
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error); // Handle AJAX errors
            }
        });
    });
});
</script>