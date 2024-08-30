<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('faq/faq.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('faq/faq.css', 'admin') ?>">
<?php $this->end(); ?>

<?php
$header = ["Cód. FAQ", "Tipo", "Questão", "Resposta", "Ações"];
?>

<h2>Perguntas Frequentes</h2>
<br>
<div class="container-section">
    <div class="container-section-header">
        <p>Adicionar FAQ</p>
    </div>
    <div class="container-section-body">
        <div class="col" style="gap: 20px">
            <div class="input-container">
                <label for="faq-question">Pergunta:</label>
                <input class="default-input" type="text" id="faq-question">
            </div>
            <div class="input-container">
                <label for="faq-answer">Resposta:</label>
                <input class="default-input" type="text" id="faq-answer">
            </div>
        </div>
        <br>
        <button class="btn green" style="display: flex;align-self: flex-end">Salvar Informações</button>
    </div>
</div>
<br>
<div class="container-section">
    <div class="container-section-header">
        <p>Cadastradas</p>
    </div>
    <div class="container-section-body">
        <table id="table-faq" class="default-table">
            <thead>
            <?php foreach ($header as $th): ?>
                <th> <?= $th ?> </th>
            <?php endforeach; ?>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>