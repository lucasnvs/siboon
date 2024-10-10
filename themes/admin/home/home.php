<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="<?= assets('home/home.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('home/home.css', 'admin') ?>">
<?php $this->end(); ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1>Dashboard Siboon Skateshop</h1>
            <p>Bem-vindo de volta, admin!</p>
        </div>
        <div>
            <p>Data: <span id="current-date"></span></p>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-box">
            <h3>Vendas dos Últimos 7 Dias</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <div class="chart-box">
            <h3>Top Produtos Mais Vendidos</h3>
            <canvas id="topProductsChart"></canvas>
        </div>
    </div>
    <br>
    <div class="chart-container">
        <div class="chart-box">
            <h3>Categorias</h3>
            <canvas id="categoryChart"></canvas>
        </div>

        <div class="chart-box">
            <h3>Receita Mensal (R$)</h3>
            <canvas id="monthlyRevenueChart"></canvas>
        </div>
    </div>

</div>