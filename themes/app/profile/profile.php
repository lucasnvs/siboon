<?php $this->layout("../web/master", ['title' => $title]); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('profile/profile.js', "app") ?>" type="module"></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('profile/profile.css', "app") ?>">
<?php $this->end(); ?>


<div class="option-header">
    <?php if($loggedUser->role == "ADMIN"): ?>
    <a href="<?= url("admin")?>">
        <button class="btn">
            <i class="material-symbols-outlined">admin_panel_settings</i>
            <span>Painel Admin</span>
        </button>
    </a>
    <?php endif; ?>
    <button id="logout" class="btn">
        <i class="material-symbols-outlined">logout</i>
        <span>Sair</span>
    </button>
</div>
<div class="container">
    <div id="col-1" class="col">
<!--        <div class="info-section">-->
<!--            <header>-->
<!--                <h2>Meu Perfil</h2>-->
<!--                <i class="material-symbols-outlined">expand_circle_down</i>-->
<!--            </header>-->
<!--            <div class="content">-->
<!--                <p>--><?php //= $user->first_name." ".$user->last_name?><!--</p>-->
<!--                <p>--><?php //= $user->email ?><!--</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>

    <div id="col-big" class="col big"></div>
</div>