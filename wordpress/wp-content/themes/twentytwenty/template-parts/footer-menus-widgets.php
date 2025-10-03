<?php
/**
 * Footer Menus and Widgets
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 */

// Chỉ hiển thị phần menu và widget trong footer nếu có
if ( is_active_sidebar( 'footer-1' ) || has_nav_menu( 'footer' ) ) :
?>

<div class="footer-widgets">
    <div class="widget-area">

        <?php
        // Hiển thị Widget trong Footer - Footer Widget 1
        if ( is_active_sidebar( 'footer-1' ) ) :
            dynamic_sidebar( 'footer-1' );
        endif;
        ?>

    </div>

    <div class="footer-nav">
        <?php
        // Hiển thị menu Footer nếu có
        if ( has_nav_menu( 'footer' ) ) :
            wp_nav_menu(
                array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'depth'           => 1,
                )
            );
        endif;
        ?>
    </div>
</div>

<?php endif; ?>
