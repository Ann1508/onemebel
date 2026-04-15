<?php
/**
 * ajax-handlers.php
 * Подключается в functions.php:
 *   require get_template_directory() . '/inc/ajax-handlers.php';
 *
 * Содержит:
 *  1. Обработчик формы "Рассчитать стоимость" — отправка письма
 *  2. AJAX-фильтр портфолио
 *  3. AJAX-табы цен
 *  4. Передача ajaxurl в JS
 */

/* =============================================
   ПЕРЕДАТЬ ajaxurl В СКРИПТЫ
============================================= */

/* =============================================
   1. ОБРАБОТЧИК ФОРМЫ «РАССЧИТАТЬ СТОИМОСТЬ»
============================================= */
add_action('wp_ajax_modal_calc_submit',        'onemebel_modal_calc_submit');
add_action('wp_ajax_nopriv_modal_calc_submit', 'onemebel_modal_calc_submit');

function onemebel_modal_calc_submit() {
    // Проверка nonce
    if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'modal_calc_submit') ) {
        wp_send_json_error(['message' => 'Security check failed']);
    }

    // Санитизация данных
    $furniture_type   = sanitize_text_field($_POST['furniture_type']   ?? '');
    $furniture_size   = sanitize_text_field($_POST['furniture_size']   ?? '');
    $fluffiness       = sanitize_text_field($_POST['fluffiness']       ?? '');
    $filler           = sanitize_text_field($_POST['filler']           ?? '');
    $fabrics          = sanitize_text_field($_POST['fabrics']          ?? '');
    $city             = sanitize_text_field($_POST['city']             ?? '');
    $name             = sanitize_text_field($_POST['name']             ?? '');
    $phone            = sanitize_text_field($_POST['phone']            ?? '');
    $comment          = sanitize_textarea_field($_POST['comment']      ?? '');
    $contact_methods  = sanitize_text_field($_POST['contact_methods']  ?? '');

    // Обязательные поля
    if ( empty($name) || empty($phone) ) {
        wp_send_json_error(['message' => 'Required fields missing']);
    }

    // Email владельца сайта
    $admin_email = get_field('notification_email', 'option') ?: get_option('admin_email');

    $subject = '🛋 Новая заявка: Рассчитать стоимость — ' . $name;

    $message  = "<h2>Новая заявка с сайта</h2>\n";
    $message .= "<table cellpadding='6' cellspacing='0' style='border-collapse:collapse;font-family:Arial,sans-serif;font-size:14px;'>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Имя</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$name}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Телефон</td><td style='padding:6px 12px;border:1px solid #ddd;'>+375 {$phone}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Город</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$city}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Тип мебели</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$furniture_type}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Размер мебели</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$furniture_size}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Пышность</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$fluffiness}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Наполнитель</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$filler}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Тип ткани</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$fabrics}</td></tr>\n";
    $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Способ связи</td><td style='padding:6px 12px;border:1px solid #ddd;'>{$contact_methods}</td></tr>\n";
    if ( $comment ) {
        $message .= "<tr><td style='font-weight:bold;padding:6px 12px;background:#f5f0ec;border:1px solid #ddd;'>Комментарий</td><td style='padding:6px 12px;border:1px solid #ddd;'>" . nl2br($comment) . "</td></tr>\n";
    }
    $message .= "</table>\n";
    $message .= "<p style='font-size:12px;color:#999;margin-top:20px;'>Отправлено с сайта " . get_bloginfo('url') . " | " . date('d.m.Y H:i') . "</p>\n";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>',
    ];

    $sent = wp_mail($admin_email, $subject, $message, $headers);

    if ( $sent ) {
        wp_send_json_success(['message' => 'OK']);
    } else {
        // Даже если письмо не отправилось, показываем успех пользователю,
        // но логируем ошибку
        error_log('ONEMEBEL: wp_mail failed for modal_calc_submit. Name: ' . $name . ', Phone: ' . $phone);
        wp_send_json_success(['message' => 'OK (mail failed)']);
    }
}

/* =============================================
   2. AJAX-ФИЛЬТР ПОРТФОЛИО
============================================= */
add_action('wp_ajax_portfolio_filter',        'onemebel_portfolio_filter');
add_action('wp_ajax_nopriv_portfolio_filter', 'onemebel_portfolio_filter');

function onemebel_portfolio_filter() {
    $cat = sanitize_text_field($_POST['cat'] ?? '');

    $args = [
        'post_type'      => 'portfolio',
        'posts_per_page' => 12,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];

    if ( $cat && $cat !== 'all' ) {
        $args['tax_query'] = [[
            'taxonomy' => 'portfolio_category',
            'field'    => 'slug',
            'terms'    => $cat,
        ]];
    }

    $q = new WP_Query($args);
    $output = '';

    if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
            $q->the_post();
            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $output .= '<a href="' . esc_url(get_permalink()) . '" class="portfolio-page__item">';
            if ( $thumb ) {
                $output .= '<img src="' . esc_url($thumb) . '" alt="' . esc_attr(get_the_title()) . '" class="portfolio-page__item-img">';
            } else {
                $output .= '<div class="portfolio-page__item-placeholder"></div>';
            }
            $output .= '</a>';
        }
        wp_reset_postdata();
    } else {
        $output = '<p class="portfolio-page__empty">Работы не найдены</p>';
    }

    echo $output;
    wp_die();
}

/* =============================================
   3. AJAX-ТАБЫ ЦЕН
============================================= */
add_action('wp_ajax_prices_tab',        'onemebel_prices_tab');
add_action('wp_ajax_nopriv_prices_tab', 'onemebel_prices_tab');

function onemebel_prices_tab() {
    $tab = sanitize_text_field($_POST['tab'] ?? 'repair');

    // Маппинг таба → meta_value поля 'price_tab' у price_item
    $tab_map = [
        'repair'  => 'repair',
        'retapiz' => 'retapiz',
        'other'   => 'other',
    ];

    $tab_value = $tab_map[$tab] ?? 'repair';

    $args = [
        'post_type'      => 'price_item',
        'posts_per_page' => 11,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];

    // Если у вас в ACF нет поля price_tab — просто показываем все цены
    // Раскомментируйте meta_query когда добавите поле price_tab в ACF:
    $args['meta_query'] = [[
        'key'     => 'price_tab',
        'value'   => $tab_value,
        'compare' => '=',
    ]];


    $q = new WP_Query($args);
    $output = '';

    if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
            $q->the_post();
            $price = get_post_meta(get_the_ID(), 'price_value', true) ?: '25';
            $output .= '<tr class="prices__row">';
            $output .= '<td class="prices__td">' . esc_html(get_the_title()) . '</td>';
            $output .= '<td class="prices__td prices__td--right"><span class="prices__badge">от ' . esc_html($price) . '</span></td>';
            $output .= '</tr>';
        }
        wp_reset_postdata();
    } else {
        $output = '<tr><td colspan="2" class="prices__td">Позиции не найдены</td></tr>';
    }

    echo $output;
    wp_die();
}
