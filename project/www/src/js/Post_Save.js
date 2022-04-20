class Post_Save {
    constructor(url) {
        this.url = url;
    }

    setData(dataArray){
        let dataObject = this.data(dataArray);
        fetch(this.url, {
          method: 'post',
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
           body: dataObject
        })
        .then((response) => response.text())
        .then((data) => {
          alert(data);
        })
        .catch((error) => {
          alert(error);
        });
    }

    data(data) {
        let text = "";
        for (var key in data) {
            text += key+"="+data[key]+"&";
        }
        return text.trim("&");
    }
}