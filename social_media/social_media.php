<?php
/*
Plugin Name: Vertical Social Media and Back to Top
Description: Dodaje pionowy pasek z ikonami social media po jednej stronie ekranu i ikonę powrotu na górę po drugiej stronie.
Version: 1.0
Author: Twoje Imię
*/

function vsm_enqueue_styles()
{
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.0.0/css/all.min.css');
    wp_enqueue_style('vsm-styles', plugin_dir_url(__FILE__) . 'vsm-styles.css');
    wp_enqueue_script('vsm-scripts', plugin_dir_url(__FILE__) . 'vsm-scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'vsm_enqueue_styles');

function vsm_social_media_bar()
{
    // Zmienne logiczne kontrolujące aktywację funkcji
    $social_media_active = false;
    $back_to_top_active = true;

    if ($social_media_active) {
?>
        <div class="vsm-social-media-bar">
            <a href="https://www.facebook.com" target="_blank" class="vsm-icon vsm-facebook">
                <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/facebook.svg" alt="Facebook" style="width: 24px; height: 24px;">
            </a>
            <a href="https://www.twitter.com" target="_blank" class="vsm-icon vsm-twitter">
                <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/x-twitter.svg" alt="Twitter" style="width: 24px; height: 24px;">
            </a>
            <a href="https://www.instagram.com" target="_blank" class="vsm-icon vsm-instagram">
                <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/instagram.svg" alt="Instagram" style="width: 24px; height: 24px;">
            </a>
        </div>
    <?php
    }

    if ($back_to_top_active) {
    ?>
        <div class="vsm-back-to-top-container">
            <div class="vsm-back-to-top" onclick="vsmScrollToTop()">
                <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/arrow-up-solid-1.svg" alt="Back to Top" style="width: 30px; height: 30px;">
            </div>
            <div class="vsm-scroll-progress">
                <span id="vsm-scroll-percent">0%</span>
            </div>
        </div>
    <?php
    }
}
add_action('wp_footer', 'vsm_social_media_bar');

function vsm_add_styles()
{
    ?>
    <style>
        .vsm-social-media-bar {
            position: fixed;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
        }

        .vsm-icon {
            display: block;
            margin: 5px 0;
            width: 40px;
            height: 40px;
            background-color: #333;
            color: #fff;
            text-align: center;
            line-height: 40px;
            text-decoration: none;
            border-radius: 0px;
            /* Zaokrąglone rogi */
            transition: background-color 0.3s;
            display: flex;
            justify-content: center;
            /* Wyśrodkuj poziomo */
            align-items: center;
            /* Wyśrodkuj pionowo */
        }

        .vsm-icon img {
            width: 24px;
            /* Ustaw szerokość ikony */
            height: 24px;
            /* Ustaw wysokość ikony */
        }

        .vsm-icon:hover {
            background-color: #555;
        }

        .vsm-back-to-top-container {
            position: fixed;
            right: 15px;
            bottom: 15px;
            z-index: 1000;
            display: none;
            /* Domyślnie ukryte */
            align-items: center;
        }

        .vsm-back-to-top {
            width: 40px;
            height: 40px;
            background-color: var(--e-global-color-text);
            color: #fff;
            text-align: center;
            line-height: 30px;
            border-radius: 5px;
            /* Zaokrąglone rogi */
            cursor: pointer;
            display: flex;
            justify-content: center;
            /* Wyśrodkuj poziomo */
            align-items: center;
            /* Wyśrodkuj pionowo */
        }

        .vsm-back-to-top:hover {
            background-color: var(--e-global-color-accent);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .vsm-scroll-progress {
            margin-right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .vsm-back-to-top-container.show {
            display: flex;
            /* Pokaż, gdy ma klasę 'show' */
            flex-direction: row-reverse;
            /* Umieść elementy w odwrotnej kolejności */
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            $(window).scroll(function() {
                // Pokaż/Ukryj kontener przycisku przewijania do góry i procentu przewijania
                if ($(this).scrollTop() > 100) {
                    $('.vsm-back-to-top-container').addClass('show');
                } else {
                    $('.vsm-back-to-top-container').removeClass('show');
                }

                // Oblicz procent przewinięcia strony
                var scrollTop = $(this).scrollTop();
                var docHeight = $(document).height();
                var winHeight = $(window).height();
                var scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;

                // Zaokrąglij do najbliższej wartości całkowitej
                scrollPercent = Math.round(scrollPercent);

                // Aktualizuj procent przewinięcia
                $('#vsm-scroll-percent').text(scrollPercent + '%');
            });
        });

        function vsmScrollToTop() {
            jQuery('html, body').animate({
                scrollTop: 0
            }, 'slow');
        }
    </script>
<?php
}
add_action('wp_head', 'vsm_add_styles');

?>