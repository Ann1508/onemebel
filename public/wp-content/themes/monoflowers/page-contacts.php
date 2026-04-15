<?php
/**
 * Template name: Контакты
 * Кнопка "Записаться на консультацию" → открывает модальное окно
 */
get_header();

$phone         = get_field('phone', 'option')         ?: '+375 (29) 100 00 00';
$email         = get_field('email', 'option')         ?: 'hello@onemebel';
$address       = get_field('address', 'option')       ?: '107076, Беларусь, Минск, Колодезный пер., д. 3';
$opening_hours = get_field('opening_hours', 'option') ?: 'пн-вс: 8:00–21:00';
$map_embed     = get_field('map_embed', 'option');
$map_lat       = get_field('map_lat', 'option')       ?: '53.9045';
$map_lng       = get_field('map_lng', 'option')       ?: '27.5615';
$tg            = get_field('telegram', 'option');
$vb            = get_field('viber', 'option');
$wa            = get_field('whatsapp', 'option');

$inn           = get_field('inn', 'option')           ?: '7743163383857';
$ogrn          = get_field('ogrn', 'option')          ?: '3137746119006 01';
$account       = get_field('account', 'option')       ?: '40802810238120005696';
$bank_name     = get_field('bank_name', 'option')     ?: 'ПАО Сбербанк';
$bik           = get_field('bik', 'option')           ?: '044525225';
$kor_account   = get_field('kor_account', 'option')   ?: '30101810400000000225';
$inn2          = get_field('inn2', 'option')          ?: '7707083893';
$kpp           = get_field('kpp', 'option')           ?: '773643001';
$legal_address = get_field('legal_address', 'option') ?: 'Минск, Колодезный переулок 3';
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

<section class="contacts-page">
    <div class="container">
        <h1 class="contacts-page__title"><?php the_title(); ?></h1>

        <div class="contacts-page__inner">

            <!-- Левая колонка -->
            <div class="contacts-page__left">

                <div class="contacts-page__block">
                    <h3 class="contacts-page__block-title">Адрес</h3>
                    <p class="contacts-page__block-text"><?php echo esc_html($address); ?></p>
                </div>

                <div class="contacts-page__block">
                    <h3 class="contacts-page__block-title">Режим работы</h3>
                    <p class="contacts-page__block-text"><?php echo esc_html($opening_hours); ?></p>
                </div>

                <div class="contacts-page__block">
                    <h3 class="contacts-page__block-title">Телефон и email</h3>
                    <a href="tel:<?php echo preg_replace('/\D/', '', $phone); ?>" class="contacts-page__phone">
                        <?php echo esc_html($phone); ?>
                    </a>
                    <?php if ($email) : ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="contacts-page__email">
                        <?php echo esc_html($email); ?>
                    </a>
                    <?php endif; ?>

                    <div class="contacts-page__socials">
                        <?php if ($tg) : ?>
                        <a href="<?php echo esc_url($tg); ?>" class="contacts-page__social-link" target="_blank" aria-label="Telegram">
                            <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M32.975 7.66438L6.40082 17.8467C4.58723 18.5705 4.59772 19.5758 6.06808 20.0241L12.8907 22.1389L28.6764 12.2425C29.4228 11.7912 30.1048 12.034 29.5442 12.5284L16.7547 23.9975H16.7517L16.7547 23.999L16.2841 30.9868C16.9736 30.9868 17.2778 30.6725 17.6645 30.3017L20.9784 27.0997L27.8715 32.1589C29.1425 32.8544 30.0553 32.4969 30.3716 30.9898L34.8965 9.80003C35.3597 7.95479 34.1876 7.1193 32.975 7.66438Z" fill="#462b25"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($vb) : ?>
                        <a href="<?php echo esc_url($vb); ?>" class="contacts-page__social-link" target="_blank" aria-label="Viber">
                            <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5322 5.5C29.1679 5.5 33.0645 9.23088 33.0645 18.4482C33.0644 27.6656 29.1679 31.3965 19.5322 31.3965C18.8239 31.3965 18.2572 31.3962 17.2656 31.25L14.5732 34.3955C14.0773 34.9807 12.5889 35.2 12.5889 33.4443V30.3721C12.1637 30.3719 11.172 29.9332 9.82617 29.0557C8.48001 28.1047 6.00001 25.8367 6 18.4482C6 9.23095 9.89672 5.50006 19.5322 5.5Z" fill="#462b25"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($wa) : ?>
                        <a href="<?php echo esc_url($wa); ?>" class="contacts-page__social-link" target="_blank" aria-label="WhatsApp">
                            <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9965 6.25C12.646 6.25 6.66699 12.2307 6.66699 19.5832C6.66699 22.4991 7.60735 25.2034 9.20588 27.3983L7.54454 32.3521L12.6695 30.7142C14.7773 32.1094 17.2928 32.9167 20.0042 32.9167C27.3546 32.9167 33.3337 26.9357 33.3337 19.5835C33.3337 12.2309 27.3546 6.25022 20.0042 6.25022L19.9965 6.25Z" fill="#462b25"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="contacts-page__block contacts-page__block--requisites">
                    <h3 class="contacts-page__block-title">Реквизиты</h3>
                    <ul class="contacts-page__requisites">
                        <?php if ($inn)           : ?><li>ИНН: <?php echo esc_html($inn); ?></li><?php endif; ?>
                        <?php if ($ogrn)          : ?><li>ОГРНИП: <?php echo esc_html($ogrn); ?></li><?php endif; ?>
                        <?php if ($account)       : ?><li>Расчётный счёт: <?php echo esc_html($account); ?></li><?php endif; ?>
                        <?php if ($bank_name)     : ?><li><?php echo esc_html($bank_name); ?></li><?php endif; ?>
                        <?php if ($bik)           : ?><li>БИК: <?php echo esc_html($bik); ?></li><?php endif; ?>
                        <?php if ($kor_account)   : ?><li>Корр/с: <?php echo esc_html($kor_account); ?></li><?php endif; ?>
                        <?php if ($inn2)          : ?><li>ИНН: <?php echo esc_html($inn2); ?></li><?php endif; ?>
                        <?php if ($kpp)           : ?><li>КПП: <?php echo esc_html($kpp); ?></li><?php endif; ?>
                        <?php if ($legal_address) : ?><li><?php echo esc_html($legal_address); ?></li><?php endif; ?>
                    </ul>
                </div>

            </div>

            <!-- Правая колонка -->
            <div class="contacts-page__right">

                <div class="contacts-page__map">
                    <?php if ($map_embed) : ?>
                        <?php echo $map_embed; ?>
                    <?php else : ?>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2351.2!2d<?php echo esc_attr($map_lng); ?>!3d<?php echo esc_attr($map_lat); ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1"
                        width="100%" height="340" style="border:0; border-radius:12px;" allowfullscreen="" loading="lazy">
                    </iframe>
                    <?php endif; ?>
                </div>

                <div class="contacts-page__consult">
                    <div class="contacts-page__consult-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="40" height="40" rx="8" fill="#f5f0ec"/>
                            <path d="M14 12h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-4l-4 4v-4h-4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2z" stroke="#462b25" stroke-width="1.5" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="contacts-page__consult-content">
                        <h3 class="contacts-page__consult-title">Задать вопрос или<br>записаться на консультацию</h3>
                        <p class="contacts-page__consult-text">Поможем оценить мебель и выбрать решение</p>
                        <!-- Кнопка открывает модальное окно -->
                        <a href="#" class="contacts-page__consult-btn js-open-modal">
                            Записаться на консультацию
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>