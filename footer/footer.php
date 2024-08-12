<?php
/*
Plugin Name: Custom Footer
Description: A plugin to add a custom footer and remove the default footer.
Version: 1.1
Author: Grzegorz Zych
*/

// Hook to add custom footer
add_action('wp_footer', 'add_custom_footer');

function add_custom_footer()
{
?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');

        .custom-footer-container {
            display: flex;
            justify-content: center;
            width: 100%;
            background-color: var(--e-global-color-primary);
            /*              background-color: var(--e-global-color-accent);  */
            /*             background-color: var(--e-global-color-secondary); */
        }

        html,
        body {
            margin: 0 !important;
            /* Usuń marginesy */
            padding: 0 !important;
            /* Usuń padding */
            height: 100%;
            /* Ustaw wysokość na 100% */
        }

        #page {
            margin-bottom: 0 !important;
            /* Usuń margines dolny */
            padding-bottom: 0 !important;
            /* Usuń padding dolny */
            height: 100%;
            /* Ustaw minimalną wysokość na 100% */
            box-sizing: border-box;
            /* Upewnij się, że padding jest wliczany do wysokości */
        }


        #content {
            margin: 0;
            /* Usuń marginesy */
            padding: 0;
            /* Usuń padding */
        }

        .custom-footer {
            color: var(--e-global-color-b8a48e0);
            /*             color: var(--e-global-color-text); */
            padding: 32px 32px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Wyrównanie do góry */
            flex-direction: column;
            max-width: 1600px;
            /* Maksymalna szerokość kontenera */
        }

        .footer-logo {
            align-self: flex-start;
            margin: 0 20px;
            padding-bottom: 32px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        .footer-column {
            margin: 0 20px;
            flex-grow: 1;
            /* Elementy wypełniają równomiernie przestrzeń */
        }

        .footer-column h2 {
            margin-bottom: 10px;
            font-family: 'Raleway', sans-serif;
            font-size: 1.5rem;
        }

        .footer-column h3 {
            margin-bottom: 10px;
            font-family: 'Raleway', sans-serif;
        }

        .footer-column a {
            color: var(--e-global-color-b8a48e0);
            /*             color: var(--e-global-color-text); */
            text-decoration: none;
            display: block;
            margin-bottom: 5px;
            font-family: 'Raleway', sans-serif;
        }

        .footer-column a:hover {
            color: var(--e-global-color-secondary);
            /*             color: var(--e-global-color-accent); */
        }

        .footer-social a {
            margin-right: 10px;
            color: var(--e-global-color-b8a48e0);
            /*             color: var(--e-global-color-text); */
        }

        .footer-social a:hover {
            color: var(--e-global-color-secondary);
            /*             color: var(--e-global-color-accent); */
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            width: 100%;
        }

        .footer-bottom p {
            font-family: "Raleway", sans-serif;
        }

        .footer-bottom a:hover {
            color: #2B70E4;
        }

        .footer-bottom a {
            color: var(--e-global-color-b8a48e0);
            /*             color: var(--e-global-color-text); */
        }

        p {
            margin-block-start: 0;
            /* Usuń domyślny margines na początku */
            margin-block-end: 0;
            /* Usuń domyślny margines na końcu */
            margin-top: 10px;
            /* Nowy margines od góry */
            margin-bottom: 0px;
            /* Nowy margines od dołu */
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                /* Zmiana na wyświetlanie pionowe */
                align-items: flex-start;
                /* Wyrównanie do lewej */
            }

            .footer-column {
                margin: 10px 0;
                width: 100%;
                /* Rozciągnięcie kolumn na pełną szerokość */
            }

            .footer-logo {
                text-align: center;
                width: 100%;
                margin-bottom: 16px;
            }
        }
    </style>

    <div class="custom-footer-container">
        <div class="custom-footer">
            <div class="footer-logo">
                <img src="https://www.jerzyplesniarowicz.pl/wp-content/uploads/2024/06/Fundacja-JP_white_poziom-1.png" alt="Logo" style="height: 100px;">
            </div>
            <div class="footer-content">
                <div class="footer-column">
                    <h2 id="footer-h2" class="elementor-heading-title elementor-size-default">Fundacja<br /> im. Jerzego Pleśniarowicza</h2>
                    <p>&#10095;&emsp;KRS: 0001011299</p>
                    <p>&#10095;&emsp;NIP: 6762633333</p>
                    <p>&#10095;&emsp;REGON: 524058270</p>
                </div>
                <div class="footer-column">
                    <h2 class="elementor-heading-title elementor-size-default">Dokumenty</h2>
                    <a href="/privacy-policy">&#10095;&emsp;Polityka prywatności</a>
                    <a href="/rodo">&#10095;&emsp;Rodo</a>
                </div>
                <div class="footer-column">
                    <h2 class="elementor-heading-title elementor-size-default">Menu</h2>
                    <a href="#dyplomacja-kulturalna">&#10095;&emsp;Link 1</a>
                    <a href="#projekty">&#10095;&emsp;Link 2</a>
                    <a href="#o-nas">&#10095;&emsp;Link 3</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Prawa autorskie © 2024 Fundacja im. Jerzego Pleśniarowicza | Wykonanie <a href="https://www.gtcodelab.com" target="_blank" style="text-decoration: none;">GT Code Lab</a></p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var defaultFooter = document.getElementById('site-footer');
            if (defaultFooter) {
                defaultFooter.remove();
            }
        });
    </script>
<?php
}
?>