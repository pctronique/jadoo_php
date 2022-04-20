function validation() {
    let values = {
        name : document.getElementById('name').value,
        first_name : document.getElementById('first_name').value,
        mail : document.getElementById('mail').value,
        user_text : document.getElementById('user_text').value
    };

    if(values.name == "") {
        alert("Merci d'entrer un nom.");
    } else if (values.first_name == "") {
        alert("Merci d'entrer un prénom.");
    } else if (values.mail == "") {
        alert("Merci d'entrer un email.");
    } else if (values.user_text == "") {
        alert("Merci d'entrer un texte.");
    } else {
        let post = new Post_Save('./src/exec/formulaire_post.php');
        post.setData(values);
    }
}

document.getElementById('button_form').addEventListener('click', validation);