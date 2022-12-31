const menuView = document.getElementById("menuView");
// const searchView = document.getElementById("searchView");
// const search = document.querySelector(".sInput");
// const sBtn = document.querySelector(".searchBtn");
let userid = window.localStorage.getItem("userId");
let prevValue;
let value;
let users = [];

// document.getElementById("searchContainer").style.display = "none";

// search.addEventListener("input", (e) => {
//   value = e.target.value.toLowerCase();
//   console.log(value);

//   users.forEach((user) => {
//     let t = user.title.toLowerCase();
//     let s = user.subtitle.toLowerCase();

//     const isVisible = t.includes(value) || s.includes(value);

//     isVisible
//       ? user.element.classList.remove("hide")
//       : user.element.classList.add("hide");
//   });
// });

getCards();
getMenu();

// New menu template style
function getMenu() {
  const menuTemplate = document.querySelector("[data-menu-template]");
  const menuCards = document.querySelector("[menu-cards]");
  fetch("./api/get-menu.php")
    .then((res) => res.json())
    .then((data) => {
      users = data.map((user) => {
        const menu = menuTemplate.content.cloneNode(true).children[0];

        const title = menu.querySelector("[data-title]");
        const subtitle = menu.querySelector("[data-subtitle]");
        const cardbg = menu.querySelector("[card-bg]");
        const button = menu.querySelector("[data-button]");
        const buttonFlip = menu.querySelector("[data-button-flip]");
        let image = "./food-images/" + user.image;

        cardbg.style.backgroundImage = "url(" + image + ")";
        title.textContent = user.title;
        subtitle.textContent = user.subtitle;
        button.textContent = user.amount + " INR /-";
        button.setAttribute("onclick", "buyFood(" + user.id + ")");
        buttonFlip.textContent = user.amount + " INR /-";
        buttonFlip.setAttribute("onclick", "buyFood(" + user.id + ")");
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

// New card template style
function getCards() {
  const menuTemplate = document.querySelector("[data-menu-template]");
  const menuCards = document.querySelector("[category-cards]");
  fetch("./api/get-category.php")
    .then((res) => res.json())
    .then((data) => {
      users = data.map((user) => {
        const menu = menuTemplate.content.cloneNode(true).children[0];

        const title = menu.querySelector("[data-title]");
        const cardbg = menu.querySelector("[card-bg]");
        const button = menu.querySelector("[data-button]");
        let image = "./category-image/" + user.image;

        cardbg.style.backgroundImage = "url(" + image + ")";
        title.textContent = user.catname;
        button.textContent = "VIEW";
        button.setAttribute("onclick", "showCategory('" + user.catname + "')");
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

function buyFood(id) {
  let loggedin = window.localStorage.getItem("authToken");
  if (!(loggedin !== "" && loggedin === "success")) {
    alert("Need to be logged in to place an order.");
  } else {
    window.location = "./payu/index.php?id=" + id + "&userid=" + userid;
  }
}

function showCategory(category) {
  window.localStorage.setItem("cat", category);
  let cat = window.localStorage.getItem("cat");
  console.log(cat);
  window.location = "./menu.html";
}

// Old menu template style
// function getMenu() {
//   const menuTemplate = document.querySelector("[data-menu-template]");
//   const menuCards = document.querySelector("[menu-cards]");
//   fetch("./api/get-menu.php")
//     .then((res) => res.json())
//     .then((data) => {
//       users = data.map((user) => {
//         const menu = menuTemplate.content.cloneNode(true).children[0];
//         const img = menu.querySelector("[data-image]");
//         const title = menu.querySelector("[data-title]");
//         const subtitle = menu.querySelector("[data-subtitle]");
//         const button = menu.querySelector("[data-button]");

//         img.src = "./food-images/" + user.image;
//         title.textContent = user.title;
//         subtitle.textContent = user.subtitle;
//         button.textContent = user.amount + " /-";
//         button.setAttribute("onclick", "buyFood(" + user.id + ")");
//         menuCards.appendChild(menu);
//         return {
//           title: user.title,
//           subtitle: user.subtitle,
//           image: user.image,
//           element: menu,
//         };
//       });
//     });
// }

// Old categoy style template
// function getCards() {
//   const xhr = new XMLHttpRequest();
//   xhr.open("GET", "./api/get-cards.php", true);
//   xhr.onload = function () {
//     if (this.status === 200) {
//       // console.log(this.responseText);
//       let jsonObj = JSON.parse(this.responseText);
//       console.log(jsonObj);
//       for (let i = 0; i < jsonObj.length; i++) {
//         let obj = jsonObj[i];
//         // console.log(obj.title);
//         console.log("card" + obj.id + " " + obj.title);

//         let card = document.createElement("div");
//         let cardImgWrapper = document.createElement("div");
//         let cardTitle = document.createElement("label");
//         let cardBody = document.createElement("div");
//         let buttonWrapper = document.createElement("div");
//         let spaceDiv = document.createElement("div");
//         let button = document.createElement("button");

//         card.setAttribute("id", "card" + obj.id);
//         card.setAttribute("class", "cards");

//         cardImgWrapper.setAttribute("class", "cards-img-wrapper");

//         cardTitle.setAttribute("id", "card-title");
//         cardTitle.setAttribute("class", "cards-title-center");
//         cardTitle.innerHTML = obj.title;
//         cardBody.setAttribute("class", "cards-body");
//         buttonWrapper.setAttribute("class", "view-btn-wrapper");
//         button.setAttribute("class", "view-btn");
//         button.innerHTML = "View Now";

//         spaceDiv.setAttribute("class", "space");

//         buttonWrapper.appendChild(button);
//         cardBody.appendChild(buttonWrapper);
//         cardImgWrapper.appendChild(cardTitle);

//         card.appendChild(cardImgWrapper);
//         card.appendChild(cardBody);
//         cardView.appendChild(card);
//         if (i !== jsonObj.length - 1) {
//           cardView.appendChild(spaceDiv);
//         }
//       }

//       jsonObj.forEach(function (obj) {});

//       jsonObj.forEach(function (obj) {
//         console.log("card" + obj.id + " " + obj.title);

//         let id = "card" + obj.id;
//         let image = "./food-images/" + obj.image;
//         document.getElementById(id).style.backgroundImage =
//           "url('" + image + "')";
//       });
//     }
//   };
//   xhr.send();
// }
