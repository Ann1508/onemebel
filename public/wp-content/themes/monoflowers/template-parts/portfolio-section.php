<?php
/**
 * Template part: Секция "Наши работы"
 * Подключается в home.php через: get_template_part('template-parts/portfolio-section');
 *
 * Работы берутся из CPT 'portfolio' (или ACF Gallery).
 * Отображается сетка до 8 работ + карточка "Смотреть все работы".
 */

$portfolio_query = new WP_Query([
    'post_type'      => 'portfolio',
    'posts_per_page' => 8,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

$has_items = $portfolio_query->have_posts();
?>

<section class="portfolio">

    <!-- Фоновое изображение-баннер (первые фото) -->
    <div class="portfolio__banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/portfolio-bg.jpg')">
        <div class="portfolio__banner-title">Наши<br>работы</div>
    </div>

    <!-- Сетка работ -->
    <div class="portfolio__grid-wrap">
        <div class="container">
            <div class="portfolio__grid">

                <?php if ($has_items) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $thumb   = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        $is_before = get_post_meta(get_the_ID(), 'is_before', true);
                ?>
                <a href="<?php the_permalink(); ?>" class="portfolio__item">
                    <?php if ($thumb) : ?>
                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" class="portfolio__img">
                    <?php endif; ?>
                    <?php if ($is_before) : ?>
                    <span class="portfolio__badge">До перетяжки</span>
                    <?php endif; ?>
                </a>

                <?php endwhile; wp_reset_postdata();
                else :
                    // Заглушки
                    for ($i = 0; $i < 8; $i++) :
                        $badge = ($i === 3) ? '<span class="portfolio__badge">До перетяжки</span>' : '';
                ?>
                <div class="portfolio__item portfolio__item--placeholder">
                    <?php echo $badge; ?>
                </div>
                <?php endfor;
                endif; ?>

                <!-- Карточка "Смотреть все работы" — всегда последняя -->
                <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="portfolio__item portfolio__item--more">
                    <span class="portfolio__more-arrow">↗</span>
                    <span class="portfolio__more-text">Смотреть<br>все<br>работы</span>
                </a>

            </div>
        </div>
    </div>
</section>