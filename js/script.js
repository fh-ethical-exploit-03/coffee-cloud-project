let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    // searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}


let cartItem = document.querySelector('.cart-items-container');

document.querySelector('#cart-btn').onclick = () => {
    cartItem.classList.toggle('active');
    navbar.classList.remove('active');
    // searchForm.classList.remove('active');
}

window.onscroll = () => {
    navbar.classList.remove('active');
    // searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}



// document.addEventListener("DOMContentLoaded", function () {
//     // Other existing code...

//     // Clear existing cart items when the page is loaded
//     clearCart();

//     // Other existing code...
// });

// document.querySelector('#cart-btn').onclick = () => {
//     // Show the cart items when the cart button is clicked
//     cartItem.classList.toggle('active');
//     navbar.classList.remove('active');
//     searchForm.classList.remove('active');
//     // Clear existing cart items when the cart button is clicked
//     clearCart();
// };

// function clearCart() {
//     // Remove all cart items from the cartItemsContainer
//     const cartItems = document.querySelectorAll('.cart-items-container .cart-item');
//     cartItems.forEach(item => {
//         item.remove();
//     });

//     // Clear the cartItemsMap
//     cartItemsMap.clear();

//     // Perform any other necessary actions after clearing the cart
// }






// Wait for the document to be fully loaded before running the JavaScript code
// document.addEventListener('DOMContentLoaded', function () {
//     // Select the "add to cart" buttons
//     const addToCartButtons = document.querySelectorAll('.menu .box a.btn');

//     // Select the cart container
//     const cartContainer = document.querySelector('.cart-items-container');

//     // Select the checkout button
//     const checkoutButton = document.querySelector('.cart-items-container .btn');

//     // Add a click event listener to each "add to cart" button
//     addToCartButtons.forEach(button => {
//         button.addEventListener('click', addToCart);
//     });

//     // Function to handle adding items to the cart
//     function addToCart(event) {
//         // Prevent the default form submission
//         event.preventDefault();

//         // Get the selected item details
//         const box = event.target.closest('.box');
//         const itemName = box.querySelector('h3').textContent;
//         const itemPrice = box.querySelector('.price').textContent;

//         // Create a new cart item element
//         const cartItem = document.createElement('div');
//         cartItem.classList.add('cart-item');
//         cartItem.innerHTML = `
//             <span class="fas fa-times"></span>
//             <img src="${box.querySelector('img').src}" alt="">
//             <div class="content">
//                 <h3>${itemName}</h3>
//                 <div class="price">${itemPrice}</div>
//             </div>
//         `;

//         // Append the new cart item to the cart container
//         cartContainer.appendChild(cartItem);

//         // Update the cart total (you may need to implement this based on your requirements)
//         updateCartTotal();
//     }

//     // Function to update the cart total
//     function updateCartTotal() {
//         // You can implement this based on your requirements
//         // For example, you can calculate the total price of all items in the cart
//         // and update a total element in your HTML.
//     }

//     // Example: Add a click event listener to the checkout button
//     checkoutButton.addEventListener('click', function () {
//         // Implement your checkout logic here
//         // For example, you can redirect to a checkout page or show a modal
//         console.log('Checkout button clicked');
//     });
// });






/*------------------Checkout Button Modal-----------------*/
document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.menu .box a.btn');
    const cartContainer = document.querySelector('.cart-items-container');
    const checkoutButton = document.createElement('a');
    checkoutButton.className = "btn checkout-btn";
    checkoutButton.textContent = "Checkout now";

    checkoutButton.addEventListener('click', function () {
        cartContainer.style.display = 'none';
    });

    const cartItems = [];

    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    function addToCart(event) {
        event.preventDefault();
        const box = event.target.closest('.box');
        const itemName = box.querySelector('h3').textContent;
        const itemPrice = box.querySelector('.price').textContent;
        const coffeeImage = box.querySelector('img').src;
        const price = itemPrice.split(' ')[0];
        const existingItem = cartItems.find(item => item.name === itemName);

        if (existingItem) {
            existingItem.quantity++;
        } else {
            const newItem = {
                name: itemName,
                price: price,
                imagePath: coffeeImage,
                quantity: 1
            };
            cartItems.push(newItem);
        }

        updateCart();
    }

    function updateCart() {
        cartContainer.innerHTML = '';

        cartItems.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
        
            const price = item.price;
            const coffeeName = item.name;
            const quantity = item.quantity;
        
            cartItem.innerHTML = `
                <span class="fas fa-times"></span>
                <img src="${item.imagePath}" alt="">
                <div class="content">
                    <h3>${coffeeName}</h3>
                    <div class="price">${price} x ${quantity}</div>
                </div>
            `;
        
            cartContainer.appendChild(cartItem);
        });
        

        if (cartItems.length > 0) {
            cartContainer.appendChild(checkoutButton);
        }
    }

    function getImageSource(itemName) {
        return `${itemName}.png`;
    }

    cartContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('checkout-btn')) {
            openModal1();
        }
    });

    function openModal1() {
        const modal = document.getElementById('myModal');
        modal.style.display = 'block';
        populateCartItems(cartItems);
    }

    function closeModal1() {
        const modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    // document.getElementById('checkoutForm').addEventListener('submit', (e)=> {
    //     closeModal1();
    // });

    document.getElementById('checkoutForm').addEventListener('submit', function (event) {
        // Simulating order placement success/failure
        const orderPlacedSuccessfully = true; // Set to true for success, false for failure
        console.log("Order placed successfully");
        // Show toast notification based on order placement result
        const toastNotification = document.getElementById('text');
        if (orderPlacedSuccessfully) {
            toastNotification.textContent = 'Order Placed Successfully';
            toastNotification.style.backgroundColor = 'green';
        } else {
            toastNotification.textContent = 'Failed to Place Order';
            toastNotification.style.backgroundColor = 'red';
        }
    
        // Show toast notification for 2 seconds
        toastNotification.style.display = 'block';
        setTimeout(function () {
            toastNotification.style.display = 'none';
        }, 2000);
        closeModal1();
    });

    function onCheckOutOnClick(){
        console.log("Checkout");
    }

    function populateCartItems(cart) {
        document.cookie = `cart=${JSON.stringify(cart)}`;
        const cartTable = document.getElementById('cartItems').querySelector('tbody');
        cartTable.innerHTML = '';

        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.price}</td>
            `;
            cartTable.appendChild(row);
        });
    }
});



/*------------------Update Menu Modal-----------------*/
function openModal2() {
    const modal = document.getElementById('MyModal');
    modal.style.display = 'block';
}

// Close modal
function closeModal2() {
    const modal = document.getElementById('MyModal');
    modal.style.display = 'none';
}

// Add button event listener
const addButtons1 = document.querySelectorAll('.plus-btn1');
addButtons1.forEach(button => {
    button.addEventListener('click', () => {
        openModal2();
    });
});

// Submit form event listener
document.getElementById('updateCoffeeForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission for now
    // You can add logic here to handle form submission, e.g., adding the coffee to the menu
    closeModal2(); // Close the modal after form submission
    alert('Coffee updated successfully!');
});





/*------------------Add Menu Modal-----------------*/
function openModal() {
    const modal = document.getElementById('Modal');
    modal.style.display = 'block';
}

// Close modal
function closeModal() {
    const modal = document.getElementById('Modal');
    modal.style.display = 'none';
}

// Add button event listener
const addButtons = document.querySelectorAll('.plus-btn');
addButtons.forEach(button => {
    button.addEventListener('click', () => {
        openModal();
    });
});

// Submit form event listener
document.getElementById('addCoffeeForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission for now
    // You can add logic here to handle form submission, e.g., adding the coffee to the menu
    closeModal(); // Close the modal after form submission
    alert('Coffee added successfully!');
});

