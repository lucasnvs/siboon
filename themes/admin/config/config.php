<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('config/config.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('config/config.css', 'admin') ?>">
<?php $this->end(); ?>

<h2>Configurações Gerais</h2>
<br>
<div class="container-section">
    <div class="container-section-header">
        <p>Dados Institucionais</p>
    </div>
    <div class="container-section-body">
        <form id="info-form">
            <div class="row" style="gap: 20px">
                <div class="input-container" style="max-width: 600px">
                    <label for="company-name">Nome da Empresa:</label>
                    <input class="default-input" type="text" id="company-name" name="company-name">
                </div>
                <div class="input-container" style="max-width: 300px">
                    <label for="company-cnpj">CNPJ:</label>
                    <input class="default-input" type="text" id="company-cnpj" name="company-cnpj">
                </div>
            </div>
            <br>
            <div class="row" style="gap: 20px">
                <div class="input-container">
                    <label for="company-street">Rua:</label>
                    <input class="default-input" type="text" id="company-street" name="company-street">
                </div>
                <div class="input-container">
                    <label for="company-number">Número</label>
                    <input class="default-input" type="text" id="company-number" name="company-number">
                </div>
                <div class="input-container">
                    <label for="company-cep">CEP:</label>
                    <input class="default-input" type="text" id="company-cep" name="company-cep">
                </div>
                <div class="input-container">
                    <label for="company-city">Cidade:</label>
                    <input class="default-input" type="text" id="company-city" name="company-city">
                </div>
                <div class="input-container">
                    <label for="company-state">Estado:</label>
                    <input class="default-input" type="text" id="company-state" name="company-state">
                </div>
            </div>
            <br>
            <input type="submit" class="btn green" style="display: flex;align-self: flex-end" value="Salvar">
        </form>
    </div>
</div>