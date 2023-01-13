<div class="bas">
    <div class="chat">
                <div id="chat-zone"></div>
    </div>
    <div class="chat-footer">
        <input id="message" type="text" placeholder="Que voulez-vous dire ?" class="form-control">
    </div>
</div>


<script TYPE="text/javascript">

const message = document.getElementById('message');
const send = document.getElementById('send');
const chatZone = document.getElementById('chat-zone');

message.addEventListener('keyup', function(event){
    if(event.keyCode === 13) {
        event.preventDefault();
        sendMessage();
    }

});

function sendMessage() {
    if (message.value == "") {
        // Message d'erreur
        return;
    }

    const newMessage = document.createElement('p');
    newMessage.innerText = "<?= $_SESSION['joueur']->getPseudo() ?> : "+message.value;
    chatZone.appendChild(newMessage);
    chatZone.scrollTop = chatZone.scrollHeight;

    let idRoom = <?php echo $partie->getId(); ?>;
    let idJoueur = <?php echo $_SESSION['joueur']->getid(); ?>;
    $.ajax({
        url: "index.php?uc=message&fluxAjax=oui",
        type: "POST",
        data: {param1: message.value, param2: idRoom , param3: idJoueur ,param: "uploadMessage"},
        success: function(response) {
           // console.log(message.value);
            console.log(response);
          message.value = "";
        },
        error: function(xhr, status, error) {
          // Handle error
          console.log("Systeme error message not sent");
        }
      });
      
}
setInterval(function(){
    $.ajax({
        type: "POST",
        url: "index.php?&uc=message&fluxAjax=oui",
        timeout: 2000,
        data: {param1: idRoom ,param: "dlMessage"},
        success: function(data) {
            chatZone.innerHTML=data
        },
        error: function(xhr, status, error) {
            if(status==="timeout") {
            console.log("request timed out");
            }
        }
    });


}, 500);
    
</script>