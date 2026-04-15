<?php
$steps = get_field('order_steps') ?: [];

$steps_default = [
    [
        'title' => 'Консультируем и уточняем задачу',
        'text'  => 'Свяжитесь с нами любым удобным способом и расскажите о своих пожеланиях;',
    ],
    [
        'title' => 'Назначаем удобное время',
        'text'  => 'Согласуйте подходящее время выезда специалиста для оценки объема работ;',
    ],
    [
        'title' => 'Подбираем материалы и считаем стоимость',
        'text'  => 'Выберите материалы обивки мебели и наполнителя, получите расчет стоимости;',
    ],
    [
        'title' => 'Закрепляем условия договором',
        'text'  => 'Подпишите официальный договор, в котором будут указаны виды и сроки работ;',
    ],
    [
        'title' => 'Забираем мебель в работу',
        'text'  => 'Передайте мебель нашим сотрудникам для доставки в мастерскую;',
    ],
    [
        'title' => 'Возвращаем обновлённую мебель',
        'text'  => 'Получите обновлённые предметы интерьера и оплатите услугу.',
    ],
];

$steps_list = !empty($steps) ? $steps : $steps_default;

$cta_image = get_field('howtoorder_cta_image');
$cta_img_url = $cta_image ? esc_url($cta_image['url']) : get_template_directory_uri() . '/img/howtoorder-cta.jpg';
?>

<section class="howtoorder">
    <div class="container">
        <div class="howtoorder__inner">

            <div class="howtoorder__left">
                <h2 class="howtoorder__title">Как заказать<br>обивку мебели</h2>
                <p class="howtoorder__subtitle">В удобное для вас время мы вывезем вашу мебель в цех, вывоз и возврат БЕСПЛАТНО.</p>

                <a href="#modal-measurer" class="howtoorder__cta js-open-modal">
                    <div class="howtoorder__cta-img">
                        <img src="<?php echo $cta_img_url; ?>" alt="Вызвать замерщика">
                    </div>
                    <span class="howtoorder__cta-text">Вызвать замерщика</span>
                    <span class="howtoorder__cta-arrow">↗</span>
                </a>
            </div>

            <div class="howtoorder__steps">
                <?php foreach ($steps_list as $index => $step) :
                    $num   = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    $title = is_array($step) ? esc_html($step['title'] ?? '') : esc_html($step);
                    $text  = is_array($step) ? esc_html($step['text'] ?? '')  : '';
                ?>
                <div class="howtoorder__step">
                    <div class="howtoorder__step-header">
                        <span class="howtoorder__step-num">( <?php echo $num; ?> )</span>
                        <h3 class="howtoorder__step-title"><?php echo $title; ?></h3>
                    </div>
                    <?php if ($text) : ?>
                    <p class="howtoorder__step-text"><?php echo $text; ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>