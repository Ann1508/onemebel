<?php

$advantages = get_field('advantages') ?: [];

$advantages_default = [
    [
        'title' => 'Скорость',
        'text'  => 'Мы вернём вам готовое изделие в срок от 1 дня, в зависимости от сложности работ',
    ],
    [
        'title' => 'Бесплатный выезд',
        'text'  => 'Бесплатный выезд дизайнера на дом с образцами материалов, более 5 000',
    ],
    [
        'title' => 'Документы',
        'text'  => 'Предоставляем документы и гарантию на все виды работ, проект курирует менеджер',
    ],
    [
        'title' => 'Коллектив',
        'text'  => 'Лучшие профессионалы с опытом работы от 15 лет будут заниматься вашей мебелью',
    ],
];

$advantages_list = !empty($advantages) ? $advantages : $advantages_default;

$adv_image = get_field('advantages_image');
$adv_img_url = $adv_image ? esc_url($adv_image['url']) : get_template_directory_uri() . '/assets/img/advantages-sofa.jpg';
$adv_overlay_text = get_field('advantages_overlay_text') ?: 'Компания Rtmebel предлагает все виды услуг по перетяжке мягкой мебели в Минске. Мы приводим в порядок даже сильно изношенные предметы интерьера, а также предлагаем ряд преимуществ:';
?>

<section class="advantages">
    <div class="container">
        <div class="advantages__inner">

            <div class="advantages__image-card">
                <img src="<?php echo $adv_img_url; ?>" alt="Преимущества перетяжки мебели" class="advantages__img">
                <div class="advantages__overlay">
                    <h2 class="advantages__overlay-title">Преимущества<br>перетяжки мебели</h2>
                    <p class="advantages__overlay-text"><?php echo esc_html($adv_overlay_text); ?></p>
                </div>
            </div>

            <div class="advantages__list">
                <?php foreach ($advantages_list as $adv) :
                    $title = is_array($adv) ? esc_html($adv['title'] ?? '') : esc_html($adv);
                    $text  = is_array($adv) ? esc_html($adv['text'] ?? '')  : '';
                ?>
                <div class="advantages__item">
                    <div class="advantages__item-content">
                        <h3 class="advantages__item-title"><?php echo $title; ?></h3>
                        <?php if ($text) : ?>
                        <p class="advantages__item-text"><?php echo $text; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="advantages__item-icon">
                        <span class="advantages__item-spinner"></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>