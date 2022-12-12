let loggedin = window.localStorage.getItem("authToken");
if (!(loggedin !== "" && loggedin === "success")) {
  window.location = "login.html";
}

let userid = window.localStorage.getItem("userId");

const menuTemplate = document.querySelector("[data-menu-template]");
const menuCards = document.querySelector("[menu-cards]");
const searchInput = document.querySelector("#searchInput");
const search = document.querySelector(".searchInput");
let users = [];

searchInput.addEventListener("input", (e) => {
  value = e.target.value.toLowerCase();
  if (value === "") {
    document.getElementsByClassName("menu-items");
  }
  console.log(value);
  users.forEach((user) => {
    let t = user.title.toLowerCase();
    let s = user.subtitle.toLowerCase();

    const isVisible = t.includes(value) || s.toLowerCase().includes(value);

    isVisible
      ? user.element.classList.remove("hide")
      : user.element.classList.add("hide");
  });
});

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

function buyFood(id) {
  window.location =
    "http:///localhost/food/payu/index.php?id=" + id + "&userid=" + userid;
}