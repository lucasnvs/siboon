<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('login/login.css') ?>">
<?php $this->end(); ?>
<?php $this->start("specific-script"); ?>
<script src="<?= assets('login/login.js') ?>" type="module" async></script>
<?php $this->end(); ?>

<section>
    <div id="container-login-signin">
        <div id="login" class="form">
            <p>Quero Entrar</p>
            <div class="input-container">
                <label for="email-login">Email:</label>
                <input class="default-input" type="text" name="email" id="email-login">
                <span class="input-error"></span>
            </div>
            <div class="input-container">
                <label for="password-login">Senha:</label>
                <input class="default-input" type="password" name="password" id="password-login">
                <span class="input-error"></span>
            </div>
            <a>Esqueci minha senha</a>
            <button id="submit-login" class="btn">Entrar</button>
            <span id="login-error-message"></span>
        </div>

        <div id="signup" class="form">
            <p>Desejo me cadastrar</p>
            <div class="input-container">
                <label for="name">Name:</label>
                <input class="default-input" type="text" name="first_name" id="name-signup">
                <span class="input-error"></span>
            </div>
            <div class="input-container">
                <label for="lastname">Sobrenome:</label>
                <input class="default-input" type="text" name="last_name" id="lastname-signup">
                <span class="input-error"></span>
            </div>
            <div class="input-container">
                <label for="email-signin">Email:</label>
                <input class="default-input" type="text" name="email" id="email-signup">
                <span class="input-error"></span>
            </div>
            <div class="input-container">
                <label for="password-signin">Senha:</label>
                <input class="default-input" type="password" name="password" id="password-signup">
                <span class="input-error"></span>
            </div>
            <div class="input-container">
                <label for="password-confirm">Confirme a senha:</label>
                <input class="default-input" type="password" name="confirm_password" id="password-confirm-signup">
                <span class="input-error"></span>
            </div>
            <button class="btn" id="submit-signup">Cadastrar</button>
        </div>

    </div>
</section>