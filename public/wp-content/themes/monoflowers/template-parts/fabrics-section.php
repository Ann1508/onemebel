<?php
/**
 * Template part: Секция "Ткани для обивки мебели и их образцы" + блок цен
 * Подключается в home.php через: get_template_part('template-parts/fabrics-section');
 *
 * Ткани берутся из ACF-поля (Repeater) "fabrics" на странице,
 * либо показываются заглушки.
 *
 * Цены: CPT 'price_item' или ACF-таблица (см. ниже).
 */

$fabrics = get_field('fabrics') ?: [];

$fabrics_default = [
    ['name' => 'Велюр',          'price' => 'от 25 byn'],
    ['name' => 'Флок',           'price' => 'от 25 byn'],
    ['name' => 'Рогожка',        'price' => 'от 25 byn'],
    ['name' => 'Шенилл',         'price' => 'от 25 byn'],
    ['name' => 'Жаккард',        'price' => 'от 25 byn'],
    ['name' => 'Экокожа',        'price' => 'от 25 byn'],
    ['name' => 'Натуральная кожа','price' => 'от 25 byn'],
];

$fabrics_list = !empty($fabrics) ? $fabrics : $fabrics_default;

// Цены из CPT 'price_item'
$prices_query = new WP_Query([
    'post_type'      => 'price_item',
    'posts_per_page' => 11,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

$price_tabs = [
    'repair'    => 'Ремонт мебели',
    'retapiz'   => 'Перетяжка мебели',
    'other'     => 'Другое',
];
?>

<section class="fabrics">
    <div class="container">

        <!-- Заголовок -->
        <h2 class="fabrics__title">Ткани для обивки мебели<br>и их образцы</h2>

        <!-- Кружки тканей -->
        <div class="fabrics__swatches">
            <?php foreach ($fabrics_list as $fabric) :
                $img_url = is_array($fabric) && isset($fabric['image']) ? esc_url($fabric['image']['url'] ?? '') : '';
                $name    = is_array($fabric) ? esc_html($fabric['name'] ?? '') : esc_html($fabric);
                $price   = is_array($fabric) ? esc_html($fabric['price'] ?? 'от 25 byn') : 'от 25 byn';
            ?>
            <div class="fabrics__swatch">
                <div class="fabrics__swatch-circle">
                    <?php if ($img_url) : ?>
                        <img src="<?php echo $img_url; ?>" alt="<?php echo $name; ?>" class="fabrics__swatch-img">
                    <?php else : ?>
                        <div class="fabrics__swatch-placeholder"></div>
                    <?php endif; ?>
                </div>
                <span class="fabrics__swatch-name"><?php echo $name; ?></span>
                <span class="fabrics__swatch-price"><?php echo $price; ?></span>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ===== Блок цен ===== -->
<section class="prices">
    <div class="container">
        <div class="prices__inner">

            <!-- Левая колонка: заголовок + табы + CTA -->
            <div class="prices__left">
                <h2 class="prices__title">Цены на<br>перетяжку<br>мягкой мебели</h2>

                <div class="prices__tabs">
                    <?php foreach ($price_tabs as $key => $label) : ?>
                    <button class="prices__tab <?php echo $key === 'repair' ? 'prices__tab--active' : ''; ?>"
                            data-tab="<?php echo esc_attr($key); ?>">
                        <?php echo esc_html($label); ?>
                    </button>
                    <?php endforeach; ?>
                </div>

                <p class="prices__note">
                    Вы можете прислать фотографии вашей мебели на E-mail или удобный Вам мессенджер с описанием (комментарием) и наши мастера сделают ориентировочный расчет цены перетяжки.
                </p>

                <a href="#modal-calc" class="prices__cta js-open-modal">Рассчитать стоимость</a>
            </div>

            <!-- Правая колонка: таблица -->
            <div class="prices__right">
                <table class="prices__table">
                    <thead>
                        <tr>
                            <th class="prices__th">Наименование</th>
                            <th class="prices__th prices__th--right">Стоимость, BYN</th>
                        </tr>
                    </thead>
                    <tbody class="prices__tbody">
                        <?php if ($prices_query->have_posts()) :
                            while ($prices_query->have_posts()) : $prices_query->the_post();
                                $price_val = get_post_meta(get_the_ID(), 'price_value', true);
                        ?>
                        <tr class="prices__row">
                            <td class="prices__td"><?php the_title(); ?></td>
                            <td class="prices__td prices__td--right">
                                <span class="prices__badge"><?php echo esc_html($price_val ?: 'от 25'); ?></span>
                            </td>
                        </tr>
                        <?php endwhile; wp_reset_postdata();
                        else :
                            $sample_prices = [25, 100, 25, 25, 25, 100, 25, 25, 25, 100, 25];
                            foreach ($sample_prices as $sp) :
                        ?>
                        <tr class="prices__row">
                            <td class="prices__td">Кухонные уголки</td>
                            <td class="prices__td prices__td--right">
                                <span class="prices__badge">от <?php echo $sp; ?></span>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
                <div class="prices__show-more">
                    <a href="#" class="prices__show-more-link">Показать больше</a>
                </div>
            </div>

        </div>
    </div>
</section>