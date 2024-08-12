<?php
/*
Plugin Name: Może Ci Się Spodobać
Description: Wyświetla listę 3 artykułów w sekcji "Może Ci Się Spodobać" z klasycznym wyglądem.
Version: 1.4
Author: Twoje Imię
*/

// Rejestracja stylów
function mcss_enqueue_styles()
{
    wp_enqueue_style('mcss-styles', plugin_dir_url(__FILE__) . 'mcss-styles.css');
}
add_action('wp_enqueue_scripts', 'mcss_enqueue_styles');

// Shortcode do wyświetlania artykułów
function mcss_moze_ci_sie_spodobac_shortcode($atts)
{
    // Pobieranie 3 ostatnich artykułów
    $args = array(
        'posts_per_page' => 3,
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="mcss-similar-posts">';
        echo '<h2 class="mcss-section-title">Zobacz także</h2>'; // Dodany tytuł
        while ($query->have_posts()) {
            $query->the_post();
?>
            <div class="mcss-single-post">
                <!--                 <div class="mcss-post-image">
                    <?php if (has_post_thumbnail()) { ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php } ?>
                </div> -->
                <div class="mcss-post-content">
                    <span class="mcss-post-date"><?php echo get_the_date(); ?></span>
                    <h3 class="mcss-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="mcss-post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                </div>
            </div>
    <?php
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>Brak artykułów do wyświetlenia.</p>';
    }

    return ob_get_clean();
}
add_shortcode('moze_ci_sie_spodobac', 'mcss_moze_ci_sie_spodobac_shortcode');

// Dodawanie stylów
function mcss_add_styles()
{
    ?>
    <style>
        .mcss-similar-posts {
            margin: 40px 0;

        }

        .mcss-section-title {
            color: var(--e-global-color-text);
            font-family: "Montserrat", Sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            font-style: normal;
            text-decoration: none;
            line-height: 1.2em;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            text-align: left;
            /* Wyśrodkowanie tytułu */
        }

        .mcss-single-post {
            display: flex;
            flex-direction: column;
            /* Obrazek nad tekstem */
            margin-bottom: 30px;
            text-align: left;
            /* Wyśrodkowany tekst */
            border-bottom: 1px solid #e2e2e2;
            /* Linie oddzielające poszczególne posty */
            padding-bottom: 20px;
            padding-right: 8px;
        }

        .mcss-single-post:last-child {
            border-bottom: none;
            /* Usuń linię pod ostatnim postem */
        }

        .mcss-post-image {
            margin-bottom: 15px;
            flex-shrink: 0;
        }

        .mcss-post-image img {
            width: 75%;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
            /* Delikatne zaokrąglenie rogów obrazka */
        }

        .mcss-post-content {
            flex-grow: 1;
        }

        .mcss-post-date {
            display: block;
            color: var(--e-global-color-text);
            margin-bottom: 10px;
            font-size: 14px;
            font-style: italic;
            /* Klasyczny akcent */
        }

        .mcss-post-title {
            margin: 0;
            font-size: 22px;
            line-height: 1.4;
        }

        .mcss-post-title a {
            text-decoration: none;
            color: var(--e-global-color-text);
        }

        .mcss-post-title a:hover {
            text-decoration: underline;
            color: var(--e-global-color-text);
            /* Mocniejszy kolor na hover */
        }

        .mcss-post-excerpt {
            margin-top: 15px;
            font-size: 16px;
            color: var(--e-global-color-text);
            line-height: 1.5;
        }
    </style>
<?php
}
add_action('wp_head', 'mcss_add_styles');

?>