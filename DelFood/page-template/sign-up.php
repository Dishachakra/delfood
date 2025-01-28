<?php
/**Template Name: Sign Up */
if(is_page('home')){
    get_header();
}
else{
    get_header('new');
}
?>
<!-- registration section -->
<section class="registration_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2><?php echo get_the_title(); ?></h2>
        </div>
        <div class="row" id="sign_upform">
            <div class="col-md-6 mx-auto">
                <form method="POST">
                    <div class="form-group user position-relative">
                         <label for="inputUsername">USERNAME</label>
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="USERNAME" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">NAME</label>
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="FULL NAME" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">EMAIL</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="EMAIL" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword">PASSWORD</label>
                            <input type="password" class="form-control password-field" id="inputPassword" name="password" placeholder="PASSWORD" required>
                            <span class="toggle-password" toggle="#inputPassword"><i class="fa fa-eye-slash"></i></span>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="inputConfirmPassword">CONFIRM PASSWORD</label>
                            <input type="password" class="form-control password-field" id="inputConfirmPassword" name="confirm_password" placeholder="CONFIRM PASSWORD" required>
                            <span class="toggle-password" toggle="#inputConfirmPassword"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <input type="submit" class="custom-btn mx-auto d-block" style="width: 200px;" value="SIGN UP" name="signup_submit">
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end registration section -->
<?php
get_footer();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome Library -->
<script>
    $(document).ready(function () {
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
    });
</script>