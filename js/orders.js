// let userid = window.localStorage.getItem("userId");
let userid =
  "<?php if (isset($_SESSION['logged'])) { echo $_SESSION['email']; } else { echo '';} ?>";
console.log(userid);

const orderTemplate = document.querySelector("[data-order-template]");
const orderCards = document.querySelector("[order-cards]");

let options = {
  method: "POST",
  headers: {
    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
  },
  body: "email=" + userid,
};

fetch("http://localhost/food/api/orders.php", options)
  .then((res) => res.json())
  .then((data) => {
    if (data.length === 0) {
      const order = orderTemplate.content.cloneNode(true).children[0];
      const orderDate = order.querySelector("[order-date]");
      const orderPrice = order.querySelector("[order-price]");
      const orderUsername = order.querySelector("[order-name]");
      const orderSname = order.querySelector("[order-sname]");
      const orderAddress = order.querySelector("[order-address]");
      const orderStatus = order.querySelector("[order-status]");
      const orderImage = order.querySelector("[order-image]");
      const orderTitle = order.querySelector("[order-title]");
      const orderSubtitle = order.querySelector("[order-subtitle]");
      const orderButton = order.querySelector("[order-button]");
      const orderHeader = order.querySelector("[order-header]");

      orderDate.style.display = "none";
      orderPrice.style.display = "none";
      orderUsername.style.display = "none";
      orderSname.style.display = "none";
      orderAddress.style.display = "none";
      orderStatus.style.display = "none";
      orderImage.style.display = "none";
      orderTitle.textContent = "No orders found";
      orderSubtitle.style.display = "none";
      orderButton.style.display = "none";
      orderHeader.style.display = "none";

      orderCards.appendChild(order);
      return;
    }

    users = data.map((user) => {
      const order = orderTemplate.content.cloneNode(true).children[0];
      const orderDate = order.querySelector("[order-date]");
      const orderPrice = order.querySelector("[order-price]");
      const orderUsername = order.querySelector("[order-name]");
      const orderSname = order.querySelector("[order-sname]");
      const orderAddress = order.querySelector("[order-address]");
      const orderStatus = order.querySelector("[order-status]");
      const orderImage = order.querySelector("[order-image]");
      const orderTitle = order.querySelector("[order-title]");
      const orderSubtitle = order.querySelector("[order-subtitle]");

      orderDate.textContent = user.date;
      orderPrice.textContent = user.amount;
      orderUsername.textContent = user.fname;
      orderSname.textContent = user.fname;
      orderAddress.textContent = user.address;
      orderStatus.textContent = user.status;
      orderImage.src = "http://localhost/food/food-images/" + user.foodimage;
      orderTitle.textContent = user.foodtitle;
      orderSubtitle.textContent = user.foodsubtitle;

      orderCards.appendChild(order);
      return {
        title: user.foodtitle,
        subtitle: user.foodsubtitle,
        amount: user.amount,
        element: order,
      };
    });
  });
