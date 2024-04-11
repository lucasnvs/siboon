<link rel="stylesheet" href="assets/css/login.css">

<?php $this->layout("master"); ?>

<section>
    <h1>Contato</h1>
    <p>Rua Tony Hawk, 191. Cep: 10100-100. Porto Alegre, Rio Grande do Sul.</p>
    <p>Tel.: 51991001010</p>

    <div class="input-container">
        <label for="subject">Assunto:</label>
        <input id="subject">
    </div>
    <div class="input-container">
        <label for="message">Mensagem:</label>
        <textarea id="message" placeholder="Digite aqui" rows="4" cols="30"></textarea>
    </div>
    <br>
    <button class="btn">Enviar</button>
</section>
