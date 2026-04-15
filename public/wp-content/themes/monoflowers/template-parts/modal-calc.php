<?php
/**
 * Template part: Модальное окно "Рассчитать стоимость" (2 шага)
 * Подключается в footer.php перед <?php wp_footer(); ?>
 *
 * Шаг 1 — параметры мебели
 * Шаг 2 — контактные данные
 * При отправке — письмо владельцу через wp_mail()
 */
?>

<!-- Оверлей -->
<div class="modal-overlay" id="modal-calc-overlay"></div>

<!-- Модальное окно -->
<div class="modal-calc" id="modal-calc" role="dialog" aria-modal="true" aria-labelledby="modal-calc-title">

    <!-- Кнопка закрытия -->
    <button class="modal-calc__close" id="modal-calc-close" aria-label="Закрыть">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6L18 18" stroke="#1b1b1b" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>

    <!-- ШАГ 1 -->
    <div class="modal-calc__step" id="modal-step-1">
        <h2 class="modal-calc__title" id="modal-calc-title">Рассчитать стоимость</h2>
        <p class="modal-calc__desc">Описание в одну две строки</p>

        <div class="modal-calc__field">
            <label class="modal-calc__label">Тип мебели</label>
            <div class="modal-calc__select-wrap">
                <select class="modal-calc__select" id="mc-furniture-type" name="furniture_type">
                    <option value="">Выберите из списка</option>
                    <option value="Диван">Диван</option>
                    <option value="Кресло">Кресло</option>
                    <option value="Стул">Стул</option>
                    <option value="Кровать">Кровать</option>
                    <option value="Кухонный уголок">Кухонный уголок</option>
                </select>
                <span class="modal-calc__select-arrow">&#8964;</span>
            </div>
        </div>

        <div class="modal-calc__field">
            <label class="modal-calc__label">Размер мебели</label>
            <div class="modal-calc__select-wrap">
                <select class="modal-calc__select" id="mc-furniture-size" name="furniture_size">
                    <option value="">Выберите из списка</option>
                    <option value="Маленький (до 120 см)">Маленький (до 120 см)</option>
                    <option value="Средний (120–180 см)">Средний (120–180 см)</option>
                    <option value="Большой (от 180 см)">Большой (от 180 см)</option>
                    <option value="Угловой">Угловой</option>
                </select>
                <span class="modal-calc__select-arrow">&#8964;</span>
            </div>
        </div>

        <div class="modal-calc__field">
            <label class="modal-calc__label">Пышность мебели</label>
            <div class="modal-calc__select-wrap">
                <select class="modal-calc__select" id="mc-fluffiness" name="fluffiness">
                    <option value="">Выберите из списка</option>
                    <option value="Стандартная">Стандартная</option>
                    <option value="Мягкая">Мягкая</option>
                    <option value="Жёсткая">Жёсткая</option>
                </select>
                <span class="modal-calc__select-arrow">&#8964;</span>
            </div>
        </div>

        <div class="modal-calc__field">
            <label class="modal-calc__label">Восстановление наполнителя</label>
            <div class="modal-calc__select-wrap">
                <select class="modal-calc__select" id="mc-filler" name="filler">
                    <option value="">Выберите из списка</option>
                    <option value="Не требуется">Не требуется</option>
                    <option value="Частичное">Частичное</option>
                    <option value="Полная замена">Полная замена</option>
                </select>
                <span class="modal-calc__select-arrow">&#8964;</span>
            </div>
        </div>

        <div class="modal-calc__field">
            <label class="modal-calc__label">Тип ткани</label>
            <div class="modal-calc__checkboxes">
                <?php
                $fabrics = ['Шинил', 'Рогожка', 'Микрофибра', 'Велюр', 'Кожзам', 'Флок', 'Другая'];
                foreach ($fabrics as $fabric) :
                    $id = 'mc-fabric-' . sanitize_title($fabric);
                ?>
                <label class="modal-calc__check-label" for="<?php echo $id; ?>">
                    <input type="checkbox" id="<?php echo $id; ?>" name="fabric[]" value="<?php echo esc_attr($fabric); ?>" class="modal-calc__checkbox">
                    <span class="modal-calc__check-box"></span>
                    <?php echo esc_html($fabric); ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="modal-calc__footer">
            <span class="modal-calc__step-indicator">Шаг 1/2</span>
            <button class="modal-calc__btn-next" id="mc-next-btn">Далее</button>
        </div>
    </div>

    <!-- ШАГ 2 -->
    <div class="modal-calc__step" id="modal-step-2" style="display:none;">
        <button class="modal-calc__back" id="mc-back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="#1b1b1b" stroke-width="2" stroke-linecap="round"/></svg>
            Назад
        </button>

        <h2 class="modal-calc__title">Рассчитать стоимость</h2>
        <p class="modal-calc__desc">Описание в одну две строки</p>

        <div class="modal-calc__field">
            <input type="text" class="modal-calc__input" id="mc-city" name="city" placeholder="Населённый пункт" autocomplete="address-level2">
        </div>

        <div class="modal-calc__field-row">
            <input type="text" class="modal-calc__input" id="mc-name" name="name" placeholder="Имя" autocomplete="given-name">
            <div class="modal-calc__phone-wrap">
                <span class="modal-calc__phone-flag">🇧🇾 +375</span>
                <input type="tel" class="modal-calc__input modal-calc__input--tel" id="mc-phone" name="phone" placeholder="(29) 000 00 00" autocomplete="tel">
            </div>
        </div>

        <div class="modal-calc__field">
            <textarea class="modal-calc__input modal-calc__textarea" id="mc-comment" name="comment" placeholder="Комментарий" rows="3"></textarea>
        </div>

        <div class="modal-calc__field">
            <span class="modal-calc__label"><strong>Удобный способ связи</strong></span>
            <div class="modal-calc__checkboxes">
                <label class="modal-calc__check-label" for="mc-contact-phone">
                    <input type="checkbox" id="mc-contact-phone" name="contact_method[]" value="Телефонный звонок" class="modal-calc__checkbox" checked>
                    <span class="modal-calc__check-box"></span>
                    Телефонный звонок
                </label>
                <label class="modal-calc__check-label" for="mc-contact-messenger">
                    <input type="checkbox" id="mc-contact-messenger" name="contact_method[]" value="Мессенджеры" class="modal-calc__checkbox">
                    <span class="modal-calc__check-box"></span>
                    Мессенджеры
                </label>
            </div>
        </div>

        <div class="modal-calc__footer">
            <span class="modal-calc__step-indicator">Шаг 2/2</span>
            <button class="modal-calc__btn-submit" id="mc-submit-btn">Отправить</button>
        </div>

        <p class="modal-calc__privacy">
            Нажимая на кнопку, вы даёте согласие на обработку 
            <a href="/privacy">персональных данных</a> в соответствии с 
            <a href="/agreement">Политикой</a>
        </p>
    </div>

    <!-- УСПЕХ -->
    <div class="modal-calc__step modal-calc__success" id="modal-success" style="display:none;">
        <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="32" cy="32" r="30" stroke="#462b25" stroke-width="2"/>
            <path d="M20 32l8 8 16-16" stroke="#462b25" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <h2 class="modal-calc__title">Спасибо!</h2>
        <p class="modal-calc__desc">Ваша заявка принята. Мы свяжемся с вами в ближайшее время.</p>
        <button class="modal-calc__btn-submit" id="mc-close-success">Закрыть</button>
    </div>

</div>

<!-- Hidden nonce for AJAX -->
<input type="hidden" id="mc-nonce" value="<?php echo wp_create_nonce('modal_calc_submit'); ?>">
