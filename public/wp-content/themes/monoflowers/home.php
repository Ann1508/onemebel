<?php
/**
 * Template name: Startsite
 * Главная страница сайта.
 * Назначается странице в админке: Страницы → Редактировать → Атрибуты страницы → Шаблон: Startsite
 */
get_header();
?>

<?php get_template_part('template-parts/hero-section'); ?>

<?php get_template_part('template-parts/services-section'); ?>

<?php get_template_part('template-parts/fabrics-section'); ?>

<?php get_template_part('template-parts/process-section'); ?>

<?php get_template_part('template-parts/about-section'); ?>

<?php get_template_part('template-parts/portfolio-section'); ?>

<?php get_template_part('template-parts/reviews-section'); ?>

<?php get_template_part('template-parts/advantages-section'); ?>

<?php get_template_part('template-parts/howtoorder-section'); ?>

<?php get_template_part('template-parts/faq-section'); ?>

<?php get_footer(); ?>