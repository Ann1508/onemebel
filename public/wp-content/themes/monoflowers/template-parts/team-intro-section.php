<?php
/**
 * Template part: Секция "Intro о команде" — заголовок + фото
 * Подключается через: get_template_part('template-parts/team-intro-section')
 *
 * ACF-поля (страница Команда):
 *   team_image  — Image    — Фото справа
 *   team_text1  — Textarea — Первый абзац
 *   team_text2  — Textarea — Второй абзац
 *   team_text3  — Textarea — Третий абзац
 */

$team_image   = get_field('team_image');
$team_img_url = $team_image
    ? esc_url($team_image['url'])
    : get_template_directory_uri() . '/assets/img/team-main.jpg';

$team_text1 = get_field('team_text1')
    ?: 'Мы – современная, динамично развивающаяся компания, которая специализируется на ремонте, реставрации, перетяжке мебели.';
$team_text2 = get_field('team_text2')
    ?: 'Более чем за 15 лет деятельности мы стали одним из лидеров в своей сфере, а лучшим подтверждением качества работы являются десятки положительных отзывов от довольных клиентов.';
$team_text3 = get_field('team_text3')
    ?: 'Работаем как с физическими лицами так и с юридическими, выполняли работы на объектах таких как концертные залы, театры, кинотеатры, конференц залы и прочее. Территория обслуживания вся Беларусь!';
?>

<section class="team-intro">
    <div class="container">
        <div class="team-intro__inner">

            <div class="team-intro__left">
                <h1 class="team-intro__title"><?php the_title(); ?></h1>
                <?php if ($team_text1) : ?>
                    <p class="team-intro__text"><?php echo esc_html($team_text1); ?></p>
                <?php endif; ?>
                <?php if ($team_text2) : ?>
                    <p class="team-intro__text"><?php echo esc_html($team_text2); ?></p>
                <?php endif; ?>
                <?php if ($team_text3) : ?>
                    <p class="team-intro__text"><?php echo esc_html($team_text3); ?></p>
                <?php endif; ?>
            </div>

            <div class="team-intro__right">
                <div class="team-intro__img-wrap">
                    <img
                        src="<?php echo $team_img_url; ?>"
                        alt="Команда ONEMEBEL"
                        class="team-intro__img"
                    >
                </div>
            </div>

        </div>
    </div>
</section>
