// let loggedin = window.localStorage.getItem("authToken");
let loggedin =
  "<?php if (isset($_SESSION['logged'])) {echo $_SESSION['logged'];} else {echo '';} ?>";
console.log(loggedin);
if (loggedin === "") {
  alert("You are not logged, order can't be placed.");
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

  menuApi = "./api/get-menu.php?cat=" + cat;
  window.localStorage.setItem("cat", "");
}

const menuTemplate = document.querySelector("[data-menu-template]");
const menuCards = document.querySelector("[menu-cards]");
const search = document.querySelector("[searchInput]");
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
  window.location = "./menu.php";
}

function buyFood(id) {
  // let loggedin = window.localStorage.getItem("authToken");
  let loggedin = "<?php echo $_SESSION['logged']; ?>";
  if (!(loggedin !== "" && loggedin === "true")) {
    alert("Need to be logged in to place an order.");
  } else {
    // window.location = "./payu/index.php?id=" + id + "&userid=" + userid;
    window.location =
      "http://localhost/food/payu/i/ndex.php?id=" + id + "&userid=" + userid;
  }
}

// function buyFood(id) {
//   if (!(loggedin !== "" && loggedin === "true")) {
//     window.location = "login.html";
//   } else {
//     window.location =
//       "http://localhost/food/payu/i/ndex.php?id=" + id + "&userid=" + userid;
//   }
// }
