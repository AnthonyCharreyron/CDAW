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
        case 'lancer_partie':
            const [pioche, destinationsString] = content.split('|');
            const destinations = JSON.parse(destinationsString); // Convertir la chaîne JSON en objet JavaScript
            miseEnSession('piocheVisibleGlobale', pioche);
        
            for (const [key, value] of Object.entries(destinations)) {
                const typeCarte = key;
                const destinationsJoueur = value;
                console.log(typeCarte);
                console.log(destinationsJoueur);
                miseEnSession(typeCarte, destinationsJoueur);
            }

            initialiserCartesMain();
            break;
        case 'redirect':
            window.location.href='/jouer/partie/' + content;
            break;
        case 'user_join':
            //let codePartie = content.split('|')[0]; 
            let pseudo = content.split('|')[1]; 
            let nb_joueurs = content.split('|')[2]; 

            const userJoin = document.getElementById('userJoin');
            const li2 = document.createElement('li');
            li2.innerHTML = pseudo;
            userJoin.insertBefore(li2, userJoin.firstChild);

            const container = document.getElementById('nb_joueurs');
            container.innerHTML = nb_joueurs;
            if(nb_joueurs === nb_joueurs_max){
                $('.incomplet').hide();
                $('.complet').show();
            }
            break;
        case 'fin_de_tour':
            let listePseudo = content.split('|')[0].split(',');
            let nomJoueurActuel = content.split('|')[1]; 
            let joueur = joueursSuivants(listePseudo, nomJoueurActuel);
            prochainTour(joueur);
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
if (window.location.pathname.includes('/jouer/partie') || window.location.pathname.includes('/jouer/lobby')) {
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

window.sendLancerPartie = function(piocheVisible, cartesDestinations) {
    try {
        const message = 'lancer_partie,' + piocheVisible + '|' + JSON.stringify(cartesDestinations);
        sendToServer(message);
    } catch (error) {
        console.error('Erreur lors de la conversion en JSON :', error);
    }
}


window.sendRedirectionPartie=function(codePartie){
    const message = 'redirect,' + codePartie;
    sendToServer(message);
}

window.sendUserJoinPartie=function(codePartie, pseudo, nb_joueurs){
    const message = 'user_join,' + codePartie + '|' + pseudo + '|' + nb_joueurs;
    sendToServer(message);
}

window.sendFinDeTour = function (listePseudo, pseudo){
    const message = 'fin_de_tour,' + listePseudo + '|' + pseudo;
    sendToServer(message);
}

function miseEnSession(type, cartes){
    const csrfToken2 = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: "/miseEnSessionCartes",
        asynch: false,
        data: { type: type, cartes: cartes },
        headers: {'X-CSRF-TOKEN': csrfToken2},
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function initialiserCartesMain(){
    const csrfToken3 = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: "/initialiserCartesMain",
        asynch: false,
        headers: {'X-CSRF-TOKEN': csrfToken3},
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function joueursSuivants(listePseudo, pseudoActuel) {
    var index = listePseudo.indexOf(pseudoActuel);
    if (index === -1) {
        return null;
    }
    var indexSuivant = (index + 1) % listePseudo.length;
    return listePseudo[indexSuivant];
}

function prochainTour(joueur){
    console.log(joueur);
    if(pseudoJoueur === joueur){
        console.log('true');
    }
    console.log('false');
}