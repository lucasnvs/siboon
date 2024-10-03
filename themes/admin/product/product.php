<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('product/product.js', "admin") ?>"></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('product/product.css', 'admin') ?>">
<?php $this->end(); ?>

<?php
    $header = ["Cód. Item", "Produto", "Valor", "Qtd. Estoque", "Ações"];
?>

<div class="big-options-container">
    <a href="<?= url("admin/produtos/registrar") ?>"><button class="btn green">Novo Produto</button></a>
</div>

<div class="container-section">
    <div class="container-section-header">
        <p>Tabela de Produtos</p>
    </div>
    <div class="container-section-body">
        <table id="table-products" class="default-table">
            <thead>
            <?php foreach ($header as $th): ?>
                <th> <?= $th ?> </th>
            <?php endforeach; ?>
            </thead>
            <tbody>
                <td>Nenhum dado encontrado.</td>
            </tbody>
        </table>
    </div>
</div>