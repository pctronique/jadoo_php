function editPlat(e) {

}

function tabEditDelClick() {

}

function deletePlat(e) {
  let id = e.target.id.split("_")[1];
  let isExecuted = confirm("Attention vous allez supprimer le plat. 'Ok' pour continuer.");
  if(isExecuted) {
      let values = {"id": id};
      let post = new Post_Save('./?pg=delete_plat');
      post.setData(values).then(function(response) {
          alert(response);
          location.href = "./?pg=admin";
      });
  }
}

let deletes_plat = document.querySelectorAll(".bt_delete");
deletes_plat.forEach(element => {
  element.addEventListener('click', deletePlat);
});

/*
Recuperation d'une image pour afficher dans le general
event (event) : evenement d'ecoute
*/
function loadFiles(event) {
    let files = event.target.files;
    let preview = document.getElementById("img-plat");
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      var imageType = /^image\//;
  
      if (!imageType.test(file.type)) {
        continue;
      }

      preview.src = "";
      preview.file = file;

      var reader = new FileReader();
      reader.onload = (function(aImg) {
          return function(e) { 
              aImg.src = e.target.result;
            };
        })(preview);
      reader.readAsDataURL(file);
    }
}

function annuler_plat(e) {
    e.preventDefault();
    let preview = document.getElementById("img-plat");
    preview.file = null;
    preview.src = "./src/imgs/add_picture_235.svg";
    document.getElementById('categorie').value = "";
    document.getElementById('name').value = "";
    document.getElementById('description').value = "";
}

/*
ajouter une image dans le general
*/
function img_add() {
    document.getElementById('fileToUpload').click();
}

document.getElementById('fileToUpload').addEventListener('change', loadFiles);
document.getElementById('img-plat').addEventListener('click', img_add);
//document.getElementById('annuler_plat').addEventListener('click', annuler_plat);