<?php
/**
 * Displays the menus and widgets at the end of the main element.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$has_footer_menu = has_nav_menu('footer');
$has_social_menu = has_nav_menu('social');

$has_sidebar_1 = is_active_sidebar('sidebar-1');
$has_sidebar_2 = is_active_sidebar('sidebar-2');
$has_sidebar_3 = is_active_sidebar('sidebar-3');

if ($has_footer_menu || $has_social_menu || $has_sidebar_1 || $has_sidebar_2 || $has_sidebar_3) {
    ?>
    <!-- Footer -->
    <section id="footer">
        <div class="container">

            <!-- 3 cột widget -->
            <div class="row text-center text-xs-center text-sm-left text-md-left">
                <?php if ($has_sidebar_1): ?>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <ul class="list-unstyled quick-links">
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($has_sidebar_2): ?>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <ul class="list-unstyled quick-links">
                            <?php dynamic_sidebar('sidebar-2'); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($has_sidebar_3): ?>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <ul class="list-unstyled quick-links">
                            <?php dynamic_sidebar('sidebar-3'); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            

        </div>
    </section>
    <!-- ./Footer -->
    <?php
}
?>