<?php $this->layout("master", ['title' => $title, 'faqs' => $faqs]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('faq/faq.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <script src="<?= assets('faq/scripts-faqs.js') ?>" async></script>
<?php $this->end(); ?>

<?php foreach ($faqs as $categoryName => $items): ?>
        <div class='faq-type'>
            <h2><?= $categoryName ?></h2>
            <?php foreach ($items as $item): ?>
                <div class='faq-item'>
                    <h3><?= $item->question ?></h3>
                    <p><?= $item->answer ?></p>
                </div>
            <?php endforeach ?>
        </div>
<?php endforeach ?>
