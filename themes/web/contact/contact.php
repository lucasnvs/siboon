<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('contact/contact.css') ?>">
<?php $this->end(); ?>

<div id="contact-container">
    <h1>Contato</h1>
    <p>Rua Tony Hawk, 191. Cep: 10100-100. Porto Alegre, Rio Grande do Sul.</p>
    <p>Tel.: 51991001010</p>
    <p>Email: contatosiboon@siboon.com</p>

    <h2>Fale Conosco!</h2>
    <div class="input-container">
        <label for="subject">Assunto:</label>
        <input class="default-input" id="subject">
    </div>
    <div class="input-container">
        <label for="message">Mensagem:</label>
        <textarea id="message" placeholder="Digite aqui"></textarea>
    </div>
    <button class="btn">Enviar</button>
</div>

<span id="fix-info"> // Todas as informações presentes aqui são exemplares e não existem efetivamente! </span>