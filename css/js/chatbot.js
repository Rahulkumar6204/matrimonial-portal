document.addEventListener('DOMContentLoaded', function () {
    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotUserInput = document.getElementById('chatbot-user-input');
    const chatbotSend = document.getElementById('chatbot-send');
    const chatbotClose = document.getElementById('chatbot-close');

    // Generate a unique session ID
    const sessionId = Math.random().toString(36).substring(7);

    // Toggle chatbot visibility
    document.getElementById('chatbot-toggle').addEventListener('click', function () {
        chatbotContainer.style.display = chatbotContainer.style.display === 'none' ? 'block' : 'none';
    });

    // Close chatbot
    chatbotClose.addEventListener('click', function () {
        chatbotContainer.style.display = 'none';
    });

    // Send message
    chatbotSend.addEventListener('click', function () {
        sendMessage();
    });

    chatbotUserInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    function sendMessage() {
        const userMessage = chatbotUserInput.value.trim();
        if (userMessage) {
            addMessage('user', userMessage);
            chatbotUserInput.value = '';
            fetchBotResponse(userMessage);
        }
    }

    function addMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chatbot-message', sender);
        messageElement.textContent = message;
        chatbotMessages.appendChild(messageElement);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function fetchBotResponse(message) {
        fetch('includes/dialogflow_integration.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message: message,
                sessionId: sessionId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            addMessage('bot', data.response);
        });
    }
});
