</main>

<footer class="footer" id="contact">
    <div class="container">
        <div class="footer__top">

            <!-- Левая колонка: логотип + юр. info -->
            <div class="footer__top--left">
                <div class="left__info">
                    <a href="<?php echo home_url(); ?>">
                        <span style="color:#fff; font-size:32px; font-weight:700; 
                        letter-spacing:-1px;">ONEMEBEL</span>
                    </a>
                </div>
                <div class="footer__company-info">
                    <div class="company-info__details">
                        ИП ФАМИЛИЯ ИНИЦИАЛЫ<br>
                        ОГРН 3223900050127654
                    </div>
                </div>
            </div>

            <!-- Центр: меню -->
            <div class="footer__top--center">
                <div class="footer__menu">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'bottom_menu',
                        'container'      => false,
                        'items_wrap'     => '<ul>%3$s</ul>',
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </div>
            </div>

            <!-- Правая колонка: соцсети + телефон + кнопка -->
            <div class="footer__top--right">
                <div class="contact__info">

                    <!-- Иконки соцсетей -->
                    <div class="footer__socials">
                        <a href="<?php the_field('telegram', 'option'); ?>" 
                           class="footer__social-link" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 
                                10-4.48 10-10S17.52 2 12 2zm4.64 6.8l-1.7 8.02c-.12.56-.46.7-.93.43l-2.57-1.9-1.24 
                                1.19c-.14.14-.25.25-.51.25l.18-2.6 4.74-4.28c.21-.18-.04-.28-.32-.1L7.46 
                                14.37l-2.52-.79c-.55-.17-.56-.55.11-.81l9.86-3.8c.46-.17.86.11.73.83z" 
                                fill="white"/>
                            </svg>
                        </a>
                        <a href="<?php the_field('viber', 'option'); ?>" 
                           class="footer__social-link" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.37 
                                5.07L2 22l5.1-1.34C8.5 21.52 10.22 22 12 22c5.52 0 10-4.48 
                                10-10S17.52 2 12 2zm3.54 13.67c-.21.59-1.22 1.13-1.69 
                                1.19-.43.06-.98.08-1.58-.1-.36-.11-.83-.26-1.42-.51-2.49-1.08-4.11-3.6-4.24-3.77-.13-.17-1.04-1.39-1.04-2.65 
                                0-1.26.66-1.88 .9-2.13.23-.25.5-.31.67-.31h.47c.15 0 .36-.06.56.43.21.5.71 
                                1.73.77 1.86.06.13.1.28.02.45-.08.17-.12.28-.23.43l-.34.4c-.11.11-.23.23-.1.45.13.22.58.95 
                                1.24 1.54.85.76 1.57 1 1.79 1.11.22.11.35.09.48-.05.13-.15.55-.64.7-.86.15-.22.3-.18.5-.11l1.58.75c.22.11.37.16.42.25.06.09.06.52-.15 1.11z" 
                                fill="white"/>
                            </svg>
                        </a>
                        <a href="<?php the_field('whatsapp', 'option'); ?>" 
                           class="footer__social-link" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.37 
                                5.07L2 22l5.1-1.34C8.5 21.52 10.22 22 12 22c5.52 0 
                                10-4.48 10-10S17.52 2 12 2zm.13 15.37c-1.17 
                                0-2.33-.3-3.34-.87l-.24-.14-2.47.65.66-2.41-.16-.25c-.62-1.04-.95-2.24-.95-3.47 
                                0-3.72 3.03-6.75 6.75-6.75s6.75 3.03 6.75 6.75-3.03 6.75-6.75 
                                6.49zm3.7-5.05c-.2-.1-1.19-.59-1.37-.65-.18-.07-.32-.1-.45.1-.13.2-.5.65-.62.79-.11.13-.23.15-.43.05-.2-.1-.85-.31-1.62-.99-.6-.53-1-1.19-1.12-1.39-.11-.2-.01-.31.09-.41.09-.09.2-.23.3-.35.1-.12.13-.2.2-.33.07-.13.03-.25-.02-.35-.05-.1-.45-1.09-.62-1.49-.16-.39-.33-.34-.45-.34h-.38c-.13 0-.35.05-.53.25-.18.2-.7.68-.7 1.66s.71 1.93.81 2.06c.1.13 1.4 2.14 3.4 3 .47.21.84.33 1.13.42.48.15.91.13 1.25.08.38-.06 1.19-.49 1.36-.96.17-.47.17-.87.12-.96-.05-.09-.18-.13-.38-.23z" 
                                fill="white"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Телефон -->
                    <a class="contact__info-item" 
                       href="tel:<?php the_field('phone', 'option'); ?>">
                        <span><?php the_field('phone', 'option'); ?></span>
                    </a>

                    <!-- Кнопка -->
                    <a href="#" class="footer__cta js-open-modal">
                        Бесплатная консультация
                    </a>

                </div>
            </div>

        </div>

        <!-- Низ футера -->
        <div class="footer__bottom">
            <div class="copyright">
                © <?php echo date('Y'); ?> 
                <?php the_field('copyright', 'option'); ?>
            </div>
            <div class="footer__bottom--menu">
                <a href="/privacy">Политика конфиденциальности</a>
                <a href="/agreement">Согласие на обработку данных</a>
            </div>
        </div>
    </div>
</footer>

<!-- МОДАЛЬНОЕ ОКНО — подключается один раз в футере -->
<?php get_template_part('template-parts/modal-calc'); ?>

<?php wp_footer(); ?>
</body>
</html>