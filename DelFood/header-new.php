<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>
    <?php
    bloginfo('name');
    wp_title();
    if(is_front_page()):
      echo " | ";
      bloginfo('description');
    endif;    
    ?>
  </title>
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<?php wp_head();?>
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="<?php echo home_url()?>">
            <span><?php bloginfo('name'); ?></span>
          </a>
          <div class="" id="">
            <div class="User_option">
              <a id="login-logout-link" href="<?php echo home_url('/login/'); ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Login</span>
              </a>
              <form class="form-inline ">
                <input type="search" placeholder="Search" />
                <button class="btn  nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </div>
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <img src="<?php echo bloginfo('template_url');?>/assets/images/menu.png" alt="">
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <?php
                  wp_nav_menu(
                    array(
                      'theme_location' => 'header-menu',
                      'container' => 'nav',
                      'menu_class' => 'header-menu'
                    )
                  );
                ?>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var isLoggedIn = sessionStorage.getItem('username') && sessionStorage.getItem('email');
        
        if (isLoggedIn) {
            // If user is logged in, show Logout link
            $('#login-logout-link').attr('href', '<?php echo home_url('/login/'); ?>').html(`
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Logout</span>
            `);

            // Handle logout click
            $('#login-logout-link').click(function (e) {
                e.preventDefault(); // Prevent default action
                sessionStorage.clear(); // Clear session storage
                window.location.href = '<?php echo home_url('/login/'); ?>'; // Redirect to login page
            });
        } else {
            // If user is not logged in, show Login link
            $('#login-logout-link').attr('href', '<?php echo home_url('/login/'); ?>').html(`
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Login</span>
            `);
        }
    });
</script>