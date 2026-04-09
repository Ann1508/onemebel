<?php
/**
 * Template part for displaying Shop Categories section
 */


// Get selected categories from ACF field
$selected_categories = get_field('categories');

// If categories are selected in ACF, use them
if (!empty($selected_categories)) {
    $product_categories = array();
    
    // If ACF returns term IDs
    if (is_array($selected_categories)) {
        foreach ($selected_categories as $term_id) {
            $term = get_term($term_id, 'product_cat');
            if ($term && !is_wp_error($term)) {
                $product_categories[] = $term;
            }
        }
    }
} else {
    // Fallback: Get all product categories if none selected
    $args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'name',
        'orderby'    => 'term_order',
        'order'      => 'ASC',
        'hide_empty' => true,
        'parent'     => 0, // Only top-level categories
    );
    
    $product_categories = get_terms($args);
}

if (!empty($product_categories) && !is_wp_error($product_categories)) : ?>
    <section class="shop-categories">
        <div class="container">
            <div class="shop-categories__grid">
                <?php foreach ($product_categories as $category) :
                    // Skip Uncategorized category
                    if ($category->slug === 'uncategorized') {
                        continue;
                    }
                    
                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
                    $category_link = get_term_link($category);
                    ?>
                    
                    <a href="<?php echo esc_url($category_link); ?>" class="category-card">
                        <div class="category-card__image">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" class="category-card__img">
                            <div class="category-card__overlay"></div>
                        </div>
                        
                        <div class="category-card__content">
                            <h3 class="category-card__name"><?php echo esc_html($category->name); ?></h3>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
