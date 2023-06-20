let catBtnActive = false;
let hamMenuActive = false;
const catBtn = document.getElementById("cat-btn");
const categories = document.getElementById("categories");
const hamMenu = document.getElementById("three-bars");
const topNav = document.querySelector(".top-nav");
const middleNav = document.querySelector(".middle-nav");
const rightNav = document.querySelector(".right-nav");
const navNum = document.querySelector("#cart-num");

function handleCategory() {
  if (catBtnActive) {
    catBtn.classList.add("active");
    categories.classList.add("active");
  } else {
    catBtn.classList.remove("active");
    categories.classList.remove("active");
  }
}
function handleMenu() {
  if (hamMenuActive) {
    middleNav.classList.remove("hidden");
    rightNav.classList.remove("hidden");
    topNav.classList.remove("active");
    hamMenu.src = "../images/icons/3bars.svg";
  } else {
    middleNav.classList.add("hidden");
    rightNav.classList.add("hidden");
    topNav.classList.add("active");
    hamMenu.src = "../images/icons/cross.svg";
  }
}
// handleMenu()

catBtn.addEventListener("click", () => {
  catBtnActive = !catBtnActive ? true : false;
  handleCategory();
});

hamMenu.addEventListener("click", () => {
  hamMenuActive = hamMenuActive ? false : true;
  catBtnActive = false;
  handleCategory();
  handleMenu();
});

function getCookie(name) {
  const cookieArr = document.cookie.split("; ");
  for (let i = 0; i < cookieArr.length; i++) {
    const cookiePair = cookieArr[i].split("=");
    if (cookiePair[0] === name) {
      return JSON.parse(decodeURIComponent(cookiePair[1]));
    }
  }
  return null;
}

function setCookie(name, value, days) {
  const expires = new Date();
  expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = name + "=" + encodeURIComponent(JSON.stringify(value)) + ";expires=" + expires.toUTCString();
}

function deleteCookie(cookieName) {
  setCookie(cookieName, '');
}

function updateCartNum() {
  const cartItems = getCookie("nisargiCart101");
  const parsedItems = cartItems ? JSON.parse(cartItems) : [];
  navNum.innerHTML = parsedItems.length;
}

document.addEventListener("DOMContentLoaded", function () {
  updateCartNum();
});


// Function to close the modal
