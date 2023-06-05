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
function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

function openModal(title, msg, status, time) {
    let myModal = document.getElementById("myModal");
    myModal.style.display = "block";
    myModal.querySelector('.title').innerHTML = title;
    myModal.querySelector('.msg').innerHTML = msg;
    if(status == 0){    // 0 for tick
        myModal.querySelector('.icon').src ='../images/icons/tick.svg';
    }else if(status == 1){  // 1 for cross
        myModal.querySelector('.icon').src = '../images/icons/cross.svg';
    }
    if(time>0){
        setTimeout(()=>{
            closeModal();
        }, time*1000);
    }
}
