<?php
/**
 * Template part: Секция "Часто задаваемые вопросы про перетяжку"
 * Подключается в home.php через: get_template_part('template-parts/faq-section');
 *
 * Вопросы из ACF Repeater 'faq_items' или заглушки.
 */

$faqs = get_field('faq_items') ?: [];

$faqs_default = [
    [
        'question' => 'Как заказать обивку мебели в Минске?',
        'answer'   => 'Для заказа перетяжки в Минске и области, достаточно позвонить по телефону +375292187000, либо заказать бесплатный звонок консультанта вписав свои контактные данные в форму обратной связи.',
    ],
    ['question' => 'Как заказать обивку мебели в Минске?', 'answer' => ''],
    ['question' => 'Как заказать обивку мебели в Минске?', 'answer' => ''],
    ['question' => 'Как заказать обивку мебели в Минске?', 'answer' => ''],
    ['question' => 'Как заказать обивку мебели в Минске?', 'answer' => ''],
    ['question' => 'Как заказать обивку мебели в Минске?', 'answer' => ''],
    ['question' => 'Как заказать обивку мебели в Минске?', 'answer' => ''],
];

$faqs_list = !empty($faqs) ? $faqs : $faqs_default;
?>

<section class="faq">
    <div class="container">
        <h2 class="faq__title">Часто задаваемые вопросы<br>про перетяжку</h2>

        <div class="faq__list">
            <?php foreach ($faqs_list as $index => $item) :
                $question = is_array($item) ? esc_html($item['question'] ?? '') : esc_html($item);
                $answer   = is_array($item) ? wp_kses_post($item['answer'] ?? '') : '';
                $is_open  = ($index === 0 && $answer);
            ?>
            <div class="faq__item <?php echo $is_open ? 'faq__item--open' : ''; ?>">
                <button class="faq__question" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
                    <span class="faq__question-text"><?php echo $question; ?></span>
                    <span class="faq__toggle">
                        <?php if ($is_open) : ?>
                        <span class="faq__toggle-minus">−</span>
                        <?php else : ?>
                        <span class="faq__toggle-plus">+</span>
                        <?php endif; ?>
                    </span>
                </button>
                <?php if ($answer) : ?>
                <div class="faq__answer" <?php echo !$is_open ? 'hidden' : ''; ?>>
                    <p class="faq__answer-text"><?php echo $answer; ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
(function() {
    document.querySelectorAll('.faq__question').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var item   = this.closest('.faq__item');
            var answer = item.querySelector('.faq__answer');
            var isOpen = item.classList.contains('faq__item--open');

            // Закрываем все
            document.querySelectorAll('.faq__item').forEach(function(i) {
                i.classList.remove('faq__item--open');
                var a = i.querySelector('.faq__answer');
                if (a) a.hidden = true;
                var btn2 = i.querySelector('.faq__question');
                btn2.setAttribute('aria-expanded', 'false');
                var minus = i.querySelector('.faq__toggle-minus');
                var plus  = i.querySelector('.faq__toggle-plus');
                if (minus) minus.textContent = '+';
                if (minus) minus.className = 'faq__toggle-plus';
            });

            // Открываем текущий если был закрыт
            if (!isOpen && answer) {
                item.classList.add('faq__item--open');
                answer.hidden = false;
                this.setAttribute('aria-expanded', 'true');
                var toggle = this.querySelector('.faq__toggle-plus, .faq__toggle-minus');
                if (toggle) { toggle.textContent = '−'; toggle.className = 'faq__toggle-minus'; }
            }
        });
    });
})();
</script>