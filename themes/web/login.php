<link rel="stylesheet" href="assets/css/login.css">

<?php $this->layout("master"); ?>

<section>
    <div id="container-login-signin">
        <div id="form">
            <p>Quero Entrar</p>
            <div class="input-container">
                <label for="email-login">Email:</label>
                <input id="email-login">
            </div>
            <div class="input-container">
                <label for="password-login">Senha:</label>
                <input type="password" id="password-login">
            </div>

            <input class="btn" type="button" value="Entrar">
        </div>

        <div id="form">
            <p>Desejo me cadastrar</p>
            <div class="input-container">
                <label for="name">Name:</label>
                <input id="name">
            </div>
            <div class="input-container">
                <label for="lastname">Sobrenome:</label>
                <input id="lastname">
            </div>
            <div class="input-container">
                <label for="email-signin">Email:</label>
                <input id="email-signin">
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