<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('website/website.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('website/website.css', 'admin') ?>">
<?php $this->end(); ?>

<h2>Aqui você pode gerenciar suas informações do site.</h2>