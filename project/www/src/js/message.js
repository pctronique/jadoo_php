function delete_msg(e) {
    let id = e.target.id.split("_", 3)[2];
    document.getElementById("msg_"+id).style.backgroundColor = "red";

    let isExecuted = confirm("Attention vous allez supprimer le message. 'Ok' pour continuer.");
    if(isExecuted) {
        
    } else {
        document.getElementById("msg_"+id).style.backgroundColor = "unset";
    }
}

let deletes_msg = document.querySelectorAll(".img_delete");
deletes_msg.forEach(element => {
    element.addEventListener('click', delete_msg);
});