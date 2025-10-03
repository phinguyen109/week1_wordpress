<?php
get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged
);

$news_query = new WP_Query( $args );
?>

<main id="site-content">
    <?php if ( $news_query->have_posts() ) : ?>
        <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
            <?php get_template_part( 'content' ); ?>
        <?php endwhile; ?>

        <div class="pagination">
            <?php
            echo paginate_links( array(
                'total' => $news_query->max_num_pages,
                'current' => $paged,
                'mid_size' => 2,
                'prev_text' => '« Trước',
                'next_text' => 'Sau »',
            ) );
            ?>
        </div>

        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Không có bài viết nào.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
