const socket = new WebSocket('ws://localhost:8080');

socket.onopen = function(event) {
    console.log('Connexion établie avec le serveur.');
};

socket.onmessage = function(event) {
    const data = event.data.split(','); // Séparer les données en utilisant la virgule comme délimiteur
    
    const type = data[0]; // Le premier élément sera le type
    const content = data.slice(1).join(','); // Le contenu sera le reste des éléments concaténés

    switch (type) {
        case 'chat':
            const messages = document.getElementById('messages');
            const li = document.createElement('li');
            li.innerHTML = content;
            messages.insertBefore(li, messages.firstChild); // Insérer le nouvel élément avant le premier enfant existant
            break;
        case 'reload':
            window.location.reload(); // Recharge la page lorsque le message 'reload' est reçu
            break;
        case 'pioche':
            miseEnSession(content);
            break;
        default:
            console.error('Type de message non pris en charge.');
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
            sendToServer('chat,' + '<b>' + response.pseudo + '</b> : ' + response.message);
            input.value = '';
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Fonction pour déclencher le rechargement de la page pour tous les clients
window.reloadPageForAllClients=function() {
    location.reload();
    sendToServer('reload');
}

window.sendPiocheVisible=function(piocheVisible, csrfToken){
    const message = 'pioche,' + piocheVisible;
    sendToServer(message);
}

function miseEnSession(piocheVisible){
    const csrfToken2 = $('meta[name="csrf-token"]').attr('content');
    console.log('test5');
    $.ajax({
        type: "POST",
        url: "/miseEnSessionCartes",
        asynch: false,
        data: { cartes: piocheVisible },
        headers: {'X-CSRF-TOKEN': csrfToken2},
        success: function(response) {
            console.log(response);
            console.log('test7');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
