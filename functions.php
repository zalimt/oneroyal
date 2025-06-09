<?php
// Enqueue parent theme styles
add_action( 'wp_enqueue_scripts', 'oneroyal_enqueue_styles' );
function oneroyal_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Enqueue child theme styles + custom-header.css
// add_action( 'wp_enqueue_scripts', 'child_theme_scripts' );
// function child_theme_scripts() {
//     // Main child theme style
//     wp_enqueue_style(
//         'child-style',
//         get_stylesheet_uri(), // Points to style.css in your child theme
//         array( 'parent-style' )
//     );

//     // Enqueue custom-header.css inside custom-css directory
//     wp_enqueue_style(
//         'custom-header-style',
//         get_stylesheet_directory_uri() . '/custom-css/custom-header.css',
//         array( 'child-style' ), // ensures it loads after child-style
//         '1.0.0',
//         'all'
//     );
// }

// Define a constant for the base URL
if ( ! defined('ROYAL_BASE_URL') ) {
    define('ROYAL_BASE_URL', 'https://www2025.oneroyal.io/en');
}

if ( ! function_exists('localePath') ) {
    function localePath($path) {
        return ROYAL_BASE_URL . $path;
    }
}

/**
 * Shortcode to display ACF Repeater "feature_cards"
 */
function feature_cards_shortcode() {
    // Start output buffering
    ob_start();

    // Check if repeater has any rows
    if ( have_rows('feature_cards') ) {
        echo '<div class="feature-cards-wrapper">';

        // Loop through each row
        while ( have_rows('feature_cards') ) {
            the_row();

            // Grab sub field values
            $icon         = get_sub_field('icon__fc');          // Returns an array if set to Image return format
            $title        = get_sub_field('card_title__fc');
            $description  = get_sub_field('card_description__fc');
            $link_text    = get_sub_field('card_link_text__fc');
            $link_url     = get_sub_field('card_link_url__fc');

            // Start card HTML
            echo '<div class="feature-card">';

            // Icon
            if ( $icon ) {
                // Example: <img src="..." alt="..." />
                echo '<div class="feature-card-icon">';
                echo '<img src="' . esc_url($icon['url']) . '" alt="' . esc_attr($icon['alt']) . '" />';
                echo '</div>';
            }

            // Card Title
            if ( $title ) {
                echo '<h3 class="feature-card-title t-20 fw-600">' . esc_html($title) . '</h3>';
            }

            // Card Description
            if ( $description ) {
                echo '<p class="feature-card-description t-16 fw-400">' . esc_html($description) . '</p>';
            }

            // Link Text & URL
            if ( $link_text && $link_url ) {
                // e.g. "Learn more →"
                echo '<a class="feature-card-link t-16 fw-500" href="' . esc_url($link_url) . '">';
                echo esc_html($link_text);
                echo '</a>';
            }

            // End card
            echo '</div>';
        }

        echo '</div>'; // Close .feature-cards-wrapper
    } else {
        // No rows found
        echo '<!-- No feature_cards data found -->';
    }

    // Return the buffered output
    return ob_get_clean();
}
add_shortcode('feature_cards', 'feature_cards_shortcode');

// Register Custom Post Type: Careers
function create_careers_post_type() {
    $args = array(
        'label'              => 'Careers',
        'labels'             => array(
            'name'          => 'Careers',
            'singular_name' => 'Career',
            'add_new_item'  => 'Add New Career',
            'edit_item'     => 'Edit Career',
        ),
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'careers'),
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('careers', $args);
}

add_action('init', 'create_careers_post_type');

/**
 * TranslatePress Language Switcher Toggle
 */
function translatepress_language_switcher_toggle() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        console.log('TranslatePress toggle script loaded');
        
        // Function to close language switcher
        function closeLangSwitcher() {
            var $trpSwitcher = $('.trp-language-switcher.trp-language-switcher-container');
            if ($trpSwitcher.length === 0) {
                $trpSwitcher = $('.trp-language-switcher');
            }
            
            if ($trpSwitcher.length > 0 && $trpSwitcher.hasClass('active')) {
                $trpSwitcher.removeClass('active');
                console.log('Language switcher closed');
            }
        }
        
        // Toggle active class on trp-language-switcher when lang-switcher-toggle is clicked
        $(document).on('click', '#lang-switcher-toggle', function(e) {
            console.log('Lang switcher toggle clicked');
            e.preventDefault();
            e.stopPropagation();
            
            // Find the trp-language-switcher with trp-language-switcher-container class
            var $trpSwitcher = $('.trp-language-switcher.trp-language-switcher-container');
            
            if ($trpSwitcher.length > 0) {
                $trpSwitcher.toggleClass('active');
                console.log('Toggled active class on trp-language-switcher-container');
                console.log('Current classes:', $trpSwitcher.attr('class'));
            } else {
                console.log('trp-language-switcher-container not found');
                
                // Fallback: try just .trp-language-switcher
                var $fallbackSwitcher = $('.trp-language-switcher');
                if ($fallbackSwitcher.length > 0) {
                    $fallbackSwitcher.toggleClass('active');
                    console.log('Toggled active class on .trp-language-switcher (fallback)');
                }
            }
            
            return false;
        });
        
        // Close language switcher when clicking outside
        $(document).on('click', function(e) {
            var $target = $(e.target);
            
            // Check if click is outside the language switcher area
            if (!$target.closest('.mobile-lang-switcher').length && 
                !$target.closest('#lang-switcher-toggle').length &&
                !$target.closest('.trp-language-switcher').length) {
                closeLangSwitcher();
            }
        });
        
        // Prevent clicks inside the language switcher from closing it
        $(document).on('click', '.mobile-lang-switcher, .trp-language-switcher', function(e) {
            e.stopPropagation();
        });
        
        // Debug: log what elements we can find
        console.log('lang-switcher-toggle elements found:', $('#lang-switcher-toggle').length);
        console.log('trp-language-switcher-container elements found:', $('.trp-language-switcher.trp-language-switcher-container').length);
        console.log('trp-language-switcher elements found:', $('.trp-language-switcher').length);
    });
    </script>
    <?php
}
add_action('wp_footer', 'translatepress_language_switcher_toggle');



