<?php $this->layout("master", ["title" => $title, "clients" => $clients]); ?>
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
        <table class="default-table">
            <thead>
            <?php foreach ($header as $th): ?>
                <th> <?= $th ?> </th>
            <?php endforeach; ?>
            </thead>
            <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= $client["id"] ?></td>
                    <td><?= $client["name"] ?></td>
                    <td><?= $client["email"] ?></td>
                    <td> 1 </td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
