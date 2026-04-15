<?php
/**
 * Template part: Секция "Цены на обивку дивана"
 * Image 3: Серый фон, слева заголовок + текст + кнопка, справа таблица цен
 * Подключается через: get_template_part('template-parts/service-prices-section');
 *
 * ACF поля (на странице):
 *  - service_prices_title   (текст)
 *  - service_prices_note    (textarea)
 *  - service_prices_items   (Repeater: name + price)
 *
 * Или цены берутся из CPT 'price_item' с таксономией или meta_value 'service_type' = post slug.
 */

$prices_title = get_field('service_prices_title') ?: 'Цены на обивку дивана';
$prices_note  = get_field('service_prices_note')  ?: 'Вы можете прислать фотографии вашей мебели на E-mail или удобный Вам мессенджер с описанием (комментарием) и наши мастера сделают ориентировочный расчет цены перетяжки.';

// Пробуем взять цены из ACF Repeater
$price_rows = get_field('service_prices_items') ?: [];

// Иначе — из CPT price_item
if (empty($price_rows)) {
    $prices_query = new WP_Query([
        'post_type'      => 'price_item',
        'posts_per_page' => 8,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'meta_query'     => [
            'relation' => 'OR',
            [
                'key'     => 'service_type',
                'value'   => get_post_field('post_name', get_the_ID()),
                'compare' => '=',
            ],
            [
                'key'     => 'service_type',
                'compare' => 'NOT EXISTS',
            ],
        ],
    ]);

    if ($prices_query->have_posts()) {
        while ($prices_query->have_posts()) {
            $prices_query->the_post();
            $price_rows[] = [
                'name'  => get_the_title(),
                'price' => get_post_meta(get_the_ID(), 'price_value', true) ?: '25',
            ];
        }
        wp_reset_postdata();
    }
}

// Заглушки если совсем ничего нет
if (empty($price_rows)) {
    $price_rows = [
        ['name' => 'Кухонные уголки', 'price' => '25'],
        ['name' => 'Кухонные уголки', 'price' => '100'],
        ['name' => 'Кухонные уголки', 'price' => '25'],
        ['name' => 'Кухонные уголки', 'price' => '25'],
        ['name' => 'Кухонные уголки', 'price' => '25'],
        ['name' => 'Кухонные уголки', 'price' => '100'],
    ];
}
?>

<section class="service-prices">
    <div class="container">
        <div class="service-prices__inner">

            <!-- Левая колонка -->
            <div class="service-prices__left">
                <h2 class="service-prices__title"><?php echo esc_html($prices_title); ?></h2>
                <p class="service-prices__note"><?php echo esc_html($prices_note); ?></p>
                <a href="#modal-calc" class="btn service-prices__btn js-open-modal">
                    Рассчитать стоимость
                </a>
            </div>

            <!-- Правая колонка: таблица -->
            <div class="service-prices__right">
                <table class="service-prices__table">
                    <thead>
                        <tr>
                            <th class="service-prices__th">Наименование</th>
                            <th class="service-prices__th service-prices__th--right">Стоимость, BYN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($price_rows as $row) :
                            $name  = is_array($row) ? esc_html($row['name']  ?? '') : esc_html($row);
                            $price = is_array($row) ? esc_html($row['price'] ?? '25') : '25';
                        ?>
                        <tr class="service-prices__row">
                            <td class="service-prices__td"><?php echo $name; ?></td>
                            <td class="service-prices__td service-prices__td--right">от <?php echo $price; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
