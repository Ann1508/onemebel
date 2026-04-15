<?php
/**
 * Template name: Услуги
 * Страница со списком всех услуг.
 * Назначается странице в админке: Страницы → Редактировать → Атрибуты страницы → Шаблон: Услуги
 */
get_header();
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

<section class="services-page">
    <div class="container">

        <!-- Заголовок и описание -->
        <div class="services-page__header">
            <h1 class="services-page__title"><?php the_title(); ?></h1>
            <?php
            $intro = get_field('services_intro');
            if ($intro) {
                echo '<p class="services-page__intro">' . esc_html($intro) . '</p>';
            } else {
                echo '<p class="services-page__intro">Более чем за 15 лет деятельности мы стали одним из лидеров в своей сфере, а лучшим подтверждением качества работы являются десятки положительных отзывов от довольных клиентов.</p>';
            }
            ?>
        </div>

        <!-- Сетка услуг -->
        <div class="services-page__grid">
            <?php
            $services_query = new WP_Query([
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ]);

            if ($services_query->have_posts()) :
                while ($services_query->have_posts()) : $services_query->the_post();
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    $excerpt = get_the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="services-page__card">
                <div class="services-page__card-img-wrap">
                    <?php if ($thumb) : ?>
                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="services-page__card-img">
                    <?php else : ?>
                    <div class="services-page__card-img-placeholder"></div>
                    <?php endif; ?>
                </div>
                <div class="services-page__card-footer">
                    <h2 class="services-page__card-title"><?php the_title(); ?></h2>
                    <span class="services-page__card-link">Подробнее</span>
                </div>
            </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Заглушки
                $placeholders = [
                    'Перетяжка диванов',
                    'Перетяжка кресел',
                    'Перетяжка стульев',
                    'Ремонт каркасов',
                    'Замена наполнителя',
                    'Перетяжка кухонных уголков',
                ];
                foreach ($placeholders as $ph) :
            ?>
            <div class="services-page__card">
                <div class="services-page__card-img-wrap">
                    <div class="services-page__card-img-placeholder"></div>
                </div>
                <div class="services-page__card-footer">
                    <h2 class="services-page__card-title"><?php echo esc_html($ph); ?></h2>
                    <span class="services-page__card-link">Подробнее</span>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
