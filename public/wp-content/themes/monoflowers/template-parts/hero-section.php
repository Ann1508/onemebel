<section class="hero">
    <div class="container">
        <?php if( have_rows('hero_slides') ): ?>
        <div class="hero-swiper swiper">
            <div class="swiper-wrapper">
                <?php while( have_rows('hero_slides') ): the_row(); 
                    $slide_background = get_sub_field('slide_background_image');
                    $slide_title      = get_sub_field('slide_title');
                    $slide_button_text = get_sub_field('slide_button_text');
                    $slide_button_link = get_sub_field('slide_button_link');
                ?>
                <div class="swiper-slide hero__slide">
                    <?php if( $slide_background ): ?>
                    <div class="hero__slide-bg" style="background-image: url('<?php echo esc_url($slide_background['url']); ?>');"></div>
                    <?php endif; ?>

                    <!-- Контент слайда -->
                    <div class="hero__content">
                        <?php if( $slide_title ): ?>
                        <h1 class="hero__title"><?php echo esc_html($slide_title); ?></h1>
                        <?php else: ?>
                        <h1 class="hero__title"><?php the_title(); ?></h1>
                        <?php endif; ?>

                        <a href="<?php echo $slide_button_link ? esc_url($slide_button_link) : '#modal-calc'; ?>" 
                           class="hero__button <?php echo !$slide_button_link ? 'js-open-modal' : ''; ?>">
                            <?php echo $slide_button_text ? esc_html($slide_button_text) : 'Рассчитать стоимость'; ?>
                        </a>
                    </div>

                    <?php 
                    $chair_image = get_sub_field('slide_chair_image');
                    if ($chair_image): ?>
                    <div class="hero__chair-image">
                        <img src="<?php echo esc_url($chair_image['url']); ?>" alt="Кресло">
                    </div>
                    <?php endif; ?>

                </div>
                <?php endwhile; ?>
            </div>
            
            <div class="hero-pagination swiper-pagination"></div>
                <!-- Блок преимуществ внизу hero -->
                <div class="hero__advantages">
                    <div class="container">
                        <div class="hero__advantages-grid">
                            <?php
                            $advantages = [
                                [
                                    'label' => 'Производство:',
                                    'text'  => 'Собственная мастерская, опытные мастера'
                                ],
                                [
                                    'label' => 'Материалы:',
                                    'text'  => 'Износостойкие ткани и наполнители премиум-класса'
                                ],
                                [
                                    'label' => 'Сервис:',
                                    'text'  => 'Бережный вывоз, перетяжка и доставка под ключ'
                                ],
                            ];
                            foreach ($advantages as $adv): ?>
                            <div class="hero__advantage-item">
                                <span class="hero__advantage-label"><?php echo esc_html($adv['label']); ?></span>
                                <span class="hero__advantage-text"><?php echo esc_html($adv['text']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
        </div>
        <?php else: ?>
        <!-- Fallback если нет ACF слайдов -->
        <div class="hero__slide">
            <div class="hero__slide-bg"></div>
            <div class="hero__content">
                <h1 class="hero__title"><?php the_title(); ?></h1>
                <a href="#modal-calc" class="hero__button js-open-modal">Рассчитать стоимость</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
