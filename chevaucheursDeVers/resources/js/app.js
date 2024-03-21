import './bootstrap';

import'./classement';

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
        messages.insertBefore(li, messages.firstChild); // Insérer le nouvel élément avant le premier enfant existant
    } else {
        // Si les données ne sont pas sous forme de chaîne de caractères, traiter avec FileReader
        const reader = new FileReader();
        reader.onload = function() {
            const messages = document.getElementById('messages');
            const li = document.createElement('li');
            li.textContent = reader.result;
            messages.insertBefore(li, messages.firstChild); // Insérer le nouvel élément avant le premier enfant existant
        };
        reader.readAsText(event.data);
    }
};

window.sendMessage = function() {
    const input = document.getElementById('messageInput');
    const message = input.value.trim(); // Supprimer les espaces avant et après le message
    if (message !== '') { // Vérifier si le message n'est pas vide
        const messages = document.getElementById('messages');
        const li = document.createElement('li');
        li.textContent = message;
        messages.insertBefore(li, messages.firstChild); // Insérer le nouvel élément avant le premier enfant existant
        socket.send(message);
        input.value = '';
    }
};

document.getElementById('messageInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        const message = event.target.value;
        sendMessage();
    }
});
