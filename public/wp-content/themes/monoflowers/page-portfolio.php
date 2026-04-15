<?php
/**
 * Template name: Портфолио
 * Страница со всеми работами (портфолио).
 * AJAX-фильтр через data-атрибуты и main.js
 */
get_header();

$portfolio_cats = get_terms([
    'taxonomy'   => 'portfolio_category',
    'hide_empty' => true,
]);

$nonce = wp_create_nonce('portfolio_filter_nonce');
?>

<div class="inner-breadcrumbs">
    <div class="container">
        <nav class="breadcrumbs">
            <a href="<?php echo home_url(); ?>">Главная</a>
            <span class="breadcrumbs__sep">|</span>
            <span class="breadcrumbs__current"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<section class="portfolio-page">
    <div class="container">

        <div class="portfolio-page__header">
            <h1 class="portfolio-page__title"><?php the_title(); ?></h1>
            <?php
            $intro = get_field('portfolio_intro');
            if ($intro) {
                echo '<p class="portfolio-page__intro">' . esc_html($intro) . '</p>';
            } else {
                echo '<p class="portfolio-page__intro">Более чем за 15 лет деятельности мы стали одним из лидеров в своей сфере, а лучшим подтверждением качества работы являются десятки положительных отзывов от довольных клиентов.</p>';
            }
            ?>
        </div>

        <!-- Фильтр-кнопки -->
        <div class="portfolio-page__filters">
            <!-- Кнопка «Все работы» -->
            <button class="portfolio-page__filter-btn portfolio-page__filter-btn--active"
                    data-cat="all"
                    data-nonce="<?php echo esc_attr($nonce); ?>">
                Все работы
            </button>

            <?php if (!is_wp_error($portfolio_cats) && !empty($portfolio_cats)) :
                foreach ($portfolio_cats as $cat) : ?>
            <button class="portfolio-page__filter-btn"
                    data-cat="<?php echo esc_attr($cat->slug); ?>"
                    data-nonce="<?php echo esc_attr($nonce); ?>">
                <?php echo esc_html($cat->name); ?>
            </button>
            <?php endforeach;
            else :
                $fallback_filters = [
                    ['name' => 'Диваны',          'slug' => 'divany'],
                    ['name' => 'Кресла',           'slug' => 'kresla'],
                    ['name' => 'Стулья',           'slug' => 'stulya'],
                    ['name' => 'Кровати',          'slug' => 'krovati'],
                    ['name' => 'Кухонный уголок',  'slug' => 'kuhonnyj-ugolok'],
                ];
                foreach ($fallback_filters as $f) : ?>
            <button class="portfolio-page__filter-btn"
                    data-cat="<?php echo esc_attr($f['slug']); ?>"
                    data-nonce="<?php echo esc_attr($nonce); ?>">
                <?php echo esc_html($f['name']); ?>
            </button>
            <?php endforeach; endif; ?>
        </div>

        <!-- Сетка работ -->
        <div class="portfolio-page__grid" id="portfolio-grid">
            <?php
            $portfolio_query = new WP_Query([
                'post_type'      => 'portfolio',
                'posts_per_page' => 12,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ]);

            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <a href="<?php the_permalink(); ?>" class="portfolio-page__item">
                <?php if ($thumb) : ?>
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="portfolio-page__item-img">
                <?php else : ?>
                <div class="portfolio-page__item-placeholder"></div>
                <?php endif; ?>
            </a>
            <?php endwhile; wp_reset_postdata();
            else :
                for ($i = 0; $i < 6; $i++) :
            ?>
            <div class="portfolio-page__item portfolio-page__item--placeholder"></div>
            <?php endfor; endif; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>