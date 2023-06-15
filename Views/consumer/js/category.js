let products = document.getElementsByClassName("one-product");
let productsBtn = document.getElementsByClassName("productBtn");
// console.log(productsBtn);

function updateCartBtn() {
  const cartIds = sessionStorage.getItem("nisargiCart101");
  const parsedIds = cartIds ? JSON.parse(cartIds) : [];

  Array.from(productsBtn).forEach((btn) => {
    if (parsedIds.includes(btn.id.replace("productBtn", ""))) {
      btn.classList.add("inCart");
      btn.textContent = "Remove on Cart";
      btn.onclick = () => removeFromCart(btn.id.replace("productBtn", ""));
    } else {
      btn.classList.remove("inCart");
      btn.textContent = "Add to Cart";
      btn.onclick = () => addToCart(btn.id.replace("productBtn", ""));
    }
  });
}


function addToCart(productId) {
  const cartIds = sessionStorage.getItem("nisargiCart101");
  const parsedIds = cartIds ? JSON.parse(cartIds) : [];
  parsedIds.push(productId);
  sessionStorage.setItem("nisargiCart101", JSON.stringify(parsedIds));
  updateCartNum();
  updateCartBtn();
  console.log("Product ID added to the cart:", productId);

}

function removeFromCart(productId) {
  const cartIds = sessionStorage.getItem("nisargiCart101");
  const parsedIds = cartIds ? JSON.parse(cartIds) : [];
  const index = parsedIds.indexOf(productId);
  if (index > -1) {
    parsedIds.splice(index, 1);
    sessionStorage.setItem("nisargiCart101", JSON.stringify(parsedIds));
    updateCartNum();
    updateCartBtn();
    console.log("Product ID removed from the cart:", productId);
  } else {
    console.log("Product ID not found in the cart:", productId);
  }
}


document.addEventListener("DOMContentLoaded", function () {
  updateCartBtn();
});
