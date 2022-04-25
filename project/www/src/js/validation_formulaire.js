function isValidName(myval) {
    let validCharactersRegex = /^[A-Za-z '-]{3,}$/;
 
    return (new RegExp(validCharactersRegex)).test(myval.trim());
}

function validation(e) {
    e.preventDefault();
    let values = {
        name : document.getElementById('name').value,
        first_name : document.getElementById('first_name').value,
        mail : document.getElementById('mail').value,
        user_text : document.getElementById('user_text').value
    };
    let regexEmailValide = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const regexEmail = new RegExp(regexEmailValide);

    let regexTextValide = /^.{8,}$/;
    const regexText = new RegExp(regexTextValide);
    
    if(!isValidName(values.name)) {
        document.getElementById("name").style.borderBottomColor = "red";
    }
    if(!isValidName(values.first_name)) {
        document.getElementById("first_name").style.borderBottomColor = "red";
    }
    if(!regexEmail.test(values.mail)) {
        document.getElementById("mail").style.borderBottomColor = "red";
    }
    if(!regexText.test(values.user_text)) {
        document.getElementById("user_text").style.borderBottomColor = "red";
    }

    if(!isValidName(values.name)) {
        document.getElementById("name").focus();
        document.getElementById("name").select();
        alert("Merci d'entrer un nom.");
        return false;
    } else if (!isValidName(values.first_name)) {
        document.getElementById("first_name").focus();
        document.getElementById("first_name").select();
        alert("Merci d'entrer un prénom.");
        return false;
    } else if (!regexEmail.test(values.mail)) {
        document.getElementById("mail").focus();
        document.getElementById("mail").select();
        alert("Merci d'entrer un email.");
        return false;
    } else if (!regexText.test(values.user_text)) {
        document.getElementById("user_text").focus();
        document.getElementById("user_text").select();
        alert("Le message n'est pas valide.");
        return false;
    } else {
        let post = new Post_Save('./?pg=msgpost');
        post.setData(values).then(function(response) {
            alert("Le message a été transmis, nous vous répondrons dans les plus brefs délais.");
            let inputs = document.getElementById('form_inform').querySelectorAll("input");
            inputs.forEach(element => {
                element.value = "";
            });
            document.getElementById('user_text').value = "";
        });
        return false;
    }

}

function styleInputForm(e) {
    e.target.style.borderBottomColor = "rgb(223 223 223)";
}

document.getElementById("name").addEventListener('input', styleInputForm);
document.getElementById("first_name").addEventListener('input', styleInputForm);
document.getElementById("mail").addEventListener('input', styleInputForm);
document.getElementById("user_text").addEventListener('input', styleInputForm);

document.getElementById('button_form').addEventListener('click', validation);

