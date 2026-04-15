<?php
$callback_image   = get_field('team_callback_image');
$callback_img_url = $callback_image
    ? esc_url($callback_image['url'])
    : get_template_directory_uri() . '/assets/img/callback-sofa.jpg';

$phone = get_field('phone', 'option') ?: '+375 29 776 33 33';
$tg    = get_field('telegram', 'option');
$vb    = get_field('viber', 'option');
$wa    = get_field('whatsapp', 'option');
?>

<section class="team-callback">
    <div class="container">
        <div class="team-callback__inner">

            <div class="team-callback__left" style="background-image: url('<?php echo $callback_img_url; ?>')">
                <div class="team-callback__left-overlay">

                    <h2 class="team-callback__title">Закажи обратный<br>звонок</h2>

                    <div class="team-callback__contacts">
                        <p class="team-callback__contacts-text">
                            Или свяжитесь с нами по телефону<br>и через мессенджеры
                        </p>
                        <div class="team-callback__contacts-row">
                            <a href="tel:<?php echo preg_replace('/\D/', '', $phone); ?>"
                               class="team-callback__phone">
                                <?php echo esc_html($phone); ?>
                            </a>
                            <div class="team-callback__socials">
                                <?php if ($tg) : ?>
                                <a href="<?php echo esc_url($tg); ?>" class="team-callback__social-link" target="_blank" aria-label="Telegram">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M32.975 7.66438L6.40082 17.8467C4.58723 18.5705 4.59772 19.5758 6.06808 20.0241L12.8907 22.1389L28.6764 12.2425C29.4228 11.7912 30.1048 12.034 29.5442 12.5284L16.7547 23.9975H16.7517L16.7547 23.999L16.2841 30.9868C16.9736 30.9868 17.2778 30.6725 17.6645 30.3017L20.9784 27.0997L27.8715 32.1589C29.1425 32.8544 30.0553 32.4969 30.3716 30.9898L34.8965 9.80003C35.3597 7.95479 34.1876 7.1193 32.975 7.66438Z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                <?php if ($vb) : ?>
                                <a href="<?php echo esc_url($vb); ?>" class="team-callback__social-link" target="_blank" aria-label="Viber">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.5322 5.5C29.1679 5.5 33.0645 9.23088 33.0645 18.4482C33.0644 27.6656 29.1679 31.3965 19.5322 31.3965C18.8239 31.3965 18.2572 31.3962 17.2656 31.25L14.5732 34.3955C14.0773 34.9807 12.5889 35.2 12.5889 33.4443V30.3721C12.1637 30.3719 11.172 29.9332 9.82617 29.0557C8.48001 28.1047 6.00001 25.8367 6 18.4482C6 9.23095 9.89672 5.50006 19.5322 5.5Z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                <?php if ($wa) : ?>
                                <a href="<?php echo esc_url($wa); ?>" class="team-callback__social-link" target="_blank" aria-label="WhatsApp">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9965 6.25C12.646 6.25 6.66699 12.2307 6.66699 19.5832C6.66699 22.4991 7.60735 25.2034 9.20588 27.3983L7.54454 32.3521L12.6695 30.7142C14.7773 32.1094 17.2928 32.9167 20.0042 32.9167C27.3546 32.9167 33.3337 26.9357 33.3337 19.5835C33.3337 12.2309 27.3546 6.25022 20.0042 6.25022L19.9965 6.25Z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="team-callback__right">

                <div class="team-callback__form-header">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="8" fill="#f5f0ec"/>
                        <path d="M14 12h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-4l-4 4v-4h-4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2z" stroke="#462b25" stroke-width="1.5" stroke-linejoin="round"/>
                    </svg>
                    <p class="team-callback__form-desc">
                        Мы перезвоним в ближайшее время и подробно проконсультируем по всем вашим вопросам
                    </p>
                </div>

                <form class="team-callback__form" method="post" action="">
                    <?php wp_nonce_field('team_callback', 'team_callback_nonce'); ?>

                    <input
                        type="text"
                        class="team-callback__input"
                        placeholder="Населённый пункт"
                        name="city"
                        autocomplete="address-level2"
                    >

                    <div class="team-callback__form-row">
                        <input
                            type="text"
                            class="team-callback__input"
                            placeholder="Имя"
                            name="name"
                            autocomplete="given-name"
                        >
                        <div class="team-callback__phone-field">
                            <span class="team-callback__phone-flag">🇧🇾 +375</span>
                            <input
                                type="tel"
                                class="team-callback__input team-callback__input--tel"
                                placeholder="(00) 000 00 00"
                                name="phone"
                                autocomplete="tel"
                            >
                        </div>
                    </div>

                    <div class="team-callback__form-contact">
                        <span class="team-callback__form-label">Удобный способ связи</span>
                        <div class="team-callback__form-checkboxes">
                            <label class="team-callback__checkbox">
                                <input type="checkbox" name="contact[]" value="phone" checked>
                                <span class="team-callback__checkbox-box"></span>
                                Телефонный звонок
                            </label>
                            <label class="team-callback__checkbox">
                                <input type="checkbox" name="contact[]" value="messenger">
                                <span class="team-callback__checkbox-box"></span>
                                Мессенджеры
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="team-callback__submit">
                        Рассчитать стоимость
                    </button>
                </form>

            </div>

        </div>
    </div>
</section>
