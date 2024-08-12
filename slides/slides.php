<?php
/*
Plugin Name: Custom Slideshow Header
Description: A plugin to add a custom slideshow to the header section of the homepage.
Version: 1.0
Author: Twoje Imię
*/

// Register shortcode for slideshow
add_shortcode('custom_slideshow', 'display_custom_slideshow');

function display_custom_slideshow()
{
    ob_start();
    add_custom_slideshow();
    return ob_get_clean();
}

function add_custom_slideshow()
{
?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        /* Style for the slideshow container */
        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
            overflow: hidden;
            height: 100vh;
            /* 100% wysokości okna przeglądarki */
            font-family: 'Montserrat', sans-serif;
        }

        /* Hide the slides by default */
        .mySlides {
            display: none;
            width: 100%;
            height: 100vh;
            /* 100% wysokości okna przeglądarki */
            background-size: cover;
            background-position: center;
        }

        /* Add overlay color to slides */
        .mySlides::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--e-global-color-primary);
            opacity: 0.7;
            z-index: 1;
        }

        /* Slideshow text */
        @media (max-width: 767px) {
            .text {
                font-size: 7vw;
                /* Większa czcionka dla mniejszych ekranów */
            }
        }

        @media (max-width: 1024px) {
            .text {
                font-size: 6vw;
                /* Średnia czcionka dla ekranów średniej wielkości */
            }
        }

        .text {
            /* 			font-size: 4vw; /* Czcionka dostosowująca się do szerokości ekranu */
            */ color: #f2f2f2;
            padding: 8px 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            font-family: "Montserrat", Sans-serif;
            font-weight: 600;
            text-transform: none;
            font-style: normal;
            text-decoration: none;
            /* 			line-height: 1em; */
            letter-spacing: 0px;
            color: var(--e-global-color-c696dce);
            font-family: var(--e-global-typography-b2deeae-font-family), Sans-serif;
            font-size: var(--e-global-typography-b2deeae-font-size);
            font-weight: var(--e-global-typography-b2deeae-font-weight);
            text-transform: var(--e-global-typography-b2deeae-text-transform);
            font-style: var(--e-global-typography-b2deeae-font-style);
            text-decoration: var(--e-global-typography-b2deeae-text-decoration);
            line-height: var(--e-global-typography-b2deeae-line-height);
            letter-spacing: var(--e-global-typography-b2deeae-letter-spacing);
            word-spacing: var(--e-global-typography-b2deeae-word-spacing);
            z-index: 2;

        }

        /* Button on slides */
        .slide-button {
            display: block;
            margin: 32px auto 0;
            padding: 10px 40px;
            background-color: transparent;
            color: white;
            border-width: 2px;
            border-radius: 20px;
            border-color: #fff;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }

        .slide-button:hover {
            background-color: #fff;
            color: #fff;
        }

        /* Buttons for navigation */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: #fff !important;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;

            z-index: 2;
        }

        .prev {
            left: 0;
        }

        .next {
            right: 0;
            border-radius: 8px 0 0 8px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(255, 255, 255, 0.8);
            color: #333 !important;
        }

        .dot-container {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 2;
        }

        .dot {
            cursor: pointer;
            height: 12px;
            width: 12px;
            margin: 0 2px;
            background-color: #555;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #fff;
        }
    </style>

    <div class="slideshow-container">
        <div class="mySlides" style="background-image: url('https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/DSC07631-scaled.jpg');">
            <div class="text elementor-heading-title elementor-size-default">
                Życie i twórczość Jerzego Pleśniarowicza
                <button class="slide-button">Więcej informacji</button>
            </div>
        </div>

        <div class="mySlides" style="background-image: url('https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/movie1.png');">
            <div class="text elementor-heading-title elementor-size-default">
                Tytuł 2
                <button class="slide-button">Więcej informacji</button>
            </div>
        </div>

        <div class="mySlides" style="background-image: url('https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/hero1.png');">
            <div class="text .elementor-324 .elementor-element.elementor-element-e6da2da .elementor-heading-title">
                Tytuł 3
                <button class="slide-button">Wiecej informacji</button>
            </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <div class="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
        add_filter('jpeg_quality', function($arg) {
            return 75;
        });
    </script>
<?php
}
?>