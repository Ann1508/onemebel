<?php
$h2_title   = get_field('service_article_title')     ?: 'Качественная перетяжка и ремонт дивана в Минске: услуги и цены';
$col1       = get_field('service_article_col1')      ?: 'Если вы ищете профессиональную перетяжку в Минске, то есть много мастеров, которые предлагают эти услуги. Но как выбрать лучшего специалиста и какие цены ожидать? Рассмотрим некоторые важные моменты, которые следует учитывать.

Первое, на что следует обратить внимание, опыт и репутация. Найдите мастера, который имеет множество положительных отзывов от клиентов, с хорошей репутацией и сроком не менее 5 лет работы в данной области. Также стоит обратить внимание на портфолио выполненных работ — это позволит оценить качество перетяжки и определить, насколько мастерская соответствует вашим требованиям. Специалисты работают только в цеху! Выполняют реставрацию различных элементов дивана: каркаса, подушек, пуфиков и декоративных подушек.';
$col2       = get_field('service_article_col2')      ?: 'Также стоит отметить, что мастера работают не только с домашними диванами, но и с мебелью в офисах. Благодаря профессионализму, они смогут быстро и качественно обновить ваш диван, будь то трехместное изделие, еврокнижка или шезлонг с набором пуфов и подушек. При этом, возможностей для трансформации и изменения формы множество, что позволяет адаптироваться к разным условиям и потребностям.

Второе, что следует учитывать, это цены на перетяжку и ремонт. Цены могут значительно варьироваться в зависимости от многих факторов, включая тип мебели (сиденье, спинка, диванчик, софа, кушетка, изголовье, раскладной аккордеон), выбранный материал обивки, сложность работы и др. Важно выбрать мастера, который предоставляет прозрачную ценовую политику и подробно обсудит все варианты и возможные расходы до начала работ.';
$art_image  = get_field('service_article_image');
$art_img_url = $art_image ? esc_url($art_image['url']) : get_template_directory_uri() . '/assets/img/service-article-default.jpg';
$art_img_alt = $art_image ? esc_attr($art_image['alt']) : '';

$h3_title   = get_field('service_article_h3')        ?: 'Заголовок H3';
$h3_text    = get_field('service_article_text_h3')   ?: 'Если вы ищете профессиональную перетяжку в Минске, то есть много мастеров, которые предлагают эти услуги. Но как выбрать лучшего специалиста и какие цены ожидать? Рассмотрим некоторые важные моменты, которые следует учитывать.';
$extra_col1 = get_field('service_article_extra_col1') ?: 'Первое, на что следует обратить внимание, опыт и репутация. Найдите мастера, который имеет множество положительных отзывов от клиентов, с хорошей репутацией и сроком не менее 5 лет работы в данной области. Также стоит обратить внимание на портфолио выполненных работ — это позволит оценить качество перетяжки и определить, насколько мастерская соответствует вашим требованиям. Специалисты работают только в цеху! Выполняют реставрацию различных элементов дивана: каркаса, подушек, пуфиков и декоративных подушек.';
$extra_col2 = get_field('service_article_extra_col2') ?: '';
?>

<section class="service-article">
    <div class="container">

        <h2 class="service-article__title"><?php echo esc_html($h2_title); ?></h2>

        <div class="service-article__columns">
            <div class="service-article__col">
                <?php
                $paragraphs = explode("\n\n", $col1);
                foreach ($paragraphs as $p) {
                    if (trim($p)) echo '<p>' . nl2br(esc_html(trim($p))) . '</p>';
                }
                ?>
            </div>
            <div class="service-article__col">
                <?php
                $paragraphs2 = explode("\n\n", $col2);
                foreach ($paragraphs2 as $p2) {
                    if (trim($p2)) echo '<p>' . nl2br(esc_html(trim($p2))) . '</p>';
                }
                ?>
            </div>
        </div>

        <div class="service-article__image-wrap">
            <img src="<?php echo $art_img_url; ?>" alt="<?php echo $art_img_alt; ?>" class="service-article__img">
        </div>

        <h3 class="service-article__h3"><?php echo esc_html($h3_title); ?></h3>

        <div class="service-article__columns service-article__columns--narrow">
            <div class="service-article__col">
                <?php
                $h3_paragraphs = explode("\n\n", $h3_text);
                foreach ($h3_paragraphs as $p3) {
                    if (trim($p3)) echo '<p>' . nl2br(esc_html(trim($p3))) . '</p>';
                }
                ?>
            </div>
            <?php if ($extra_col2) : ?>
            <div class="service-article__col">
                <?php
                $extra_paragraphs = explode("\n\n", $extra_col2);
                foreach ($extra_paragraphs as $p4) {
                    if (trim($p4)) echo '<p>' . nl2br(esc_html(trim($p4))) . '</p>';
                }
                ?>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>
