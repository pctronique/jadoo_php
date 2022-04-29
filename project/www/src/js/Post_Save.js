/**
 * Pour envoyer des post dans un fichier php et executer celui-ci
 */
class Post_Save {

  /**
   * le constructeur de la classe a partir de l'adresse du fichier php
   * @param {*} url l'adresse du fichier php
   */
  constructor(url) {
    this.url = url;
  }

  /**
   * executer la commande avec les donnees post a transmettre
   * @param {*} dataArray (array) : les donnees post a transmettre
   * @returns 
   */
  setData(dataArray) {
    let dataObject = this.data(dataArray);
    return fetch(this.url, {
      method: "post",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: dataObject,
    })
      .then((response) => response.text())
      .catch((error) => console.error("Error:", error));
  }

  /**
   * 
   * @param {*} data (array) : les donnees post a transmettre
   * @returns (string) : les valeurs a stransmettre sous format string
   */
  data(data) {
    let text = "";
    for (var key in data) {
      text += key + "=" + data[key] + "&";
    }
    return text.trim("&");
  }
}
