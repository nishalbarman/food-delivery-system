const cardView = document.getElementById("cardView");
const menuView = document.getElementById("menuView");
const searchView = document.getElementById("searchView");
const search = document.querySelector(".sInput");
const sBtn = document.querySelector(".searchBtn");
let userid = window.localStorage.getItem("userId");
let prevValue;
let value;
let users = [];

document.getElementById("searchContainer").style.display = "none";

search.addEventListener("input", (e) => {
  value = e.target.value.toLowerCase();
  console.log(value);

  users.forEach((user) => {
    let t = user.title.toLowerCase();
    let s = user.subtitle.toLowerCase();

    const isVisible = t.includes(value) || s.includes(value);

    isVisible
      ? user.element.classList.remove("hide")
      : user.element.classList.add("hide");
  });
});

getCards();
getMenu();

function getMenu() {
  const menuTemplate = document.querySelector("[data-menu-template]");
  const menuCards = document.querySelector("[menu-cards]");
  fetch("http://localhost/food/api/get-menu.php")
    .then((res) => res.json())
    .then((data) => {
      users = data.map((user) => {
        const menu = menuTemplate.content.cloneNode(true).children[0];
        const img = menu.querySelector("[data-image]");
        const title = menu.querySelector("[data-title]");
        const subtitle = menu.querySelector("[data-subtitle]");
        const button = menu.querySelector("[data-button]");

        img.src = "http://localhost/food/food-images/" + user.image;
        title.textContent = user.title;
        subtitle.textContent = user.subtitle;
        button.textContent = user.amount + " /-";
        button.setAttribute("onclick", "buyFood(" + user.id + ")");
        menuCards.appendChild(menu);
        return {
          title: user.title,
          subtitle: user.subtitle,
          image: user.image,
          element: menu,
        };
      });
    });
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
  let loggedin = window.localStorage.getItem("authToken");
  if (!(loggedin !== "" && loggedin === "success")) {
    alert("Need to be logged in to place an order.");
  } else {
    window.location =
      "http:///localhost/food/payu/index.php?id=" + id + "&userid=" + userid;
  }
}
