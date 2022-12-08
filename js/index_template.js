const cardView = document.getElementById("cardView");

const menuTemplate = document.querySelector("[data-menu-template]");
const menuCards = document.querySelector("[menu-cards]");
const searchInput = document.querySelector("[data-search]");
let users = [];
// searchInput.addEventListener("input", (e) => {
//     const value = e.target.value;
//     console.log(value);
// });

fetch("http://localhost/food/api/getMenu.php").then((res) => res.json()).then((data) => {
    data.forEach(user => {
        const menu = menuTemplate.content.cloneNode(true).children[0];
        const img = menu.querySelector("[data-image]");
        const title = menu.querySelector("[data-title]");
        const subtitle = menu.querySelector("[data-subtitle]");
        const button = menu.querySelector("[data-button]");

        img.src = "http://localhost/food/food-images/" + user.image;
        title.textContent = user.title;
        subtitle.textContent = user.subtitle;
        button.textContent = "Order Now";
        menuCards.appendChild(menu);
        return {};
    });
});

getCards();
function getCards() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/food/api/getCards.php", true);
    xhr.onload = function () {
        if (this.status === 200) { // console.log(this.responseText);
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
                // let id = "card" + obj.id;
                // let image = "/food/food-images/" + obj.image;
                // document.getElementById(id).style.backgroundImage =
                // "url('http://localhost" + image + "')";

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
                let image = "/food/food-images/" + obj.image;
                document.getElementById(id).style.backgroundImage = "url('http://localhost" + image + "')";
            });
        }
    };
    xhr.send();
}
