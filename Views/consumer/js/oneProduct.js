function decrement() {
  var incrPlace = document.getElementById("incrPlace");
  var currentValue = parseInt(incrPlace.innerHTML);

  if (currentValue > 1) {
    incrPlace.innerHTML = currentValue - 1;
  }
}

function increment() {
  var incrPlace = document.getElementById("incrPlace");
  var currentValue = parseInt(incrPlace.innerHTML);

  incrPlace.innerHTML = currentValue + 1;
}

function addToCart(productId, quantity, stock) {
  if(quantity>stock){
    openModal("Failed", "Invalid number to add", 1, 1.5, '');
    return;
  }

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


function updateCartBtn() {
  let btn = document.getElementById("addOneCart");
  let pQty = document.getElementById("incrPlace");
  let pStock = document.getElementById("pStock");

  cartCookie = getCookie("nisargiCart101");
  const parsedItems = cartCookie ? JSON.parse(cartCookie) : [];

  const productId = btn.name.replace("productBtn", "");
  const isProductInCart = parsedItems.some(
    (item) => item.productId === productId
  );


  if (isProductInCart) {
    btn.classList.add("inCart");
    btn.textContent = "Remove from Cart";
    btn.onclick = () => removeFromCart(productId);
} else {
    btn.classList.remove("inCart");
    btn.textContent = "Add to Cart";
    btn.onclick = () => addToCart(productId, parseInt(pQty.innerHTML), parseInt(pStock.innerHTML));
  }
}


document.addEventListener("DOMContentLoaded", function () {
    updateCartBtn();
});
