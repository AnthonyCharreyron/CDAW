import http from 'http';
import { server as WebSocketServer } from 'websocket';

// Créer un serveur HTTP
const httpServer = http.createServer();

// Créer un serveur WebSocket en montant sur le serveur HTTP
const wss = new WebSocketServer({
    httpServer: httpServer
});

// Écouter les connexions WebSocket
wss.on('request', function(request) {
    const connection = request.accept(null, request.origin);
    console.log('Connexion WebSocket établie.');

    // Écouter les messages entrants
    connection.on('message', function(message) {
        console.log('Message reçu :', message.utf8Data);

        // Diffuser le message à tous les clients connectés
        wss.connections.forEach(function each(client) {
            if (client !== connection && client.connected) {
                client.send(message.utf8Data);
            }
        });
    });
});

// Démarrer le serveur HTTP
httpServer.listen(8080, function() {
    console.log('Serveur HTTP démarré sur le port 8080.');
});
