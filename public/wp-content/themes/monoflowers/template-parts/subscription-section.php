<?php
/**
 * Template part for displaying Subscription section
 */


// Get fields from ACF
$subscription_video = get_field('subscription_video');
$subscription_poster = get_field('subscription_poster');
$subscription_image = get_field('subscription_image');
$subscription_badge = get_field('subscription_badge');
$subscription_title = get_field('subscription_title');
$subscription_text = get_field('subscription_text');
$subscription_button = get_field('subscription_button');

// Set default values
$title = $subscription_title ?: 'Flower subscription';
$text = $subscription_text ?: 'A regular delivery of fresh flowers to bring beauty and comfort to your home.';

// Handle button field (ACF Link field)
if (!empty($subscription_button)) {
    $button_link = !empty($subscription_button['url']) ? $subscription_button['url'] : '#';
    $button_text = !empty($subscription_button['title']) ? $subscription_button['title'] : ТЕКСТ
    $button_target = !empty($subscription_button['target']) ? $subscription_button['target'] : '_self';
} else {
    $button_link = '#';
    $button_text = ТЕКСТ
    $button_target = '_self';
}
?>

<section class="subscription-block">
    <div class="container">
        <div class="subscription-block__content">
            <?php if (!empty($subscription_video) || !empty($subscription_poster) || !empty($subscription_image)) : ?>
                <div class="subscription-block__image">
                    <?php if (!empty($subscription_video)) : ?>
                        <video 
                            class="subscription-block__video" 
                            autoplay 
                            loop 
                            muted 
                            playsinline
                            <?php if (!empty($subscription_poster)) : ?>
                                poster="<?php echo esc_url($subscription_poster['url']); ?>"
                            <?php endif; ?>
                        >
                            <source src="<?php echo esc_url($subscription_video['url']); ?>" type="<?php echo esc_attr($subscription_video['mime_type']); ?>">
                        </video>
                    <?php elseif (!empty($subscription_poster)) : ?>
                        <img src="<?php echo esc_url($subscription_poster['url']); ?>" alt="<?php echo esc_attr($subscription_poster['alt']); ?>" class="subscription-block__img">
                    <?php elseif (!empty($subscription_image)) : ?>
                        <img src="<?php echo esc_url($subscription_image['url']); ?>" alt="<?php echo esc_attr($subscription_image['alt']); ?>" class="subscription-block__img">
                    <?php endif; ?>
                    
                    <?php if (!empty($subscription_badge)) : ?>
                        <div class="subscription-block__badge">
                            <img src="<?php echo esc_url($subscription_badge['url']); ?>" alt="<?php echo esc_attr($subscription_badge['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="subscription-block__info">
                <div class="subscription-block__text">
                    <h3 class="main-title white"><?php echo esc_html($title); ?></h3>
                    <p class="main-text white"><?php echo esc_html($text); ?></p>
                </div>
    
                <div class="subscription-block__button">
                    <a href="<?php echo esc_url($button_link); ?>" class="btn btn-white" target="<?php echo esc_attr($button_target); ?>">
                        <?php echo esc_html($button_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
