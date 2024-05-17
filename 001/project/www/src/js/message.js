/**
 * pour la suppression d'un message
 * @param {*} e 
 */
function delete_msg(e) {
    let id = e.target.id.split("_", 3)[2];
    let colorMsg = document.getElementById("msg_"+id).style.backgroundColor;
    document.getElementById("msg_"+id).style.backgroundColor = "red";

    let isExecuted = confirm("Attention vous allez supprimer le message. 'Ok' pour continuer.");
    if(isExecuted) {
        let values = {"id": id};
        let post = new Post_Save('./?pg=delete_msg');
        post.setData(values).then(function(response) {
            alert(response);
            document.getElementById('list_msg').removeChild(document.getElementById('un_msg_'+id));
        });
    } else {
        document.getElementById("msg_"+id).style.backgroundColor = colorMsg;
    }
}

/**
 * recuperation des boutons pour la suppression d'une image
 */
let deletes_msg = document.querySelectorAll(".img_delete");
deletes_msg.forEach(element => {
    element.addEventListener('click', delete_msg);
});