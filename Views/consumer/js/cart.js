function removeItem(productId) {
  const cartItems = getCookie("nisargiCart101");
  const parsedItems = cartItems ? JSON.parse(cartItems) : [];
  const updatedItems = parsedItems.filter(
      (item) => item.productId != productId
      );
  setCookie("nisargiCart101", JSON.stringify(updatedItems), 30);
  updateCartNum();
  location.reload();
  console.log("Product ID removed from the cart:", productId);
}
