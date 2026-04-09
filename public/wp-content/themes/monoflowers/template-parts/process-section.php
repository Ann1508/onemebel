<?php
/**
 * Template part: Секция "Что входит в работу по перетяжке мебели"
 * Подключается в home.php через: get_template_part('template-parts/process-section');
 *
 * Шаги берутся из ACF Repeater 'process_steps' или показываются заглушки.
 */

$steps = get_field('process_steps') ?: [];

$steps_default = [
    [
        'title' => 'Бесплатный выезд мастера',
        'text'  => 'Выезд БЕСПЛАТНЫЙ и возможен в любой день недели, включая выходные, с 9:00 до 21:00.',
    ],
    [
        'title' => 'Бесплатный выезд мастера',
        'text'  => 'Мастер привозит с собой образцы ткани, рассчитывает стоимость и заключает договор.',
    ],
    [
        'title' => 'Бесплатный выезд мастера',
        'text'  => 'В удобное для вас время мы вывезем вашу мебель в цех, вывоз и возврат БЕСПЛАТНО.',
    ],
    [
        'title' => 'Ремонт и перетяжка мебели',
        'text'  => 'Работа начинается с выявления дефектов, которые исправляют, далее шьют новую обивку и натягивают.',
    ],
    [
        'title' => 'Контроль качества и доставка',
        'text'  => 'Обновлённая мебель проверяется контролем качества, упаковывается и доставляется клиенту.',
    ],
];

$steps_list = !empty($steps) ? $steps : $steps_default;

// Изображение CTA-блока
$cta_image = get_field('process_cta_image');
$cta_img_url = $cta_image ? esc_url($cta_image['url']) : get_template_directory_uri() . '/img/process-cta.jpg';
?>

<section class="process">
    <div class="container">
        <div class="process__inner">

            <!-- Левая колонка -->
            <div class="process__left">
                <h2 class="process__title">Что входит<br>в работу<br>по перетяжке<br>мебели</h2>

                <a href="#modal-calc" class="process__cta js-open-modal">
                    <div class="process__cta-img">
                        <img src="<?php echo $cta_img_url; ?>" alt="Получить расчёт стоимости">
                    </div>
                    <span class="process__cta-text">Получить расчет<br>стоимости</span>
                    <span class="process__cta-arrow">↗</span>
                </a>
            </div>

            <!-- Правая колонка: список шагов -->
            <div class="process__steps">
                <?php foreach ($steps_list as $index => $step) :
                    $num   = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    $title = is_array($step) ? esc_html($step['title'] ?? '') : esc_html($step);
                    $text  = is_array($step) ? esc_html($step['text'] ?? '')  : '';
                ?>
                <div class="process__step">
                    <div class="process__step-header">
                        <span class="process__step-num">( <?php echo $num; ?> )</span>
                        <h3 class="process__step-title"><?php echo $title; ?></h3>
                    </div>
                    <?php if ($text) : ?>
                    <p class="process__step-text"><?php echo $text; ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>