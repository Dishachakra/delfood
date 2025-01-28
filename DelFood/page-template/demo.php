<?php 
/**Template Name: Demo Page */
if(is_page('home')){
    get_header();
}
else{
    get_header('new');
}
?>
<form id="enrollment-form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <h3 class="heading_container">Personal Information</h3>
        <input type="text" name="full_name" placeholder="Full Name" class="form-control">
        <input type="date" name="dob" placeholder="Date of Birth" class="form-control">
        <select name="gender" class="form-control">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" name="nationality" placeholder="Nationality" class="form-control">
    </div>

    <div class="form-group">
        <h3 class="heading_container">Contact Information</h3>
        <input type="tel" name="mobile" placeholder="Mobile Number" class="form-control">
        <input type="email" name="email" placeholder="Email ID" class="form-control">
        <textarea name="current_address" placeholder="Current Address" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <h3 class="heading_container">Education Details</h3>
        <input type="text" name="qualification" placeholder="Highest Qualification" class="form-control">
        <input type="text" name="college_name" placeholder="Name of College" class="form-control">
    </div>

    <div class="form-group">
        <h3 class="heading_container">Course Details</h3>
        <input type="text" name="course_applied" placeholder="Course Applied" class="form-control">
    </div>

    <div class="form-group">
        <h3 class="heading_container">Uploads</h3>
        <input type="file" name="photograph" accept="image/*" class="form-control">
    </div>

    <div class="form-group">
        <h3 class="heading_container">Declaration</h3>
        <input type="checkbox" name="agree"> I agree to the terms and conditions
        <input type="text" name="signature" placeholder="Digital Signature">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div id="form-response"></div>
<?php
get_footer();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function ($) {
    $('#enrollment-form').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('.error-message').remove();

        var formValid = true;

        // Validate Full Name (no numbers allowed)
        var name = $('input[name="full_name"]').val().trim();
        if (name === '') {
            formValid = false;
            $('input[name="full_name"]').after('<span class="error-message" style="color:red;">Full Name is required.</span>');
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            formValid = false;
            $('input[name="full_name"]').after('<span class="error-message" style="color:red;">Full Name must contain only letters and spaces.</span>');
        }

        // Validate Date of Birth
        if ($('input[name="dob"]').val().trim() === '') {
            formValid = false;
            $('input[name="dob"]').after('<span class="error-message" style="color:red;">Date of Birth is required.</span>');
        }

        // Validate Gender
        if ($('select[name="gender"]').val() === '') {
            formValid = false;
            $('select[name="gender"]').after('<span class="error-message" style="color:red;">Gender is required.</span>');
        }

        // Validate Nationality
        if ($('input[name="nationality"]').val().trim() === '') {
            formValid = false;
            $('input[name="nationality"]').after('<span class="error-message" style="color:red;">Nationality is required.</span>');
        }

        // Validate Mobile Number (exactly 10 digits, no alphabets)
        var mobile = $('input[name="mobile"]').val().trim();
        if (mobile === '') {
            formValid = false;
            $('input[name="mobile"]').after('<span class="error-message" style="color:red;">Phone Number is required.</span>');
        } else if (!/^\d{10}$/.test(mobile)) {
            formValid = false;
            $('input[name="mobile"]').after('<span class="error-message" style="color:red;">Phone Number must be exactly 10 digits and numeric.</span>');
        }

        // Validate Email (valid email format)
        var email = $('input[name="email"]').val().trim();
        if (email === '') {
            formValid = false;
            $('input[name="email"]').after('<span class="error-message" style="color:red;">Email ID is required.</span>');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            formValid = false;
            $('input[name="email"]').after('<span class="error-message" style="color:red;">Enter a valid Email ID.</span>');
        }

        // Validate Current Address
        if ($('textarea[name="current_address"]').val().trim() === '') {
            formValid = false;
            $('textarea[name="current_address"]').after('<span class="error-message" style="color:red;">Current Address is required.</span>');
        }

        // Validate Qualification
        if ($('input[name="qualification"]').val().trim() === '') {
            formValid = false;
            $('input[name="qualification"]').after('<span class="error-message" style="color:red;">Highest Qualification is required.</span>');
        }

        // Validate Course Applied
        if ($('input[name="course_applied"]').val().trim() === '') {
            formValid = false;
            $('input[name="course_applied"]').after('<span class="error-message" style="color:red;">Course Applied is required.</span>');
        }

        // Validate Photograph
        if ($('input[name="photograph"]')[0].files.length === 0) {
            formValid = false;
            $('input[name="photograph"]').after('<span class="error-message" style="color:red;">Photograph is required.</span>');
        }

        // Validate Agreement Checkbox
        if (!$('input[name="agree"]').is(':checked')) {
            formValid = false;
            $('input[name="agree"]').after('<span class="error-message" style="color:red;">You must agree to the terms and conditions.</span>');
        }

        // Validate Digital Signature
        if ($('input[name="signature"]').val().trim() === '') {
            formValid = false;
            $('input[name="signature"]').after('<span class="error-message" style="color:red;">Digital Signature is required.</span>');
        }

        if (formValid) {
            // If the form is valid, submit via AJAX
            var formData = new FormData(this);
            formData.append('action', 'submit_enrollment_form'); // Add action
            formData.append('nonce', ajax_params.nonce); // Add nonce

            $.ajax({
                url: ajax_params.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#form-response').html('<p>Submitting...</p>');
                },
                success: function (response) {
                    if (response.success) {
                        $('#form-response').html('<p>' + response.data.message + '</p>'); // Use response.data.message
                        $('#enrollment-form')[0].reset();
                    } else {
                        $('#form-response').html('<p>' + response.data.message + '</p>'); // Use response.data.message
                    }
                },
                error: function () {
                    $('#form-response').html('<p>An error occurred. Please try again.</p>');
                },
            });
        } else {
            $('#form-response').html('<p>Please fill out all required fields.</p>');
        }
    });
});
</script>