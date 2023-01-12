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
    newMessage.innerText = message.value;
    chatZone.appendChild(newMessage);
    chatZone.scrollTop = chatZone.scrollHeight;

    let idRoom = <?php echo $partie->getId(); ?>;
    let idJoueur = <?php echo $_SESSION['joueur']->getid(); ?>;
    $.ajax({
        url: "controleurs/c_message.php",
        type: "POST",
        data: {param1: message.value, param2: idRoom , param3: idJoueur, param4: "1"},
        success: function(response) {
          console.log(message.value+" "+ idRoom+" "+ idJoueur);
          message.value = "";
        },
        error: function(xhr, status, error) {
          // Handle error
        }
      });
      
}
</script>