<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('web', 'css/login.css') ?>">
<?php $this->end(); ?>

<section>
    <div id="container-login-signin">
        <div id="form">
            <p>Quero Entrar</p>
            <div class="input-container">
                <label for="email-login">Email:</label>
                <input type="text" id="email-login">
            </div>
            <div class="input-container">
                <label for="password-login">Senha:</label>
                <input type="password" id="password-login">
            </div>
            <a>Esqueci minha senha</a>
            <input class="btn" type="button" value="Entrar">
        </div>

        <div id="form">
            <p>Desejo me cadastrar</p>
            <div class="input-container">
                <label for="name">Name:</label>
                <input type="text" id="name">
            </div>
            <div class="input-container">
                <label for="lastname">Sobrenome:</label>
                <input type="text" id="lastname">
            </div>
            <div class="input-container">
                <label for="email-signin">Email:</label>
                <input type="text" id="email-signin">
            </div>
            <div class="input-container">
                <label for="password-signin">Senha:</label>
                <input type="password" id="password-signin">
            </div>
            <div class="input-container">
                <label for="password-confirm">Confirme a senha:</label>
                <input type="password" id="password-confirm">
            </div>
            <input class="btn" type="button" value="Entrar">
        </div>

    </div>
</section>