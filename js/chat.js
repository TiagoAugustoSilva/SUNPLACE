document.addEventListener("DOMContentLoaded", function () {
    // Elementos do chat
    var chatContainer = document.getElementById("chat-container");
    var chatMessages = document.getElementById("chat-messages");
    var chatInput = document.getElementById("chat-input");
    var openChatBtn = document.getElementById("open-chat-btn"); // Novo elemento de abertura do chat

    // Função para abrir o chat
    function openChat() {
        chatContainer.style.display = "block";
    }

    // Função para enviar mensagens
    function sendMessage() {
        var message = chatInput.value.trim();
        if (message !== "") {
            var messageElement = document.createElement("div");
            messageElement.textContent = "Você: " + message;
            chatMessages.appendChild(messageElement);
            chatInput.value = "";
            // Simulação de resposta do atendente
            setTimeout(function () {
                var response = "Atendente: Obrigado por entrar em contato! Como posso ajudar?";
                var responseElement = document.createElement("div");
                responseElement.textContent = response;
                chatMessages.appendChild(responseElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }
    }

    // Adiciona evento para enviar mensagem ao pressionar Enter
    chatInput.addEventListener("keypress", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            sendMessage();
        }
    });

    // Adiciona evento para abrir o chat ao clicar no novo botão
    openChatBtn.addEventListener("click", function (event) {
        event.preventDefault();
        openChat();
    });
});
