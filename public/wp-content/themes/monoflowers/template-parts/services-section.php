<?php
/**
 * Template part: Секция "Наши услуги"
 * "Больше услуг" → ведёт на страницу с шаблоном "Услуги" (page-services.php)
 */

$services = new WP_Query([
    'post_type'      => 'service',
    'posts_per_page' => 5,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Ищем страницу с шаблоном "Услуги"
$services_page = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-services.php']);
$services_page_url = !empty($services_page) ? get_permalink($services_page[0]->ID) : get_post_type_archive_link('service');
?>

<section class="services">
    <div class="container">
        <h2 class="services__title">Наши услуги</h2>

        <div class="services__grid">
            <?php if ( $services->have_posts() ) : ?>
                <?php while ( $services->have_posts() ) : $services->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="service-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="service-card__image">
                        <?php the_post_thumbnail('medium', ['class' => 'service-card__img']); ?>
                    </div>
                    <?php endif; ?>

                    <div class="service-card__footer">
                        <h3 class="service-card__title"><?php the_title(); ?></h3>
                        <span class="service-card__link">Подробнее</span>
                    </div>
                </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <?php
                $placeholders = [
                    'Перетяжка диванов',
                    'Перетяжка стульев',
                    'Перетяжка кресел',
                    'Ремонт каркасов',
                    'Замена наполнителя',
                ];
                foreach ($placeholders as $name) : ?>
                <div class="service-card">
                    <div class="service-card__image service-card__image--placeholder"></div>
                    <div class="service-card__footer">
                        <h3 class="service-card__title"><?php echo esc_html($name); ?></h3>
                        <span class="service-card__link">Подробнее</span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Карточка "Больше услуг" — ведёт на страницу Услуги -->
            <a href="<?php echo esc_url($services_page_url); ?>" class="service-card service-card--more">
                <span class="service-card--more__arrow">↗</span>
                <span class="service-card--more__text">Больше услуг</span>
            </a>
        </div>
    </div>
</section>
