<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('login/login.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('login/login.js') ?>" type="module" async></script>
<?php $this->end(); ?>

<section>
    <div id="container-login-signin">
        <form id="login" class="form" name="login" data-action="<?= api('usuarios/login') ?>" method="post">
            <p>Quero Entrar</p>
            <div class="input-container">
                <label for="email-login">Email:</label>
                <input class="default-input" type="text" name="email" id="email-login">
            </div>
            <div class="input-container">
                <label for="password-login">Senha:</label>
                <input class="default-input" type="password" name="password" id="password-login">
            </div>
            <a>Esqueci minha senha</a>
            <input class="btn" type="submit" value="Entrar">
            <span id="login-error-message"></span>
        </form>

        <form id="signup" data-action="<?= api('usuarios')?>" class="form" method="post">
            <p>Desejo me cadastrar</p>
            <div class="input-container">
                <label for="name">Name:</label>
                <input class="default-input" type="text" name="first_name" id="name">
            </div>
            <div class="input-container">
                <label for="lastname">Sobrenome:</label>
                <input class="default-input" type="text" name="last_name" id="lastname">
            </div>
            <div class="input-container">
                <label for="email-signin">Email:</label>
                <input class="default-input" type="text" name="email" id="email-signin">
            </div>
            <div class="input-container">
                <label for="password-signin">Senha:</label>
                <input class="default-input" type="password" name="password" id="password-signin">
            </div>
            <div class="input-container">
                <label for="password-confirm">Confirme a senha:</label>
                <input class="default-input" type="password" name="confirm_password" id="password-confirm">
            </div>
            <input class="btn" type="submit" value="Entrar">
        </form>

    </div>
</section>