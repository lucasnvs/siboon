<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('order/order.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('order/order.css', 'admin') ?>">
<?php $this->end(); ?>

<?php
    $header = ["Cód. Pedido", "Itens", "Valor Total", "Status Pagamento", "Status Entrega", "Email do Cliente", "Data Pedido", "Ações"];
?>

<h2>Vendas</h2>
<br>
<div class="container-section">
    <div class="container-section-header">
        <p>Tabela de Pedidos</p>
    </div>
    <div class="container-section-body">
        <table id="table-orders" class="default-table">
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