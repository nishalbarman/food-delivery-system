const menuView = document.getElementById("menuView");
let userid = window.localStorage.getItem("userId");
let prevValue;
let value;
let users = [];

getBanner();
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
  const menuTemplate = document.querySelector("[data-category-template]");
  const menuCards = document.querySelector("[category-cards]");
  fetch("./api/get-category.php")
    .then((res) => res.json())
    .then((data) => {
      users = data.map((user) => {
        const menu = menuTemplate.content.cloneNode(true).children[0];

        const title = menu.querySelector("[data-title]");
        const cardbg = menu.querySelector("[card-bg]");
        let image = "./category-image/" + user.image;

        cardbg.style.backgroundImage = "url(" + image + ")";
        title.textContent = user.catname;
        cardbg.setAttribute("onclick", "showCategory('" + user.catname + "')");
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
function getBanner() {
  const sideShowTemplate = document.querySelector("[data-banner]");
  const slideShowView = document.querySelector("[slide-show]");

  const dotTemplate = document.querySelector("[banner-dot]");
  const dotsView = document.querySelector("[dots-data]");

  const xhttp = new XMLHttpRequest();

  xhttp.onload = function () {
    let jsonData = JSON.parse(xhttp.responseText);
    console.log(jsonData);
    let count = 1;
    let length = jsonData.length;
    jsonData.forEach((user) => {
      const banner = sideShowTemplate.content.cloneNode(true).children[0];
      const dots = dotTemplate.content.cloneNode(true).children[0];

      dots.setAttribute("onlcick", "currentSlide('" + count + "')");
      count++;

      const numText = banner.querySelector("[num-data]");
      const caption = banner.querySelector("[caption-data]");
      const cardbg = banner.querySelector("[img-data]");
      // const button = menu.querySelector("[data-button]");

      cardbg.src = "./banner-image/" + user.image;
      caption.innerHTML = "<h2>" + user.bannert + "</h2>";
      numText.innerHTML = "<span>" + user.id + " / " + length + "</span>";
      cardbg.setAttribute("onclick", "document.location='" + user.url + "'");
      slideShowView.appendChild(banner);
      dotsView.appendChild(dots);
    });
  };

  xhttp.open("GET", "./api/get-banner.php", false);
  xhttp.send();
}

function buyFood(id) {
  // let loggedin = window.localStorage.getItem("authToken");
  let loggedin = "<?php echo $_SESSION['logged'];?>";
  if (!(loggedin !== "" && loggedin === "true")) {
    alert("Need to be logged in to place an order.");
  } else {
    window.location = "./payu/index.php?id=" + id + "&userid=" + userid;
  }
}

function showCategory(category) {
  window.localStorage.setItem("cat", category);
  let cat = window.localStorage.getItem("cat");
  console.log(cat);
  window.location = "./menu.php";
}
