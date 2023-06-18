let products = document.getElementsByClassName("one-product");
let productsBtn = document.getElementsByClassName("productBtn");

function updateCartBtn() {
  const cartItems = getCookie("nisargiCart101");
  const parsedItems = cartItems ? JSON.parse(cartItems) : [];

  Array.from(productsBtn).forEach((btn) => {
    const productId = btn.id.replace("productBtn", "");
    const isProductInCart = parsedItems.some(item => item.productId === productId);
    
    if (isProductInCart) {
      btn.classList.add("inCart");
      btn.textContent = "Remove from Cart";
      btn.onclick = () => removeFromCart(productId);
    } else {
      btn.classList.remove("inCart");
      btn.textContent = "Add to Cart";
      btn.onclick = () => addToCart(productId, 1);
    }
  });
}

function addToCart(productId, quantity) {
  const cartItems = getCookie("nisargiCart101");
  const parsedItems = cartItems ? JSON.parse(cartItems) : [];
  parsedItems.push({ productId, quantity });
  setCookie("nisargiCart101", JSON.stringify(parsedItems), 30);
  updateCartNum();
  updateCartBtn();
  console.log("Product added to the cart:", { productId, quantity });
}

function removeFromCart(productId) {
  const cartItems = getCookie("nisargiCart101");
  const parsedItems = cartItems ? JSON.parse(cartItems) : [];
  const updatedItems = parsedItems.filter(item => item.productId !== productId);
  setCookie("nisargiCart101", JSON.stringify(updatedItems), 30);
  updateCartNum();
  updateCartBtn();
  console.log("Product ID removed from the cart:", productId);
}

document.addEventListener("DOMContentLoaded", function () {
  updateCartBtn();
});
