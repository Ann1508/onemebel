<?php
/**
 * Template part: Секция "Коротко о нас" + логотипы производителей
 * Подключается в home.php через: get_template_part('template-parts/about-section');
 *
 * Изображение и текст берутся из ACF или из настроек страницы.
 * Логотипы производителей — из ACF Repeater 'brands'.
 */

$about_image = get_field('about_image');
$about_img_url = $about_image ? esc_url($about_image['url']) : get_template_directory_uri() . '/img/about-sofa.jpg';
$about_text1 = get_field('about_text1') ?: 'Наша команда помогает клиентам принимать мудрые решения и избегать ошибок. Позвольте нашим специалистам сделать мебель вашей мечты реальностью. Мы сможем предоставить недорогую альтернативу и отличный сервис.';
$about_text2 = get_field('about_text2') ?: 'С 2011 года мы осуществляем квалифицированное обновление мягкой мебели и предметов интерьера частных и юридических лиц в Беларуси.';

$badges = [
    'Исполнение сроков',
    'Контроль качества',
    'Частный подход',
    'Опытные мастера',
];

$brands = get_field('brands') ?: [];
$brands_default = [
    'Пинскдрев', 'AMI', 'Молодечномебель', 'Progress', 'Бренд 5', 'Могилевдрев',
    'Корсак', 'Мебель бренд', 'Неман', 'Треви', 'PUFF', 'Борисовдрев',
];
$brands_list = !empty($brands) ? $brands : $brands_default;
?>

<section class="about">
    <div class="container">
        <div class="about__inner">

            <!-- Левая колонка: заголовок + текст -->
            <div class="about__left">
                <h2 class="about__title">Коротко о нас</h2>
                <p class="about__text"><?php echo esc_html($about_text1); ?></p>
                <p class="about__text"><?php echo esc_html($about_text2); ?></p>
            </div>

            <!-- Правая колонка: бэджи + фото -->
            <div class="about__right">
                <div class="about__badges">
                    <?php foreach ($badges as $badge) : ?>
                    <div class="about__badge">
                        <span class="about__badge-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="15" height="15" rx="3.5" stroke="#222" stroke-opacity="0.3"/>
                            </svg>
                        </span>
                        <span class="about__badge-text"><?php echo esc_html($badge); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="about__image">
                    <img src="<?php echo $about_img_url; ?>" alt="О компании ONEMEBEL" class="about__img">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== Производители ===== -->
<section class="brands">
    <div class="container">
        <h2 class="brands__title">Перетягиваем диваны и другую<br>мебель следующих производителей</h2>

        <div class="brands__grid">
            <?php foreach ($brands_list as $brand) :
                $logo_url = is_array($brand) ? esc_url($brand['logo']['url'] ?? '') : '';
                $brand_name = is_array($brand) ? esc_html($brand['name'] ?? '') : esc_html($brand);
            ?>
            <div class="brands__item">
                <?php if ($logo_url) : ?>
                    <img src="<?php echo $logo_url; ?>" alt="<?php echo $brand_name; ?>" class="brands__logo">
                <?php else : ?>
                    <span class="brands__name"><?php echo $brand_name; ?></span>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>