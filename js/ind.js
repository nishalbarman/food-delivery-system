const cardView = document.getElementById("cardView");
const menuView = document.getElementById("menuView");
const searchView = document.getElementById("searchView");
const search = document.querySelector(".sInput");
const sBtn = document.querySelector(".searchBtn");
let prevValue;
let value;
let userid = window.localStorage.getItem("userId");

document.getElementById("searchContainer").style.display = "none";

search.addEventListener("input", (e) => {
  value = e.target.value.toLowerCase();
  console.log(value);
  if (value === "") {
    document.getElementById("searchContainer").style.display = "none";
    document.getElementById("cardss").style.display = "block";
    document.getElementById("menuWrapper").style.display = "block";
  }
});

sBtn.addEventListener("click", function () {
  if (value === prevValue) {
    return;
  }
  prevValue = value;
  searchView.innerHTML = "";
  fetch("http://localhost/food/api/get-menu.php")
    .then((res) => res.json())
    .then((jsonObj) => {
      let count = 0;
      let newJson = {};
      jsonObj.forEach((element) => {
        // console.log(element.title);
        if (
          element.title.toLowerCase().includes(value) ||
          element.subtitle.toLowerCase().includes(value)
        ) {
          newJson[count] = {
            id: element.id,
            title: element.title,
            subtitle: element.subtitle,
            // button: element.button,
            image: element.image,
            amount: element.amount,
            stocks: element.stocks,
          };
          count++;
        }
      });

      console.log(count);
      for (let i = 0; i < count; i = i + 2) {
        let menuContent = document.createElement("div");
        menuContent.setAttribute("class", "menuContent");

        let k = i + 2;
        if (k > count) {
          let obj = newJson[i];
          let menu = document.createElement("div");

          let menuImg = document.createElement("div");
          let img = document.createElement("img");
          let menuBody = document.createElement("div");
          let menuTitleWrapper = document.createElement("div");
          let menuTitle = document.createElement("label");
          let menuSubTitleWrapper = document.createElement("div");
          let menuSubTitle = document.createElement("label");
          let buttonWrapper = document.createElement("div");
          let button = document.createElement("button");
          let spaceDiv = document.createElement("div");
          let pbreak = document.createElement("br");

          menuImg.setAttribute("class", "menu-img");

          menu.setAttribute("class", "menu-item");
          menuBody.setAttribute("class", "menu-body");

          menuSubTitleWrapper.setAttribute("class", "menu-sub-wrapper");
          menuSubTitle.setAttribute("id", "menu-sub-title");
          menuSubTitle.setAttribute("class", "menu-title-center");
          img.setAttribute("class", "menu-img-el");
          menuTitleWrapper.setAttribute("class", "menu-title-wrapper");
          menuTitle.setAttribute("id", "menu-title");
          menuTitle.setAttribute("class", "menu-title-center");
          buttonWrapper.setAttribute("class", "menu-btn-wrapper");
          button.setAttribute("class", "buy-btn");
          button.setAttribute("onclick", "buyFood(" + obj.id + ")");
          spaceDiv.setAttribute("class", "space");

          menu.setAttribute("id", "menu" + obj.id);
          img.src = "http://localhost/food/food-images/" + obj.image;
          menuTitle.innerHTML = obj.title;
          menuSubTitle.innerHTML = obj.subtitle;
          button.innerHTML = obj.amount + " /-";

          menuImg.appendChild(img);
          menuTitleWrapper.appendChild(menuTitle);
          menuSubTitleWrapper.appendChild(menuSubTitle);
          buttonWrapper.appendChild(button);
          menuBody.appendChild(menuTitleWrapper);
          menuBody.appendChild(menuSubTitleWrapper);
          menuBody.appendChild(buttonWrapper);
          menu.appendChild(menuImg);
          menu.appendChild(menuBody);
          menuContent.appendChild(menu);
        } else {
          let spaceAdd = 0;
          for (let j = i; j < k; j++) {
            let obj = newJson[j];
            // alert(obj.title);
            let menu = document.createElement("div");

            let menuImg = document.createElement("div");
            let img = document.createElement("img");
            let menuBody = document.createElement("div");
            let menuTitleWrapper = document.createElement("div");
            let menuTitle = document.createElement("label");
            let menuSubTitleWrapper = document.createElement("div");
            let menuSubTitle = document.createElement("label");
            let buttonWrapper = document.createElement("div");
            let button = document.createElement("button");
            let spaceDiv = document.createElement("div");
            let pbreak = document.createElement("br");

            menuImg.setAttribute("class", "menu-img");

            menu.setAttribute("class", "menu-item");
            menuBody.setAttribute("class", "menu-body");

            menuSubTitleWrapper.setAttribute("class", "menu-sub-wrapper");
            menuSubTitle.setAttribute("id", "menu-sub-title");
            menuSubTitle.setAttribute("class", "menu-title-center");
            img.setAttribute("class", "menu-img-el");
            menuTitleWrapper.setAttribute("class", "menu-title-wrapper");
            menuTitle.setAttribute("id", "menu-title");
            menuTitle.setAttribute("class", "menu-title-center");
            buttonWrapper.setAttribute("class", "menu-btn-wrapper");
            button.setAttribute("class", "buy-btn");
            button.setAttribute("onclick", "buyFood(" + obj.id + ")");
            spaceDiv.setAttribute("class", "space");

            menu.setAttribute("id", "menu" + obj.id);
            img.src = "http://localhost/food/food-images/" + obj.image;
            menuTitle.innerHTML = obj.title;
            menuSubTitle.innerHTML = obj.subtitle;
            button.innerHTML = obj.amount + " /-";

            menuImg.appendChild(img);
            menuTitleWrapper.appendChild(menuTitle);
            menuSubTitleWrapper.appendChild(menuSubTitle);
            buttonWrapper.appendChild(button);
            menuBody.appendChild(menuTitleWrapper);
            menuBody.appendChild(menuSubTitleWrapper);
            menuBody.appendChild(buttonWrapper);
            menu.appendChild(menuImg);
            menu.appendChild(menuBody);
            menuContent.appendChild(menu);
            if (spaceAdd === 0) {
              menuContent.appendChild(spaceDiv);
              spaceAdd = 1;
            }
          }
        }
        searchView.appendChild(menuContent);
        document.getElementById("searchContainer").style.display = "block";
        document.getElementById("cardss").style.display = "none";
        document.getElementById("menuWrapper").style.display = "none";
      }
      console.log(value + " is Matched with");
      console.log(newJson);
    });
});

getCards();
getMenu();

function getMenu() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/food/api/get-menu.php", true);
  xhr.onload = function () {
    if (this.status === 200) {
      // console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      console.log(jsonObj);
      for (let i = 0; i < jsonObj.length; i = i + 2) {
        // console.log(obj.title);
        // console.log("card" + obj.id + " " + obj.title);
        // console.log("card" + obj.id + " " + obj.subtitle);

        let menuContent = document.createElement("div");
        menuContent.setAttribute("class", "menuContent");

        let k = i + 2;
        if (k > jsonObj.length) {
          let obj = jsonObj[i];
          let menu = document.createElement("div");

          let menuImg = document.createElement("div");
          let img = document.createElement("img");
          let menuBody = document.createElement("div");
          let menuTitleWrapper = document.createElement("div");
          let menuTitle = document.createElement("label");
          let menuSubTitleWrapper = document.createElement("div");
          let menuSubTitle = document.createElement("label");
          let buttonWrapper = document.createElement("div");
          let button = document.createElement("button");
          let spaceDiv = document.createElement("div");
          let pbreak = document.createElement("br");

          menuImg.setAttribute("class", "menu-img");

          menu.setAttribute("class", "menu-item");
          menuBody.setAttribute("class", "menu-body");

          menuSubTitleWrapper.setAttribute("class", "menu-sub-wrapper");
          menuSubTitle.setAttribute("id", "menu-sub-title");
          menuSubTitle.setAttribute("class", "menu-title-center");
          img.setAttribute("class", "menu-img-el");
          menuTitleWrapper.setAttribute("class", "menu-title-wrapper");
          menuTitle.setAttribute("id", "menu-title");
          menuTitle.setAttribute("class", "menu-title-center");
          buttonWrapper.setAttribute("class", "menu-btn-wrapper");
          button.setAttribute("class", "buy-btn");
          button.setAttribute("onclick", "buyFood(" + obj.id + ")");
          button.setAttribute("id", obj.id);
          spaceDiv.setAttribute("class", "space");

          menu.setAttribute("id", "menu" + obj.id);
          img.src = "http://localhost/food/food-images/" + obj.image;
          menuTitle.innerHTML = obj.title;
          menuSubTitle.innerHTML = obj.subtitle;
          button.innerHTML = obj.amount + " /-";

          menuImg.appendChild(img);
          menuTitleWrapper.appendChild(menuTitle);
          menuSubTitleWrapper.appendChild(menuSubTitle);
          buttonWrapper.appendChild(button);
          menuBody.appendChild(menuTitleWrapper);
          menuBody.appendChild(menuSubTitleWrapper);
          menuBody.appendChild(buttonWrapper);
          menu.appendChild(menuImg);
          menu.appendChild(menuBody);
          menuContent.appendChild(menu);
        } else {
          let spaceAdd = 0;
          for (let j = i; j < k; j++) {
            let obj = jsonObj[j];
            let menu = document.createElement("div");

            let menuImg = document.createElement("div");
            let img = document.createElement("img");
            let menuBody = document.createElement("div");
            let menuTitleWrapper = document.createElement("div");
            let menuTitle = document.createElement("label");
            let menuSubTitleWrapper = document.createElement("div");
            let menuSubTitle = document.createElement("label");
            let buttonWrapper = document.createElement("div");
            let button = document.createElement("button");
            let spaceDiv = document.createElement("div");
            let pbreak = document.createElement("br");

            menuImg.setAttribute("class", "menu-img");

            menu.setAttribute("class", "menu-item");
            menuBody.setAttribute("class", "menu-body");

            menuSubTitleWrapper.setAttribute("class", "menu-sub-wrapper");
            menuSubTitle.setAttribute("id", "menu-sub-title");
            menuSubTitle.setAttribute("class", "menu-title-center");
            img.setAttribute("class", "menu-img-el");
            menuTitleWrapper.setAttribute("class", "menu-title-wrapper");
            menuTitle.setAttribute("id", "menu-title");
            menuTitle.setAttribute("class", "menu-title-center");
            buttonWrapper.setAttribute("class", "menu-btn-wrapper");
            button.setAttribute("class", "buy-btn");
            button.setAttribute("id", obj.id);
            spaceDiv.setAttribute("class", "space");

            menu.setAttribute("id", "menu" + obj.id);
            img.src = "http://localhost/food/food-images/" + obj.image;
            menuTitle.innerHTML = obj.title;
            menuSubTitle.innerHTML = obj.subtitle;
            button.setAttribute("onclick", "buyFood(" + obj.id + ")");
            button.innerHTML = obj.amount + " /-";

            menuImg.appendChild(img);
            menuTitleWrapper.appendChild(menuTitle);
            menuSubTitleWrapper.appendChild(menuSubTitle);
            buttonWrapper.appendChild(button);
            menuBody.appendChild(menuTitleWrapper);
            menuBody.appendChild(menuSubTitleWrapper);
            menuBody.appendChild(buttonWrapper);
            menu.appendChild(menuImg);
            menu.appendChild(menuBody);
            menuContent.appendChild(menu);
            if (spaceAdd === 0) {
              menuContent.appendChild(spaceDiv);
              spaceAdd = 1;
            }
          }
        }
        menuView.appendChild(menuContent);
      }
    }
  };
  xhr.send();
}

function getCards() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/food/api/get-cards.php", true);
  xhr.onload = function () {
    if (this.status === 200) {
      // console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      console.log(jsonObj);
      for (let i = 0; i < jsonObj.length; i++) {
        let obj = jsonObj[i];
        // console.log(obj.title);
        console.log("card" + obj.id + " " + obj.title);

        let card = document.createElement("div");
        let cardImgWrapper = document.createElement("div");
        let cardTitle = document.createElement("label");
        let cardBody = document.createElement("div");
        let buttonWrapper = document.createElement("div");
        let spaceDiv = document.createElement("div");
        let button = document.createElement("button");

        card.setAttribute("id", "card" + obj.id);
        card.setAttribute("class", "cards");

        cardImgWrapper.setAttribute("class", "cards-img-wrapper");

        cardTitle.setAttribute("id", "card-title");
        cardTitle.setAttribute("class", "cards-title-center");
        cardTitle.innerHTML = obj.title;
        cardBody.setAttribute("class", "cards-body");
        buttonWrapper.setAttribute("class", "view-btn-wrapper");
        button.setAttribute("class", "view-btn");
        button.innerHTML = "View Now";

        spaceDiv.setAttribute("class", "space");

        buttonWrapper.appendChild(button);
        cardBody.appendChild(buttonWrapper);
        cardImgWrapper.appendChild(cardTitle);

        card.appendChild(cardImgWrapper);
        card.appendChild(cardBody);
        cardView.appendChild(card);
        if (i !== jsonObj.length - 1) {
          cardView.appendChild(spaceDiv);
        }
      }

      jsonObj.forEach(function (obj) {});

      jsonObj.forEach(function (obj) {
        console.log("card" + obj.id + " " + obj.title);

        let id = "card" + obj.id;
        let image = "http://localhost/food/food-images/" + obj.image;
        document.getElementById(id).style.backgroundImage =
          "url('" + image + "')";
      });
    }
  };
  xhr.send();
}

function buyFood(id) {
  window.location =
    "http:///localhost/food/payu/index.php?id=" + id + "&userid=" + userid;
}
