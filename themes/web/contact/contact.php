<?php $this->layout("master", ['title' => $title]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('contact/contact.css') ?>">
<?php $this->end(); ?>

<section class="contact-section">
    <h1>Contato</h1>

    <div class="contact-info">
        <p>Rua Tony Hawk, 191</p>
        <p>CEP: 10100-100 - Porto Alegre, Rio Grande do Sul</p>
        <p>Tel.: (51) 99100-1010</p>
        <p>Email: contatosiboon@siboon.com</p>
    </div>

    <h2>Fale Conosco!</h2>

    <form class="contact-form">
        <div class="input-container">
            <label for="subject">Assunto:</label>
            <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="default-input"
                    required
                    placeholder="Digite o assunto"
            >
        </div>

        <div class="input-container">
            <label for="message">Mensagem:</label>
            <textarea
                    id="message"
                    name="message"
                    class="message-input"
                    required
                    placeholder="Digite aqui sua mensagem"
            ></textarea>
        </div>

        <button type="submit" class="send-btn">Enviar Mensagem</button>
    </form>

    <p class="disclaimer">
        * Todas as informações presentes aqui são exemplares e não existem efetivamente!
    </p>
</section>