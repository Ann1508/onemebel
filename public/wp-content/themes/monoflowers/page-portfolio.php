<?php
/**
 * Template name: Портфолио
 * Страница со всеми работами (портфолио).
 * Назначается странице в админке: Шаблон: Портфолио
 */
get_header();

// Получаем все категории (таксономию) работ
$portfolio_cats = get_terms([
    'taxonomy'   => 'portfolio_category',
    'hide_empty' => true,
]);

// Текущая выбранная категория
$current_cat = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';

// Запрос работ
$query_args = [
    'post_type'      => 'portfolio',
    'posts_per_page' => 12,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
];

if ($current_cat) {
    $query_args['tax_query'] = [[
        'taxonomy' => 'portfolio_category',
        'field'    => 'slug',
        'terms'    => $current_cat,
    ]];
}

$portfolio_query = new WP_Query($query_args);
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

        <!-- Заголовок -->
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
            <a href="<?php echo get_permalink(); ?>" class="portfolio-page__filter-btn <?php echo !$current_cat ? 'portfolio-page__filter-btn--active' : ''; ?>">
                Все работы
            </a>
            <?php if (!is_wp_error($portfolio_cats) && !empty($portfolio_cats)) :
                foreach ($portfolio_cats as $cat) : ?>
            <a href="<?php echo add_query_arg('cat', $cat->slug, get_permalink()); ?>"
               class="portfolio-page__filter-btn <?php echo $current_cat === $cat->slug ? 'portfolio-page__filter-btn--active' : ''; ?>">
                <?php echo esc_html($cat->name); ?>
            </a>
            <?php endforeach; endif; ?>

            <?php
            // Fallback-фильтры если таксономии нет
            if (is_wp_error($portfolio_cats) || empty($portfolio_cats)) :
                $fallback_filters = ['Диваны', 'Кресла', 'Стулья', 'Кровати', 'Кухонный уголок'];
                foreach ($fallback_filters as $f) :
            ?>
            <button class="portfolio-page__filter-btn"><?php echo esc_html($f); ?></button>
            <?php endforeach; endif; ?>
        </div>

        <!-- Сетка работ -->
        <div class="portfolio-page__grid" id="portfolio-grid">
            <?php if ($portfolio_query->have_posts()) :
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

        <!-- Показать больше -->
        <?php if ($portfolio_query->max_num_pages > 1) : ?>
        <div class="portfolio-page__more-wrap">
            <a href="?paged=2" class="portfolio-page__more-link" id="load-more-portfolio">Показать больше</a>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
