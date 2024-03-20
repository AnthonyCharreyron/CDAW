
<div class="chat position-absolute bottom-0 end-0 rounded p-3" style="max-width: 40vh">
    <h4 class="text-center">Chat</h4>
    <div class="bg-light rounded">
        <ul id="messages" class="list-group m-1" style="height: 20vh; overflow-y: auto; overflow-x: hidden; display: flex; flex-direction: column-reverse;"> 
        </ul>
    </div>
    <div class="input-group mt-3">
        <input type="text" id="messageInput" class="form-control" placeholder="Entrez votre message">
        <button class="btn btn-primary" onclick="sendMessage()">Envoyer</button>
    </div>
</div>