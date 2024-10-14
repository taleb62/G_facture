// SELECT ELEMENTS
const productsEl = document.querySelector(".products");
const cartItemsEl = document.querySelector(".cart-items");
const subtotalEl = document.querySelector(".subtotal");
const totalItemsInCartEl = document.querySelector(".total-items-in-cart");
const productsData = document.querySelector(".productsData");
const f_price = document.querySelector("#f_price");
const f_date = document.querySelector("#f_date");

localStorage.clear();
setTimeout(()=> localStorage.clear(), 10000) 


// RENDER PRODUCTS
function renderProdcuts() {
  products.forEach((product) => {
    productsEl.innerHTML += `
            <div class="item">
                <div class="item-container">
                    <div class="item-img">
                        <img src="../uploads/${product.imgSrc}" alt="${product.name}">
                    </div>
                    <div class="desc">
                        <h2>${product.name}</h2>
                        <h2><small>N-UM</small>${product.price}</h2>

                    </div>

                    <div class="add-to-cart" onclick="addToCart(${product.id})">
                        <img src="./icons/bag-plus.png" alt="add to cart">
                    </div>
                </div>
            </div>
        `;
  });
}
renderProdcuts();


// cart array
let cart = JSON.parse(localStorage.getItem("CART")) || [];
updateCart();

// ADD TO CART
function addToCart(id) {
  // check if prodcut already exist in cart
  
    if (cart.some((item) => item.id == id)) {
      // if(item.qnt > 0)
      changeNumberOfUnits("plus", id);
      
    } else {
      // if(item.qnt > 0){
        let item = products.find((product) => product.id == id);

        cart.push({
          ...item,
          numberOfUnits: 1,
        });
      // }
      // console.log(products.filter( (e) => e.id === 10));
    }
  
  updateCart();
}

// update cart
function updateCart() {
  renderCartItems();
  renderSubtotal();
  renderForme();

  // save cart to local storage
  localStorage.setItem("CART", JSON.stringify(cart));
}

// calculate and render subtotal
function renderSubtotal() {
  let totalPrice = 0,
    totalItems = 0;

  cart.forEach((item) => {
    totalPrice += item.price * item.numberOfUnits;
    totalItems += item.numberOfUnits;
  });

  subtotalEl.innerHTML = `Subtotal (${totalItems} items): $${totalPrice.toFixed(2)}`;
  totalItemsInCartEl.innerHTML = totalItems;
  f_price.value = totalPrice.toFixed(2);
  
}
// render cart items
function renderCartItems() {
  cartItemsEl.innerHTML = ""; // clear cart element
  cart.forEach((item) => {
    cartItemsEl.innerHTML += `
        <div class="cart-item">
            <div class="item-info" onclick="removeItemFromCart(${item.id})">
                <img src="../uploads/${item.imgSrc}" alt="${item.name}">
                <h4>${item.name}</h4>
            </div>
            <div class="unit-price">
                <small></small>${item.price}
            </div>
            <div class="units">
                <div class="btn minus" onclick="changeNumberOfUnits('minus', ${item.id})">-</div>
                <div class="number">${item.numberOfUnits}</div>
                <div class="btn plus" onclick="changeNumberOfUnits('plus', ${item.id})">+</div>           
            </div>
        </div>
      `;
  });
  console.log(cart);
  console.log("cart");
}

function renderForme() {
    productsData.innerHTML = ""; 
    cart.forEach((item) => {
      productsData.innerHTML += `
        <input type="text" name="p_id[]" value="${item.id}">
        <input type="text" name="p_name[]" value="${item.name}">
        <input type="text" name="p_price[]" value="${item.price}">
        <input type="text" name="p_qnt[]" value="${item.numberOfUnits}">
        <input type="text" name="p_total[]" value="${item.numberOfUnits * item.price}">
      `;

    });

}

// remove item from cart
function removeItemFromCart(id) {
  cart = cart.filter((item) => item.id != id);

  updateCart();
}

// change number of units for an item
function changeNumberOfUnits(action, id) {
  cart =  cart.map((item) => {
    let numberOfUnits = item.numberOfUnits;

    if (item.id == id) {
      if (action == "minus" && numberOfUnits > 1) {
        numberOfUnits--;
      } else if (action == "plus" && numberOfUnits < item.instock) {
        numberOfUnits++;
      }
    }

    return {
      ...item,
      numberOfUnits,
    };
  });

  updateCart();
}

