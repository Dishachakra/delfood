<?php
/** Template Name: Dashboard Page */
get_header('new'); 
?>

<section class="dashboard_section">
    <div class="container">
        <div class="heading_container heading_center dashboard">
            <h2><?php the_title(); ?></h2>
        </div>
        
        <!-- User Info Display -->
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="user_data" id="user-info">
                    <form id="edit-user-info">
                        <!-- Fields will be populated dynamically -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>
<script>
$(document).ready(function () {
    // Fetch user data
    function loadUserData() {
        if (sessionStorage.getItem('name')) {
            var userName = sessionStorage.getItem('name');
            var userEmail = sessionStorage.getItem('email');
            var userUsername = sessionStorage.getItem('username');
            var userPassword = sessionStorage.getItem('password');

            $('#edit-user-info').html(
                '<label for="name">Name:</label>' +
                '<input type="text" id="name" name="name" value="' + userName + '" class="form-control mb-2">' +
                '<label for="email">Email:</label>' +
                '<input type="email" id="email" name="email" value="' + userEmail + '" class="form-control mb-2" readonly>' +
                '<label for="username">Username:</label>' +
                '<input type="text" id="username" name="username" value="' + userUsername + '" class="form-control mb-2">' +
                '<label for="password">Password:</label>' +
                '<input type="password" id="passwordnw" name="password" value="' + userPassword + '" class="form-control mb-3">' +
                '<span class="toggle-password updatenw" toggle="#passwordnw"><i class="fa fa-eye-slash"></i></span>' +
                '<a type="button" id="save-user-info" class="btn btn-primary">Save Changes</a>' +
                '<a type="button" href="javascript:history.go(-1)" class="btn btn-primary prev_bck">Back</a>'
                
            );
        } else {
            $('#user-info').html('<p>No user data found.</p>');
        }
    }

    loadUserData();

    // Save user data
    $('#user-info').on('click', '#save-user-info', function () {
        var updatedName = $('#name').val();
        var updatedEmail = $('#email').val();
        var updatedUsername = $('#username').val();
        var updatedPassword = $('#passwordnw').val();

        // Optional: Update sessionStorage for immediate UI changes
        sessionStorage.setItem('name', updatedName);
        sessionStorage.setItem('username', updatedUsername);
        sessionStorage.setItem('password', updatedPassword);

        // Send data to server for persistent storage
        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            method: 'POST',
            data: {
                action: 'update_user_info',
                name: updatedName,
                email: updatedEmail,
                username: updatedUsername,
                password: updatedPassword
            },
            success: function (response) {
                if (response.success) {
                    alert('User information updated successfully.');
                    setTimeout(function () {
                        window.location.href = '<?php echo home_url('/sign-in/'); ?>'; // Replace with your desired URL
                    }, 100);
                } else {
                    alert('Failed to update user information.');
                }
            }
        });
    });

    // Toggle password visibility
    $('.toggle-password').click(function () {
        var inputField = $($(this).attr('toggle'));

        // Toggle between password and text type
        if (inputField.attr('type') === 'password') {
            inputField.attr('type', 'text');
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye'); // Change to "show" icon
        } else {
            inputField.attr('type', 'password');
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash'); // Change to "hide" icon
        }
    });
});
</script>
