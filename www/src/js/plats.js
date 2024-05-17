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
Recuperation d'une image pour afficher pour le plat
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

/*
ajouter une image pour le plat
*/
function img_add() {
    document.getElementById('fileToUpload').click();
}

// en cas de changement de fichier (ici d'image)
document.getElementById('fileToUpload').addEventListener('change', loadFiles);
// quand on clique pour changer l'image
document.getElementById('img-plat').addEventListener('click', img_add);