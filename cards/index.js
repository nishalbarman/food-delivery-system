const cardView = document.getElementById("cardView");
const menuView = document.getElementById("menuView");
const searchView = document.getElementById("searchView");
const search = document.querySelector(".sInput");
const sBtn = document.querySelector(".searchBtn");
let userid = window.localStorage.getItem("userId");
let prevValue;
let value;
let users = [];

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

getMenu();

function getMenu() {
  const menuTemplate = document.querySelector("[data-menu-template]");
  const menuCards = document.querySelector("[menu-cards]");
  fetch("../api/get-menu.php")
    .then((res) => res.json())
    .then((data) => {
      users = data.map((user) => {
        const menu = menuTemplate.content.cloneNode(true).children[0];

        const title = menu.querySelector("[data-title]");
        const cardbg = menu.querySelector("[card-bg]");
        const button = menu.querySelector("[data-button]");
        let image = "../food-images/" + user.image;

        cardbg.style.backgroundImage = "url(" + image + ")";
        title.textContent = user.title;
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

function buyFood(id) {
  let loggedin = window.localStorage.getItem("authToken");
  if (!(loggedin !== "" && loggedin === "success")) {
    alert("Need to be logged in to place an order.");
  } else {
    window.location = "../payu/index.php?id=" + id + "&userid=" + userid;
  }
}
