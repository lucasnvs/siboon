document.getElementById("current-date").textContent = new Date().toLocaleDateString("pt-BR");

const salesChartCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesChartCtx, {
    type: 'line',
    data: {
        labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        datasets: [{
            label: 'Vendas em R$',
            data: [500, 1000, 750, 1200, 900, 1400, 1600],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const topProductsChartCtx = document.getElementById('topProductsChart').getContext('2d');
const topProductsChart = new Chart(topProductsChartCtx, {
    type: 'bar',
    data: {
        labels: ['Skate Profissional', 'Roda 53mm', 'Truck 139mm', 'Shape Maple', 'Rolamento ABEC-9'],
        datasets: [{
            label: 'Vendas (unidades)',
            data: [120, 90, 80, 70, 60],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Dados de exemplo para a receita mensal
const monthlyRevenueChartCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
const monthlyRevenueChart = new Chart(monthlyRevenueChartCtx, {
    type: 'bar',
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
        datasets: [{
            label: 'Receita Mensal (R$)',
            data: [10000, 12000, 8000, 15000, 13000, 17000, 14000],
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
        },
    }
});

// Dados de exemplo para as categorias mais vendidas
const categoryChartCtx = document.getElementById('categoryChart').getContext('2d');
const categoryChart = new Chart(categoryChartCtx, {
    type: 'pie',
    data: {
        labels: ['Camisetas', 'Calças', 'Acessórios', 'Tênis', 'Moletom'],
        datasets: [{
            data: [300, 200, 150, 250, 100],
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            hoverBackgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
        },
    }
});