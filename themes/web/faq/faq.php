<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-script"); ?>
    <script type="module" src="<?= assets('faq/scripts-faqs.js') ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('faq/faq.css') ?>">
<?php $this->end(); ?>
