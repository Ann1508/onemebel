<?php
$stats = get_field('team_stats') ?: [
    ['value' => '0 руб',   'label' => 'Вывоз и доставка'],
    ['value' => 'от 1 дня','label' => 'Сроки перетяжки'],
    ['value' => '5 371',   'label' => 'Образцов ткани'],
    ['value' => '12 мес',  'label' => 'Гарантия'],
];

$text1 = get_field('team_stats_text1')
    ?: 'Основное направление нашей работы – ремонт и перетяжка мягкой мебели. Такие предметы интерьера есть в каждом доме и квартире, но даже самые качественные из них со временем выходят из строя. Наша задача – превратить повреждённые, устаревшие, изношенные диваны, кресла и стулья в красивые и стильные вещи, подарить им новую жизнь и продлить срок эксплуатации.';
$text2 = get_field('team_stats_text2')
    ?: 'Основное направление нашей работы – ремонт и перетяжка мягкой мебели. Такие предметы интерьера есть в каждом доме и квартире, но даже самые качественные из них со временем выходят из строя. Наша задача – превратить повреждённые, устаревшие, изношенные диваны, кресла и стулья в красивые и стильные вещи, подарить им новую жизнь и продлить срок эксплуатации.';
?>

<section class="team-stats">
    <div class="container">

        <h2 class="team-stats__title">Наши преимущества</h2>

        <div class="team-stats__grid">
            <?php foreach ($stats as $stat) :
                $value = is_array($stat) ? esc_html($stat['value'] ?? '') : esc_html($stat);
                $label = is_array($stat) ? esc_html($stat['label'] ?? '') : '';
            ?>
            <div class="team-stats__item">
                <div class="team-stats__icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="24" cy="24" r="22" stroke="#462b25" stroke-width="1.5" stroke-dasharray="5 3"/>
                        <circle cx="24" cy="24" r="14" stroke="#462b25" stroke-width="1" stroke-dasharray="3 3" opacity="0.4"/>
                    </svg>
                </div>
                <span class="team-stats__value"><?php echo $value; ?></span>
                <span class="team-stats__label"><?php echo $label; ?></span>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="team-stats__texts">
            <?php if ($text1) : ?>
                <p class="team-stats__text"><?php echo esc_html($text1); ?></p>
            <?php endif; ?>
            <?php if ($text2) : ?>
                <p class="team-stats__text"><?php echo esc_html($text2); ?></p>
            <?php endif; ?>
        </div>

    </div>
</section>
