// Função que carrega os dados do Gráfico de Leituras de Nível
async function carregarDados() {
    const response = await fetch('dados.php');
    const data = await response.json();

    const ctx = document.getElementById('graficoVolume').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Função que atualiza a cor do componente que mostra a última leitura
async function atualizaCor(v_ultimaleitura) {
    let botao = document.getElementById("button");
    if (v_ultimaleitura > 9) {
        botao.style.backgroundColor = "green";
    } else if (v_ultimaleitura > 6){
        botao.style.backgroundColor = "yellow";
    } else if (v_ultimaleitura > 3){
        botao.style.backgroundColor = "orange";
    } else {
        botao.style.backgroundColor = "red";
    }
}; 