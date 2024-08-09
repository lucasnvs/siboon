<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('config/config.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('config/config.css', 'admin') ?>">
<?php $this->end(); ?>

<h2>Configurações Gerais</h2>