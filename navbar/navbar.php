<?php
/*
Plugin Name: Custom Navbar
Description: A plugin to add a custom navbar.
Version: 1.0
Author: Grzegorz Zych
*/

// Hook to add custom navbar and header
add_action('wp_head', 'add_custom_navbar');

function add_custom_navbar()
{
?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');


        .custom-navbar {
            background-color: var(--e-global-color-primary);
            color: var(--e-global-color-text);
            padding: 0px 10px 0px 10px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            transition: height 0.3s ease;
            font-family: 'Raleway', sans-serif;
        }

        .navbar-content {
            width: 1600px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-title {
            margin-left: 10px;
        }

        .navbar-title img {
            transition: height 0.3s ease;
            height: 70px;
        }

        .navbar-menu {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }


        .dropbtn {
            color: var(--e-global-color-91296da);
            margin: 0 10px;
            text-decoration: none;
            padding: 10px;
            display: inline-block;
        }

        .navbar-menu a {
            color: var(--e-global-color-91296da);
            margin: 0 10px;
            text-decoration: none;
            padding: 10px;
            display: inline-block;
        }

        .navbar-menu a:hover,
        {
        color: var(--e-global-color-91296da) !important;
        }

        .elementor-kit-9 a:hover {
            color: var(--e-global-color-b826ffa);
        }


        .dropbtn:hover {
            color: var(--e-global-color-91296da) !important;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--e-global-color-c696dce);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: var(--e-global-color-text);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            margin: 0;
        }

        .dropdown-content a:hover {
            background-color: var(--e-global-color-secondary);
            color: var(--e-global-color-text);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: var(--e-global-color-primary);
        }

        body {
            margin-top: 60px;
        }

        .burger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-around;
            width: 30px;
            height: 30px;
            cursor: pointer;
            position: fixed;
            right: 10px;
            top: 10px;
            z-index: 2001;
        }

        .burger-menu div {
            width: 30px;
            height: 3px;
            background-color: var(--e-global-color-text);
            transition: all 0.3s ease;
        }

        .burger-menu.active div {
            background-color: var(--e-global-color-primary);
        }

        .burger-menu.active div:nth-child(1) {
            transform: rotate(45deg);
            position: relative;
            top: 10px;
        }

        .burger-menu.active div:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active div:nth-child(3) {
            transform: rotate(-45deg);
            position: relative;
            bottom: 10px;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--e-global-color-c696dce);
            color: var(--e-global-color-text);
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 1;
            text-align: center;
        }

        .mobile-menu a {
            color: var(--e-global-color-text);
            margin: 20px 0;
            text-decoration: none;
            font-size: 24px;
        }

        .mobile-dropdown-content a {
            color: var(--e-global-color-text);
            padding: 10px;
            text-decoration: none;
            display: block;
            font-size: 20px;
            text-align: center;
        }

        .mobile-dropdown-content a:hover {
            color: var(--e-global-color-text);
        }

        .mobile-dropdown {
            position: relative;
        }

        .mobile-dropdown .mobile-dropdown-btn {
            color: var(--e-global-color-primary);
            padding: 10px;
            text-decoration: none;
            display: inline-block;
            font-size: 24px;
            cursor: pointer;
        }

        .mobile-dropdown-content {
            display: none;
            position: static;
            width: 100%;
            text-align: center;
        }

        .mobile-dropdown:hover .mobile-dropdown-content {
            display: block;
        }

        @media (max-width: 768px) {
            .navbar-content {
                display: none;
            }

            .burger-menu {
                display: flex;
            }

            .custom-navbar {
                justify-content: flex-end;
                background-color: transparent;
            }
        }
    </style>

    <div class="custom-navbar">
        <div class="navbar-content">
            <div class="navbar-title">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/Fundacja-JP_white_poziom-1.png" alt="Logo">
                </a>
            </div>
            <!--             <div class="navbar-title"><?php bloginfo('name'); ?></div> -->
            <div class="navbar-menu">
                <a href="<?php echo home_url(); ?>">Aktualności</a>
                <a href="<?php echo home_url('/jerzy-plesniarowicz-zycie'); ?>" style="background-color: transparent;">Jerzy Pleśniarowicz</a>
                <div class="dropdown">
                    <a class="dropbtn" style="background-color: transparent;color: var(--e-global-color-91296da);">Twórczość</a>
                    <div class="dropdown-content">
                        <a href="<?php echo home_url('/jerzy-plesniarowicz-publikacje-ksiazkowe'); ?>">Publikacje książkowe</a>
                        <a href="<?php echo home_url('/jerzy-plesniarowicz-dzialalnosc-poetycka'); ?>">Działalność poetycka</a>
                        <a href="<?php echo home_url('/jerzy-plesniarowicz-dzialalnosc-rezyserska'); ?>">Działalność reżyserska</a>
                        <a href="<?php echo home_url('/jerzy-plesniarowicz-dzialalnosc-prozatorska'); ?>">Twórczość przekładowa</a>
                        <a href="<?php echo home_url('/jerzy-plesniarowicz-sluchowiska-radiowe'); ?>">Słuchowiska radiowe</a>
                    </div>
                </div>
                <a href="<?php echo home_url('/fundacja'); ?>">Fundacja</a>
                <a href="<?php echo home_url('/kontakt'); ?>">Kontakt</a>
            </div>
        </div>
        <div class="burger-menu" onclick="toggleMobileMenu(this)">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <a href="<?php echo home_url(); ?>">Aktualności</a>
        <a href="<?php echo home_url('/jerzy-plesniarowicz-zycie'); ?>">Jerzy Pleśniarowicz</a>
        <div class="mobile-dropdown">
            <span class="mobile-dropdown-btn" onclick="toggleDropdown(this)">Twórczość</span>
            <div class="mobile-dropdown-content">
                <a href="<?php echo home_url('/jerzy-plesniarowicz-publikacje-ksiazkowe'); ?>">Publikacje książkowe</a>
                <a href="<?php echo home_url('/jerzy-plesniarowicz-dzialalnosc-poetycka'); ?>">Działalność poetycka</a>
                <a href="<?php echo home_url('/jerzy-plesniarowicz-dzialalnosc-rezyserska'); ?>">Działalność reżyserska</a>
                <a href="<?php echo home_url('/jerzy-plesniarowicz-dzialalnosc-prozatorska'); ?>">Twórczość przekładowa</a>
                <a href="<?php echo home_url('/jerzy-plesniarowicz-sluchowiska-radiowe'); ?>">Słuchowiska radiowe</a>
            </div>
        </div>
        <a href="<?php echo home_url('/kontatk'); ?>" onclick="toggleMobileMenu()">Kontakt</a>
    </div>
    <script>
        function toggleMobileMenu(element) {
            var menu = document.getElementById("mobileMenu");
            var burger = document.querySelector('.burger-menu');
            if (menu.style.display === "flex") {
                menu.style.display = "none";
                burger.classList.remove('active');
            } else {
                menu.style.display = "flex";
                burger.classList.add('active');
            }
        }

        function toggleDropdown(element) {
            var content = element.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        }
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.custom-navbar');
            var logo = document.querySelector('.navbar-title img');
            var nav_font = document.querySelectorAll('.navbar-menu a')
            if (window.scrollY > 50) {
                navbar.style.height = '60px';
                logo.style.height = '50px';
                nav_font.style.fontSize = "16px";
            } else {
                navbar.style.height = '80px';
                logo.style.height = '70px';
                nav_font.style.fontSize = "20px";
            }
        })
    </script>
<?php
}
?>