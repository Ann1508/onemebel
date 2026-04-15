<?php
$current_id = get_the_ID();

$other_services = new WP_Query([
    'post_type'      => 'service',
    'posts_per_page' => 3,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post__not_in'   => [$current_id],
]);

$has_services = $other_services->have_posts();

$placeholders = [
    'Перетяжка диванов',
    'Перетяжка стульев',
    'Перетяжка кресел',
];
?>

<section class="service-other">
    <div class="container">

        <h2 class="service-other__title">Другие услуги</h2>

        <div class="service-other__grid">
            <?php if ($has_services) :
                while ($other_services->have_posts()) : $other_services->the_post();
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
            ?>
            <a href="<?php the_permalink(); ?>" class="service-other__card">
                <div class="service-other__card-image">
                    <?php if ($thumb) : ?>
                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="service-other__card-img">
                    <?php else : ?>
                    <div class="service-other__card-placeholder"></div>
                    <?php endif; ?>
                </div>
                <div class="service-other__card-footer">
                    <h3 class="service-other__card-title"><?php the_title(); ?></h3>
                    <span class="service-other__card-link">Подробнее</span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata();
            else :
                foreach ($placeholders as $name) : ?>
            <div class="service-other__card">
                <div class="service-other__card-image service-other__card-placeholder"></div>
                <div class="service-other__card-footer">
                    <h3 class="service-other__card-title"><?php echo esc_html($name); ?></h3>
                    <span class="service-other__card-link">Подробнее</span>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>

    </div>
</section>
