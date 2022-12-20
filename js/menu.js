let loggedin = window.localStorage.getItem("authToken");
if (!(loggedin !== "" && loggedin === "success")) {
  window.location = "login.html";
}

let userid = window.localStorage.getItem("userId");

let cat = window.localStorage.getItem("cat");
console.log(cat);
let menuApi;
if (cat === "") {
  menuApi = "./api/get-menu.php";
} else {
  document.getElementById("title-head").innerHTML =
    cat + " <span class='show-all' onclick='loadAll()'>( Show all )</span> ";

  // <button class='' onclick='loadAll()'>Show all</button>

  menuApi = "./api/get-menu.php?cat=" + cat;
  window.localStorage.setItem("cat", "");
}

const menuTemplate = document.querySelector("[data-menu-template]");
const menuCards = document.querySelector("[menu-cards]");
// const searchInput = document.querySelector("#searchInput");
const search = document.querySelector(".searchInput");
let users = [];

// searchInput.addEventListener("input", (e) => {
//   value = e.target.value.toLowerCase();
//   if (value === "") {
//     document.getElementsByClassName("menu-items");
//   }
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

// New menu template style

fetch(menuApi)
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

function loadAll() {
  window.localStorage.setItem("cat", "");
  console.log(cat);
  window.location = "./menu.html";
}

function buyFood(id) {
  if (!(loggedin !== "" && loggedin === "success")) {
    window.location = "login.html";
  } else {
    window.location =
      "http:///localhost/food/payu/index.php?id=" + id + "&userid=" + userid;
  }
}

// Old menu style template
// fetch("http://localhost/food/api/get-menu.php")
//   .then((res) => res.json())
//   .then((data) => {
//     users = data.map((user) => {
//       const menu = menuTemplate.content.cloneNode(true).children[0];
//       const img = menu.querySelector("[data-image]");
//       const title = menu.querySelector("[data-title]");
//       const subtitle = menu.querySelector("[data-subtitle]");
//       const button = menu.querySelector("[data-button]");

//       img.src = "http://localhost/food/food-images/" + user.image;
//       title.textContent = user.title;
//       subtitle.textContent = user.subtitle;
//       button.textContent = user.amount + " /-";
//       button.setAttribute("onclick", "buyFood(" + user.id + ")");
//       menuCards.appendChild(menu);
//       return {
//         title: user.title,
//         subtitle: user.subtitle,
//         image: user.image,
//         element: menu,
//       };
//     });
//   });
