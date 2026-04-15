<?php
/**
 * Template для CPT 'service'.
 * Автоматически применяется к записям типа 'service'.
 * Путь: /wp-content/themes/monoflowers/single-service.php
 */
get_header();
?>

<?php get_template_part('template-parts/service-hero-section'); ?>

<?php get_template_part('template-parts/service-article-section'); ?>

<?php get_template_part('template-parts/service-prices-section'); ?>

<?php get_template_part('template-parts/faq-section'); ?>

<?php get_template_part('template-parts/team-stats-section'); ?>

<?php get_template_part('template-parts/team-callback-section'); ?>

<?php get_template_part('template-parts/service-other-section'); ?>

<?php get_footer(); ?>