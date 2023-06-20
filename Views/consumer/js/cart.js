function removeItem(productId, time) {
  const cartItems = getCookie("nisargiCart101");
  const parsedItems = cartItems ? JSON.parse(cartItems) : [];
  const updatedItems = parsedItems.filter(
    (item) => item.productId != productId
  );
  setCookie("nisargiCart101", JSON.stringify(updatedItems), 30);
  updateCartNum();
  console.log("Product ID removed from the cart:", productId);

  location.reload();
}

function getDefaultAddress() {
  const cookieValue = getCookie("defaultNisargiAddress");
  if (cookieValue) {
    const addressData = {};
    const keyValuePairs = cookieValue.split(", ");
    keyValuePairs.forEach((pair) => {
      const [key, value] = pair.split("=>");
      addressData[key] = value;
    });
    return addressData;
  }
  return null;
}

function assignDefaultAddress(){
  const checkBox = document.getElementById('defaultAddressCheckbox')
  const fname = document.querySelector('input[name="full-name"]');
  const city = document.querySelector('input[name="city"]');
  const street = document.querySelector('input[name="street"]');
  const mobile = document.querySelector('input[name="mobile"]');
  if(checkBox.checked){
    const defaultAddress = getDefaultAddress();
    if (defaultAddress) {
      console.log(defaultAddress, defaultAddress.street);
      fname.value = defaultAddress.fname;  // Access the field values by their names
      city.value = defaultAddress.city;
      mobile.value = defaultAddress.mobile;
      street.value = defaultAddress.street;
      checkBox.checked = false;

    }else{
      openModal("Failed", "default address not found", 1, 1.5, "");
      checkBox.checked = false;
    }
  }
}

function setDefaultAddress() {
  const fname = document.querySelector('input[name="full-name"]');
  const city = document.querySelector('input[name="city"]');
  const street = document.querySelector('input[name="street"]');
  const mobile = document.querySelector('input[name="mobile"]');

  if (
    fname.value.length < 1 ||
    city.value.length < 1 ||
    mobile.value.length < 1 ||
    street.value.length < 1
  ) {
    openModal("Failed", "none fields can be empty", 1, 1.5, "");
    return;
  }

  const cookieValue = `fname=>${fname.value}, city=>${city.value}, street=>${street.value}, mobile=>${mobile.value}`;
  try {
    setCookie("defaultNisargiAddress", cookieValue);
    openModal("Success", "Default address set.", 0, 1.5, "");
  } catch (error) {
    openModal("Error", "Failed to set default address.", 1, 1.5, "");
  }
}


function getFormData() {
  const fname = document.querySelector('input[name="full-name"]').value;
  const city = document.querySelector('input[name="city"]').value;
  const street = document.querySelector('input[name="street"]').value;
  const mobile = document.querySelector('input[name="mobile"]').value;
  const message = document.querySelector('textarea[name="message"]').value;

  let formData = {
    fname: fname,
    city: city,
    street: street,
    mobile: mobile,
    message: message
  };
  return formData;
}
