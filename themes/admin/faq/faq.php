<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('faq/faq.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('faq/faq.css', 'admin') ?>">
<?php $this->end(); ?>

<h2>Perguntas Frequentes</h2>