<?php $this->layout("../web/master", ['title' => $title, 'user' => $user, 'isLogged' => $isLogged]); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('profile/profile.js', "app") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('profile/profile.css', "app") ?>">
<?php $this->end(); ?>


<div class="col">
    <div class="info-card">
        <header>
            <h2>Meu Perfil</h2>
            <i class="material-symbols-outlined">expand_circle_down</i>
        </header>
        <div class="content">
            <p><?= $user->first_name." ".$user->last_name?></p>
            <p><?= $user->email ?></p>
        </div>
    </div>

    <div class="info-card">
        <header>
            <h2>Gerais</h2>
            <i class="material-symbols-outlined">expand_circle_down</i>
        </header>
        <div class="content">
        </div>
    </div>

</div>

<div class="col big">
    <div class="info-card">
        <header>
            <h2>Pedidos</h2>
            <i class="material-symbols-outlined">expand_circle_down</i>
        </header>
        <div class="content">
            <div>
                <h2>Pedido X</h2>
                <p>Situação: Em andamento.</p>
            </div>
        </div>
    </div>
</div>