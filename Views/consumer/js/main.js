let catBtnActive = false;
let hamMenuActive = false;
const catBtn = document.getElementById("cat-btn");
const categories = document.getElementById("categories");
const hamMenu = document.getElementById("three-bars");
const topNav = document.querySelector(".top-nav");
const middleNav = document.querySelector(".middle-nav");
const rightNav = document.querySelector(".right-nav");

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

// Function to close the modal

