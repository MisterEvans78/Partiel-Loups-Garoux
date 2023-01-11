
var div_warning = document.getElementById("warning");

function verifPassword() {
    var mdp = document.getElementById("mdpIns").value;
    var cmdp = document.getElementById("CmdpIns").value;
    var buV = document.getElementById("IscBuValidate");
    console.log(buV)
    IscBuValidate
    if (mdp != cmdp) {
        div_warning.innerHTML = "<p style='color:red;'>Les mots de passe ne correspondent pas</p>";
        $("#IscBuValidate").attr("disabled", 'disabled');

    } else {
       
        div_warning.innerHTML = "<p style='color:green;'>Les mots de passe correspondent</p>";
        $("#IscBuValidate").removeAttr("disabled");
        verifChampsRempInc()
    }
}

function verifChampsRempInc(){
    var mdp = document.getElementById("mdpIns").value.length;
    var cmdp = document.getElementById("CmdpIns").value.length;
    var pseudo = document.getElementById("pseudoIns").value.length;
    var mail = document.getElementById("mailIns").value.length;
    var rgpd = document.getElementById("rgpd").checked;
    if(mdp!=0 && cmdp!=0 && pseudo!=0 && mail!=0 && rgpd){
        $("#IscBuValidate").removeAttr("disabled");
        document.getElementById("warningBis").innerHTML=""
    }else{
        $("#IscBuValidate").attr("disabled", 'disabled')
        document.getElementById("warningBis").innerHTML="<p style='color:red;'>veuillez renseigner tous les champs obligatoires</p>"
        
    }
}

function verifChampsLogin() {
    var mdp = document.getElementById("mdp").value.length;
    var pseudo = document.getElementById("pseudo").value.length;

    if(mdp!=0 && pseudo!=0){
        $("#LoginBuValidate").removeAttr("disabled");
    }else{
        $("#LoginBuValidate").attr("disabled", 'disabled')
    }
}