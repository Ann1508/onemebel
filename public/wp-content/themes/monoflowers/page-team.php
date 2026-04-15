<?php
/**
 * Template name: Команда
 * Страница о команде / компании.
 * Назначается странице в админке: Страницы → Шаблон: Команда
 *
 * Каждый блок — отдельный template-part, который можно
 * переиспользовать на любой другой странице через
 * get_template_part('template-parts/team-***-section')
 */
get_header();
?>

<div class="inner-breadcrumbs">
    <div class="container">
        <nav class="breadcrumbs">
            <a href="<?php echo home_url(); ?>">Главная</a>
            <span class="breadcrumbs__sep">|</span>
            <span class="breadcrumbs__current"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<?php get_template_part('template-parts/team-intro-section'); ?>

<?php get_template_part('template-parts/team-stats-section'); ?>

<?php get_template_part('template-parts/team-work-section'); ?>

<?php
/**
 * faq-section.php уже существует и используется на главной.
 * Переиспользуем его здесь без изменений.
 * Вопросы берутся из ACF-поля 'faq_items' текущей страницы
 * (или глобального поля из options — настраивается в faq-section.php).
 */
get_template_part('template-parts/faq-section');
?>

<?php get_template_part('template-parts/team-callback-section'); ?>

<?php get_footer(); ?>
