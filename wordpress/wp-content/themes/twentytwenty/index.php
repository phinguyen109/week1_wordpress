<?php
/**
 * Template hiển thị danh sách tin tức giống FIT TDC
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Custom
 */

get_header();
?>

<main id="site-content" class="news-archive">

    <!-- Banner đầu trang -->
    <section class="news-banner" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/banner.jpg') center/cover no-repeat; height: 250px; display:flex; align-items:center; justify-content:center;">
        <h1 class="news-heading" style="color:#000; font-size:36px; font-weight:bold; text-transform:uppercase;">
            Tin tức
        </h1>
    </section>

    <div class="news-container" style="display:flex; gap:30px; max-width:1200px; margin:40px auto;">

        <!-- Danh sách bài viết -->
        <div class="news-list" style="flex:2;">
            <?php
            // Lấy số trang hiện tại
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            // Custom query: mỗi trang 4 bài
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'paged'          => $paged
            );
            $news_query = new WP_Query( $args );

            if ( $news_query->have_posts() ) :
                while ( $news_query->have_posts() ) : $news_query->the_post();
            ?>
                    
                    <article class="news-item" style="display:flex; gap:20px; margin-bottom:30px; border-bottom:1px solid #eee; padding-bottom:20px;">
                        <!-- Ảnh thumbnail -->
                        <div class="news-thumb" style="flex:1; max-width:250px;">
                            <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'medium_large', ['style'=>'width:100%; height:auto; border-radius:5px;'] );
                                } else { ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.jpg" alt="<?php the_title(); ?>" style="width:100%; height:auto;">
                                <?php } ?>
                            </a>
                        </div>

                        <!-- Nội dung -->
                        <div class="news-content" style="flex:2;">
                            <div class="news-meta" style="color:#0a4d8c; font-weight:bold; margin-bottom:5px;">
                                <span style="font-size:24px;"><?php echo get_the_date('d'); ?></span>
                                <span style="text-transform:uppercase;"><?php echo get_the_date(' M Y'); ?></span>
                            </div>
                            <h2 class="news-title" style="margin:10px 0;">
                                <a href="<?php the_permalink(); ?>" style="color:#000; font-size:20px; font-weight:600; text-decoration:none;">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="news-excerpt" style="color:#555;">
                                <?php echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" style="display:inline-block; margin-top:10px; color:#0a4d8c; font-weight:bold;">
                                Xem chi tiết
                            </a>
                        </div>
                    </article>

            <?php
                endwhile;

                // ✅ Phân trang
                echo '<div class="pagination-wrapper">';
                echo paginate_links( array(
                    'total'        => $news_query->max_num_pages,
                    'current'      => $paged,
                    'mid_size'     => 2,
                    'prev_text'    => '« Trước',
                    'next_text'    => 'Sau »',
                    'type'         => 'list',
                ) );
                echo '</div>';

                wp_reset_postdata();
            else :
                echo '<p>Không có bài viết nào.</p>';
            endif;
            ?>
        </div>

        <!-- Sidebar -->
        <aside class="news-sidebar" style="flex:1;">
            <h3 style="color:#0a4d8c; font-size:20px; font-weight:bold; margin-bottom:20px;">Bài viết nổi bật</h3>
            <ul style="list-style:none; padding:0; margin:0;">
                <?php
                $featured = new WP_Query(array(
                    'posts_per_page' => 5,
                    'orderby'        => 'comment_count'
                ));
                if ( $featured->have_posts() ) :
                    while ( $featured->have_posts() ) : $featured->the_post(); ?>
                        <li style="margin-bottom:15px;">
                            <a href="<?php the_permalink(); ?>" style="color:#000; text-decoration:none;">
                                <?php the_title(); ?>
                            </a>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </ul>
        </aside>

    </div>

</main>

<?php
get_footer();
