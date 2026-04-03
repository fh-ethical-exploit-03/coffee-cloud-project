<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee shop website</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-------------------------------- header section starts ---------------------------------->

    <header class="header">

        <a href="#" class="logo">
            <img src="images/logo.png" alt="">
        </a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
            <!-- <a href="#review">review</a>
            <a href="#contact">contact</a> -->
        </nav>

        <div class="icons">
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <div class="cart-items-container">
            <button class="btn" onclick="openModal1()">Checkout now</button>
        </div>

        <!-- <button class="btn">Checkout now</button> -->
        <!-- <a href="#" class="btn">Checkout now</a> -->
        </div>

    </header>

    <!-------------------------------- header section ends ---------------------------------->

    <!------------------------------------- home section starts --------------------------------->

    <section class="home" id="home">

        <div class="content">
            <h3>MAGIC SIP CAFE</h3>
            <p>Coffee is a beverage brewed from the roasted
                and ground seeds of the tropical evergreen coffee plant.</p>
            <a href="#menu" class="btn">Order now</a>
        </div>

    </section>

    <!------------------------------------- home section ends ------------------------------------->

    <!------------------------------------- about section starts ----------------------------------->

    <section class="about" id="about">

        <h1 class="heading"> <span>about</span> us </h1>

        <div class="row">

            <div class="image">
                <img src="images/about-img.jpeg" alt="">
            </div>

            <div class="content">
                <h3>what makes our coffee special?</h3>
                <p>Welcome to Café Perfection, where coffee is not just a beverage but a work of art! Our commitment to
                    providing the finest coffee experience sets us apart from the rest.
                </p>
                <a href="#" class="btn">learn more</a>
            </div>

        </div>

    </section>

    <!------------------------------------- about section ends ------------------------------------->



    <!----------------------------------   menu section starts ------------------------------------->

    <section class="menu" id="menu">

        <h1 class="heading"> our <span>menu</span> </h1>

        <div class="box-container">
            <?php
            $servername = "localhost";
            $username = "atharv";
            $password = "atharv09";
            $dbname = "coffees";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM coffee";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="box">
                        <img src="uploads/' . $row["image"] . '" alt="">
                        <h3>' . $row["name"] . '</h3>
                        <div class="price">' . $row["discount_price"] . ' <span>' . $row["price"] . '</span></div>
                        <a href="#" class="btn">add to cart</a>
                    </div>';
                }
            } else {
                echo '<div style="text-align: center; color: #666; font-size: 40px; font-weight: bold;">No items available</div>';
            }
            ?>

            
        </div>
        <div id="button1">
            <center>
                <button class="plus-btn" onclick="openModal()">+</button>
            </center>
        </div>
        
    </section>

    <!---------------------------------- AddCoffee Modal ------------------------------------>
    <?php
    // include 'addItem.php';
    ?>
    <div id="Modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add Coffee</h2>
            <form id="addCoffeeForm" action="addItem.php" method="post" enctype="multipart/form-data">
                <label for="coffeeName">Coffee Name:</label>
                <input type="text" id="coffeeName" name="coffeeName" required><br><br>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required><br><br>
                <label for="discountedPrice">Discounted Price:</label>
                <input type="text" id="discountedPrice" name="discountedPrice" required><br><br>
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                <input type="submit" value="Add Coffee">
            </form>
        </div>
    </div>

    <!------------------------------- Checkout Butoon Modal ------------------------------------>
    <?php
    // include 'checkout.php';
    ?>
    <div id="myModal" class="modal1">

        <div class="modal-content1">
            <span class="close1" onclick="closeModal1()">&times;</span>
            <h2>Checkout</h2>
            <form id="checkoutForm" action="checkout.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required><br><br>
                <label for="payment">Payment Type:</label>
                <select id="payment" name="payment" required>
                    <option value="">Select payment type</option>
                    <option value="credit">Credit Card</option>
                    <option value="debit">Debit Card</option>
                    <option value="paypal">PayPal</option>
                </select><br><br>
                <table id="cartItems">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table><br>
                <input type="submit" value="Submit" onclick="onCheckOutOnClick">
            </form>
        </div>
    </div>
    <div id="toastNotification"><p id="text"></p></div>
    <!---------------------------------- footer section starts ------------------------------->

    <section class="footer">

        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
        </div>

        <div class="links">
            <a href="#">home</a>
            <a href="#">about</a>
            <a href="#">menu</a>
            <a href="#">review</a>
            <a href="#">contact</a>
        </div>

        <div class="credit">created by <span>ATHARV | RASHI</span> | </div>

    </section>

    <!---------------------------------- footer section ends ------------------------------------>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>