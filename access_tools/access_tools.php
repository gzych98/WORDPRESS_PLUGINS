<?php
/*
Plugin Name: Accessibility Tools
Description: Dodaje narzędzia do zmiany wielkości tekstu, ustawienia kontrastu i podkreślenia linków po lewej stronie ekranu.
Version: 1.0
Author: Twoje Imię
*/

function at_enqueue_styles()
{
    wp_enqueue_style('at-styles', plugin_dir_url(__FILE__) . 'at-styles.css');
    wp_enqueue_script('at-scripts', plugin_dir_url(__FILE__) . 'at-scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'at_enqueue_styles');

function at_accessibility_bar()
{
?>
    <div class="at-accessibility-toggle">
        <div class="at-button at-toggle">
            <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/person-solid.svg" alt="Accessibility" />
        </div>
        <div class="at-accessibility-bar">
            <div class="at-bar-header">Ułatwienia dostępu</div>
            <!--             <div class="at-button at-text-size" data-action="increase">Zwiększ tekst</div> -->
            <!--             <div class="at-button at-text-size" data-action="decrease">Zmniejsz tekst</div> -->
            <div class="at-button at-contrast" data-action="toggle">Wysoki kontrast</div>
            <div class="at-button at-underline-links" data-action="toggle">Pokreślenie linków</div>
            <!--             <div class="at-button at-reset" data-action="reset">Reset</div> -->
        </div>
    </div>
<?php
}
add_action('wp_footer', 'at_accessibility_bar');

function at_add_styles()
{
?>
    <style>
        .at-accessibility-toggle {
            position: fixed;
            left: 14px;
            bottom: 65px;
            z-index: 1000;
        }

        .at-button {
            margin: 5px 0;
            width: 200px;
            height: 40px;
            background-color: var(--e-global-color-c696dce);
            color: var(--e-global-color-text);
            text-align: left;
            padding-left: 10px;
            padding-right: 10px;
            line-height: 40px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            /* Zaokrąglone rogi */
        }

        .at-toggle {
            width: 40px;
            height: 40px;
            background-color: var(--e-global-color-primary);
            color: var(--e-global-color-text);
            display: flex;
            justify-content: center;
            /* Dodano to */
            align-items: center;
            /* Dodano to */
            cursor: pointer;
        }

        .at-toggle img {
            width: 24px;
            height: 24px;
            margin: auto;
            /* Dodano to */
        }

        .at-button:hover,
        .at-toggle:hover {
            background-color: var(--e-global-color-secondary);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .at-accessibility-bar {
            display: none;
            flex-direction: column;
            background: var(--e-global-color-c696dce);
            border: 1px solid #ddd;
            border-radius: 15px;
            /* Zaokrąglone rogi */
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .at-bar-header {
            font-weight: bold;
            margin-bottom: 10px;
            color: var(--e-global-color-text);
        }

        .underline-links a {
            text-decoration: underline !important;
        }

        .high-contrast {
            background-color: var(--at-high-contrast-bg) !important;
            color: var(--at-high-contrast-text) !important;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            var fontSizes = {
                '--e-global-typography-primary-font-size': 45,
                '--e-global-typography-secondary-font-size': 25,
                '--e-global-typography-text-font-size': 28,
                '--e-global-typography-accent-font-size': 14,
                '--e-global-typography-c05b693-font-size': 18,
                '--e-global-typography-c05b693-line-height': 1.4,
                '--e-global-typography-6558fb1-font-size': 14,
                '--e-global-typography-92bce3b-font-size': 14,
                '--e-global-typography-b2deeae-font-size': 65,
                '--e-global-typography-fb1a3e0-font-size': 145,
                '--e-global-typography-397e168-font-size': 14,
            };

            var colors = {
                '--e-global-color-primary': '#FFFFFF',
                '--e-global-color-text': '#222222',
            };

            var isHighContrast = false;

            function updateFontSizes(factor) {
                for (var key in fontSizes) {
                    var size = fontSizes[key];
                    var newSize = size * factor;
                    $('.elementor-kit-9').css(key, newSize + (key.includes('line-height') ? '' : 'px'), 'important');
                }
            }

            function toggleColors() {
                isHighContrast = !isHighContrast;
                var colorMappings = {
                    '--e-global-color-primary': isHighContrast ? '#000000' : '#141414',
                    '--e-global-color-text': isHighContrast ? '#ffd004' : '#141414',
                    '--e-global-color-secondary': isHighContrast ? '#000' : '#BDAF9F',
                    '--e-global-color-c696dce': isHighContrast ? '#000000' : '#EDEDED',
                    '--e-global-color-accent': isHighContrast ? '#fff' : '#8E4929',
                    '--e-global-color-14ef391': isHighContrast ? '#000000' : '#EAEAEA',
                    '--e-global-color-764183d': isHighContrast ? '#F9FAFD' : '#F9FAFD',
                    '--e-global-color-d6cea4e': isHighContrast ? '#000' : '#FFFFFF',
                    '--e-global-color-86b4fcd': isHighContrast ? '#02010100' : '#02010100',
                    '--e-global-color-57c8da2': isHighContrast ? '#000000CC' : '#000000CC',
                    '--e-global-color-b8a48e0': isHighContrast ? '#000' : '#FBFBFB',
                    '--e-global-color-91296da': isHighContrast ? '#ffd004' : '#FFFFFF',
                    '--e-global-color-b826ffa': isHighContrast ? '#ffd004' : '#BDAF9F',
                };
                for (var key in colorMappings) {
                    var newColor = colorMappings[key];
                    document.querySelector('.elementor-kit-9').style.setProperty(key, newColor, 'important');
                }
            }

            function resetSettings() {
                updateFontSizes(1);
                isHighContrast = true;
                toggleColors();
            }

            var currentFactor = 1;

            $('.at-text-size').on('click', function() {
                var action = $(this).data('action');
                if (action === 'increase') {
                    currentFactor += 0.1;
                } else if (action === 'decrease') {
                    currentFactor -= 0.1;
                }
                updateFontSizes(currentFactor);
            });

            $('.at-contrast').on('click', function() {
                toggleColors();
            });

            $('.at-underline-links').on('click', function() {
                $('body').toggleClass('underline-links');
            });

            $('.at-reset').on('click', function() {
                resetSettings();
            });

            $('.at-toggle').on('mouseover', function(event) {
                $('.at-accessibility-bar').show();
                event.stopPropagation();
            });

            $(document).on('mouseover', function() {
                $('.at-accessibility-bar').hide();
            });

            $('.at-accessibility-bar').on('mouseover', function(event) {
                event.stopPropagation();
            });
        });
    </script>
<?php
}
add_action('wp_head', 'at_add_styles');
?>