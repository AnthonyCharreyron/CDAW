import './bootstrap';


const socket = new WebSocket('ws://localhost:8080');

socket.onopen = function(event) {
    console.log('Connexion établie avec le serveur.');
};

socket.onmessage = function(event) {
    if (typeof event.data === 'string') {
        // Si les données sont déjà sous forme de chaîne de caractères, pas besoin de les traiter avec FileReader
        const messages = document.getElementById('messages');
        const li = document.createElement('li');
        li.textContent = event.data;
        messages.appendChild(li);
    } else {
        // Si les données ne sont pas sous forme de chaîne de caractères, traiter avec FileReader
        const reader = new FileReader();
        reader.onload = function() {
            const messages = document.getElementById('messages');
            const li = document.createElement('li');
            li.textContent = reader.result;
            messages.appendChild(li);
        };
        reader.readAsText(event.data);
    }
};


window.sendMessage = function() {
    const input = document.getElementById('messageInput');
    const message = input.value;
    const messages = document.getElementById('messages');
    const li = document.createElement('li');
    li.textContent = message;
    messages.appendChild(li);
    socket.send(message);
    input.value = '';
}


