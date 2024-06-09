<?php $this->layout("master", ['title' => $title]); ?>

<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('web', 'css/profile.css') ?>">
<?php $this->end(); ?>


<div class="info-card">
    <h2>Meu Perfil</h2>
    <div class="content">
    </div>
</div>

<div class="info-card">
    <h2>Pedidos</h2>
    <div class="content">
    </div>
</div>