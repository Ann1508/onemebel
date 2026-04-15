<?php
/**
 * Template part: Секция "Как мы работаем" — текст + фото
 * Подключается через: get_template_part('template-parts/team-work-section')
 *
 * ACF-поля (страница Команда):
 *   team_work_image — Image    — Фото справа
 *   team_work_text1 — Textarea — Первый абзац
 *   team_work_text2 — Textarea — Второй абзац
 */

$work_image   = get_field('team_work_image');
$work_img_url = $work_image
    ? esc_url($work_image['url'])
    : get_template_directory_uri() . '/assets/img/team-work.jpg';

$work_text1 = get_field('team_work_text1')
    ?: 'Мы всегда идем навстречу клиентам и стараемся сделать весь процесс максимально удобным. Чтобы привести в порядок мягкую мебель, достаточно связаться с нами и рассказать о своих пожеланиях. Мастер выедет на место в удобное для вас время, произведет замеры и расчет.';
$work_text2 = get_field('team_work_text2')
    ?: 'Работы выполняются по официальному договору, а вывоз мебели и доставка обратно к заказчику осуществляется бесплатно. Более того, мы предлагаем интересные акции, приятные скидки, а также возможность оплаты в рассрочку.';
?>

<section class="team-work">
    <div class="container">
        <div class="team-work__inner">

            <div class="team-work__left">
                <h2 class="team-work__title">Как мы работаем</h2>
                <?php if ($work_text1) : ?>
                    <p class="team-work__text"><?php echo esc_html($work_text1); ?></p>
                <?php endif; ?>
                <?php if ($work_text2) : ?>
                    <p class="team-work__text"><?php echo esc_html($work_text2); ?></p>
                <?php endif; ?>
            </div>

            <div class="team-work__right">
                <div class="team-work__img-wrap">
                    <img
                        src="<?php echo $work_img_url; ?>"
                        alt="Как мы работаем"
                        class="team-work__img"
                    >
                </div>
            </div>

        </div>
    </div>
</section>
