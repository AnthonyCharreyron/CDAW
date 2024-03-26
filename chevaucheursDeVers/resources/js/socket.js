const socket = new WebSocket('ws://localhost:8080');

socket.onopen = function(event) {
    console.log('Connexion établie avec le serveur.');
};

socket.onmessage = function(event) {
    if (event.data === 'reload') {
        window.location.reload(); // Recharge la page lorsque le message 'reload' est reçu
    } else if (typeof event.data === 'string') {
        const messages = document.getElementById('messages');
        const li = document.createElement('li');
        li.innerHTML = event.data;
        messages.insertBefore(li, messages.firstChild); // Insérer le nouvel élément avant le premier enfant existant
    }
};

// Fonction pour envoyer un message au serveur
function sendToServer(message) {
    socket.send(message);
}

// Vérifier si l'URL actuelle correspond à "/jouer"
if (window.location.pathname === '/jouer') {
    document.getElementById('messageInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            const message = event.target.value.trim(); // Supprimer les espaces avant et après le message
            if (message !== '') { // Vérifier si le message n'est pas vide
                sendMessage(message);
            }
        }
    });
}

function sendMessage(message) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const input = document.getElementById('messageInput');
    $.ajax({
        type: "POST",
        url: "/message",
        data: { message: message },
        headers: {'X-CSRF-TOKEN': csrfToken},
        success: function(response) {
            console.log(response);
            const messages = document.getElementById('messages');
            const li = document.createElement('li');
            li.innerHTML = '<b>' + response.pseudo + '</b> : ' + response.message;
            messages.insertBefore(li, messages.firstChild); // Insérer le nouvel élément avant le premier enfant existant
            sendToServer('<b>' + response.pseudo + '</b> : ' + response.message);
            input.value = '';
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Fonction pour déclencher le rechargement de la page pour tous les clients
window.reloadPageForAllClients=function() {
    sendToServer('reload');
}
