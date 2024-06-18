// Altere o tempo (em milissegundos) conforme necessário
var interval = 5000; // Define o intervalo de mudança de slide para 5 segundos

// Função para avançar automaticamente os slides
function autoPlay() {
    var radios = document.getElementsByName('radio-btn');
    var radiosLength = radios.length;
    var currentRadio;
    var nextRadio;

    for (var i = 0; i < radiosLength; i++) {
        if (radios[i].checked) {
            currentRadio = i;
            break;
        }
    }

    nextRadio = (currentRadio + 1) % radiosLength;
    radios[nextRadio].checked = true;
}

// Função para rolar suavemente de volta para o topo da página
function voltarAoTopo() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Exibir ou ocultar o botão de voltar ao topo com base na posição de rolagem
window.onscroll = function () {
    mostrarBotaoVoltarTopo();
};

function mostrarBotaoVoltarTopo() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("btnVoltarTopo").style.display = "block";
    } else {
        document.getElementById("btnVoltarTopo").style.display = "none";
    }
}

// Inicia a função de avanço automático em intervalos regulares
setInterval(autoPlay, interval);