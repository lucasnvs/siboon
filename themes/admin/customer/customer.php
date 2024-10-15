<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('customer/customer.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('customer/customer.css', 'admin') ?>">
<?php $this->end(); ?>

<?php
$header = ["Cód. Cliente", "Nome", "Email", "Total de Pedidos", "Ações"];
?>

<div class="container-section">
    <div class="container-section-header">
        <p>Tabela de Clientes</p>
    </div>
    <div class="container-section-body">
        <table id="table-customers" class="default-table">
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
