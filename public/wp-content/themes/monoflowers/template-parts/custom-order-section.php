<?php
/**
 * Template part for displaying Custom Order section
 */


// Get ACF fields
$custom_order_title = get_field('custom_order_title');
$custom_order_description = get_field('custom_order_description');
$custom_order_button = get_field('custom_order_button');
$custom_order_background = get_field('custom_order_background');
?>

<section class="custom-order-section">
    <div class="custom-order-section__bg-wrapper">
        <?php if( $custom_order_background ): ?>
        <img src="<?php echo esc_url($custom_order_background['url']); ?>" 
             alt="<?php echo esc_attr($custom_order_background['alt']); ?>" 
             class="custom-order-section__bg-image">
        <?php endif; ?>
        <div class="custom-order-section__overlay"></div>
    </div>
    
    <div class="container">
        <div class="custom-order-section__content">
            <?php if( $custom_order_title ): ?>
            <h2 class="main-title white"><?php echo esc_html($custom_order_title); ?></h2>
            <?php endif; ?>
            
            <?php if( $custom_order_description ): ?>
            <p class="main-text white"><?php echo esc_html($custom_order_description); ?></p>
            <?php endif; ?>
            
            <?php if( $custom_order_button ): 
                $button_url = $custom_order_button['url'];
                $button_title = $custom_order_button['title'];
                $button_target = $custom_order_button['target'] ? $custom_order_button['target'] : '_self';
            ?>
            <a href="<?php echo esc_url($button_url); ?>" 
               target="<?php echo esc_attr($button_target); ?>" 
               class="btn">
                <?php echo esc_html($button_title); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>
