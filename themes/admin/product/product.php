<?php $this->layout("master"); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('product/product.css', 'admin') ?>">
    <link rel="stylesheet" href="<?= assets('components/table/table.css', 'shared') ?>">
<?php $this->end(); ?>

<?php
    $data = ["", "", "", "", ""];
    $header = ["Cód. Item", "Produto", "Valor", "Qtd. Estoque"];
?>

<div class="big-options-container">
    <a href="<?= url("admin/produtos/registrar") ?>"><button class="big-button">Novo Produto</button></a>
</div>

<div class="container-section">
    <div class="container-section-header">
        <p>Tabela de Produtos</p>
    </div>
    <div class="container-section-body">
        <?= $this->insert("shared::components/table/table", ["header" => $header, "data" => $data]) ?>
    </div>
</div>