<?php

$reviews_query = new WP_Query([
    'post_type'      => 'review',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

$has_reviews = $reviews_query->have_posts();

$reviews_placeholder = [
    ['name' => 'Елена', 'stars' => 5, 'text' => 'Наша команда помогает клиентам принимать мудрые решения и избегать ошибок. Позвольте нашим специалистам сделать мебель вашей мечты реальностью. Мы сможем предоставить недорогую альтернативу и отличный сервис.'],
    ['name' => 'Елена', 'stars' => 5, 'text' => 'Наша команда помогает клиентам принимать мудрые решения и избегать ошибок. Позвольте нашим специалистам сделать мебель вашей мечты реальностью. Мы сможем предоставить недорогую альтернативу и отличный сервис.'],
    ['name' => 'Елена', 'stars' => 5, 'text' => 'Наша команда помогает клиентам принимать мудрые решения и избегать ошибок. Позвольте нашим специалистам сделать мебель вашей мечты реальностью. Мы сможем предоставить недорогую альтернативу и отличный сервис.'],
    ['name' => 'Елена', 'stars' => 5, 'text' => 'Наша команда помогает клиентам принимать мудрые решения и избегать ошибок. Позвольте нашим специалистам сделать мебель вашей мечты реальностью. Мы сможем предоставить недорогую альтернативу и отличный сервис.'],
];
?>

<section class="reviews">
    <div class="container">
        <h2 class="reviews__title">Отзывы</h2>

        <div class="reviews__grid">
            <?php if ($has_reviews) :
                while ($reviews_query->have_posts()) : $reviews_query->the_post();
                    $stars   = (int) get_post_meta(get_the_ID(), 'review_stars', true) ?: 5;
                    $avatar  = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    $before_link = get_post_meta(get_the_ID(), 'review_before_link', true);
            ?>
            <div class="review-card">
                <div class="review-card__top">
                    <div class="review-card__avatar">
                        <?php if ($avatar) : ?>
                            <img src="<?php echo esc_url($avatar); ?>" alt="<?php the_title(); ?>" class="review-card__avatar-img">
                        <?php else : ?>
                            <div class="review-card__avatar-placeholder"></div>
                        <?php endif; ?>
                    </div>
                    <div class="review-card__meta">
                        <span class="review-card__name"><?php the_title(); ?></span>
                        <div class="review-card__stars">
                            <?php for ($s = 0; $s < $stars; $s++) : ?>
                            <span class="review-card__star">★</span>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <p class="review-card__text"><?php the_content(); ?></p>
                <?php if ($before_link) : ?>
                <a href="<?php echo esc_url($before_link); ?>" class="review-card__before">До перетяжки</a>
                <?php endif; ?>
            </div>
            <?php endwhile; wp_reset_postdata();
            else :
                foreach ($reviews_placeholder as $r) :
            ?>
            <div class="review-card">
                <div class="review-card__top">
                    <div class="review-card__avatar">
                        <div class="review-card__avatar-placeholder"></div>
                    </div>
                    <div class="review-card__meta">
                        <span class="review-card__name"><?php echo esc_html($r['name']); ?></span>
                        <div class="review-card__stars">
                            <?php for ($s = 0; $s < $r['stars']; $s++) : ?>
                            <span class="review-card__star">★</span>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <p class="review-card__text"><?php echo esc_html($r['text']); ?></p>
                <a href="#" class="review-card__before">До перетяжки</a>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>