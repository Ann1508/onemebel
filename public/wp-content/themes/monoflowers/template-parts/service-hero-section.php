<?php
/**
 * Template part: Герой-секция страницы услуги
 * Image 1: Заголовок, описание, кнопка слева + фото справа
 * Подключается через: get_template_part('template-parts/service-hero-section');
 *
 * ACF поля (на странице):
 *  - service_hero_title   (текст)
 *  - service_hero_text    (textarea)
 *  - service_hero_image   (image)
 */

$title      = get_field('service_hero_title')   ?: get_the_title();
$text       = get_field('service_hero_text')    ?: 'Перетяжка дивана позволяет вернуть мягкой мебели привлекательный внешний вид, изменить надоевший дизайн, обновить интерьер. Но такая процедура требует профессионального подхода, чтобы результат оправдал ожидания и сохранился на долгое время.';
$hero_image = get_field('service_hero_image');
$img_url    = $hero_image ? esc_url($hero_image['url']) : get_template_directory_uri() . '/assets/img/service-hero-default.jpg';
$img_alt    = $hero_image ? esc_attr($hero_image['alt']) : esc_attr($title);

// Хлебные крошки
$parent = get_post_parent();
?>

<section class="service-hero">
    <div class="container">

        <!-- Хлебные крошки -->
        <nav class="service-hero__breadcrumbs" aria-label="breadcrumb">
            <a href="<?php echo home_url('/'); ?>" class="service-hero__breadcrumb-link">Главная</a>
            <span class="service-hero__breadcrumb-sep">›</span>
            <?php if ($parent) : ?>
                <a href="<?php echo get_permalink($parent->ID); ?>" class="service-hero__breadcrumb-link">
                    <?php echo esc_html(get_the_title($parent->ID)); ?>
                </a>
                <span class="service-hero__breadcrumb-sep">›</span>
            <?php endif; ?>
            <span class="service-hero__breadcrumb-current"><?php echo esc_html($title); ?></span>
        </nav>

        <div class="service-hero__inner">

            <!-- Левая: заголовок + текст + кнопка -->
            <div class="service-hero__left">
                <h1 class="service-hero__title"><?php echo esc_html($title); ?></h1>
                <p class="service-hero__text"><?php echo esc_html($text); ?></p>
                <a href="#modal-calc" class="btn service-hero__btn js-open-modal">
                    Рассчитать стоимость
                </a>
            </div>

            <!-- Правая: фотография -->
            <div class="service-hero__right">
                <div class="service-hero__image">
                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="service-hero__img">
                </div>
            </div>

        </div>
    </div>
</section>
