<?php
/**
 * Template part for displaying We Recommend section
 */


// Get recommended products
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 8,
    'orderby' => 'rand',
    'meta_query' => array(
        array(
            'key' => '_stock_status',
            'value' => 'instock',
        ),
    ),
);

// You can also filter by featured products or custom meta field for recommended products
// Uncomment this if you want to show only featured products:
// $args['tax_query'] = array(
//     array(
//         'taxonomy' => 'product_visibility',
//         'field'    => 'name',
//         'terms'    => 'featured',
//     ),
// );

$recommended_products = new WP_Query($args);

if ($recommended_products->have_posts()): ?>
    <section class="we-recommend">
        <div class="container">
            <div class="we-recommend__header">
                <h2 class="main-title">
                    ТЕКСТ
                </h2>
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="we-recommend__link">
                    ТЕКСТ
                </a>
            </div>

            <div class="we-recommend__grid">
                <?php while ($recommended_products->have_posts()):
                    $recommended_products->the_post();
                    global $product; ?>
                    <div class="we-recommend__item">
                        <div class="product-card">
                            <a href="<?php the_permalink(); ?>" class="product-card__image">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium', array('class' => 'product-card__img')); ?>
                                <?php else: ?>
                                    <img src="<?php echo wc_placeholder_img_src(); ?>" alt="<?php the_title(); ?>"
                                        class="product-card__img">
                                <?php endif; ?>

                                <!-- Favorite icon -->
                                <button class="product-card__favorite" data-product-id="<?php echo get_the_ID(); ?>"
                                    title="ТЕКСТ">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.8382 4.60987C20.3274 4.09888 19.721 3.69352 19.0535 3.41696C18.3861 3.14039 17.6707 2.99805 16.9482 2.99805C16.2257 2.99805 15.5103 3.14039 14.8428 3.41696C14.1754 3.69352 13.5689 4.09888 13.0582 4.60987L11.9982 5.66987L10.9382 4.60987C9.90647 3.57818 8.5072 2.99858 7.04817 2.99858C5.58913 2.99858 4.18986 3.57818 3.15817 4.60987C2.12647 5.64156 1.54688 7.04084 1.54688 8.49987C1.54687 9.95891 2.12647 11.3582 3.15817 12.3899L4.21817 13.4499L11.9982 21.2299L19.7782 13.4499L20.8382 12.3899C21.3492 11.8791 21.7545 11.2727 22.0311 10.6052C22.3076 9.93777 22.45 9.22236 22.45 8.49987C22.45 7.77738 22.3076 7.06198 22.0311 6.39452C21.7545 5.72706 21.3492 5.12063 20.8382 4.60987Z"
                                            stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </button>
                            </a>

                            <div class="product-card__content">
                                <h3 class="product-card__name">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="product-card__price">
                                    <?php echo $product->get_price_html(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif;

wp_reset_postdata();
?>