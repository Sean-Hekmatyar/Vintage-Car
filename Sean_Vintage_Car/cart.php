<!DOCTYPE html>
<html>
    <head><title>Hertz-UTS</title></head>
    <link rel="stylesheet" href="style.css">
    <body>
        <header>
                <div align="center"><h2 style="color:#fff;">Car Rental Center</h2></div>
        </header>
        <div class="container">
            <h2 style="text-align: center;">Car Reservation</h2><br>
            <table class="reservelist">
                <th>Thumbnail</th>
                <th>Vehicle</th>
                <th>Price Per Day</th>
                <th>Rental Days</th>
                <th>Actions</th>
            </table>
        </div>
        <div>
            <button class="button button-right" id="btn" onClick="checkout()">Processing in Checkout</button>
        </div>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    let cart_arr = 0;
    let totalPrice = 0;
    $(document).ready(function() {
        //Get sessionStorage
        cart_arr = JSON.parse(window.sessionStorage.getItem("cart"));
        $.each(cart_arr, function(i, field) {
            let carComponent = 
            `
            <tr id="${field.id}">
                <td>
                    <img style="width:200px;height:150px;" src=${field.img} alt="${field.brand} ${field.model}">
                </td>
                <td style="width:200px;">${field.brand}-${field.model}-${field.model_year}</td>
                <td>${field.price_per_day}</td>
                <td>
                    <input id="item-${field.id}" type="number" min="0" value="1" style="text-align: center;" class="items"></input>
                </td>
                <td >
                    <button class="button" id="btn" onclick="removeCar(${field.id})">Delete</button>
                </td>
            </tr>
            `
            $(".reservelist").append(carComponent);
            if(cart_arr.length > 0) {
                $(".checkout-button").append(`<button class="button button-add" onClick="checkout()">Checkout</button>`);
            }
        });
    });
    
    function checkout() {
        //If there is no car in cart, display alert message
        if(cart_arr.length <= 0) {
            alert("No car has been reserved!");
            //Return to homepage
            window.location.href = "index.php";
        } else {
            var price = 0;
            let items = document.getElementsByClassName("items");
            let rentalDay = validate(items);
            if(rentalDay) {
                console.log("price");
                price = calculatePrice(items);
                //Set total price
                window.sessionStorage.setItem("price", price);
                window.location.href = "checkout.php";
            }
        }
    }
        
    function validate(input) {
        var state = true;
        $.each(input, function(i, item) {
            if(item.value <= 0 || item.value.length == 0) {
                alert("Please enter a valid number of rental days.");
                state = false;
            } else {
                state = true;
            }
        });
        return state;
    }
    
    function calculatePrice(price) {
        let totalPrice = 0;
        $.each(price, function(i, item) {
        //Get car id
        let id = item.id.split('-')[1];
        //Check if car in cart
        let car = cart_arr.find(car => car.id == id);
        let days = parseInt(item.value);
        let dailyPrice = parseInt(car.price_per_day);
        totalPrice += days * dailyPrice;
        });
        return totalPrice;
    }
    
    function removeCar(id) {
        //Filt removed car
        cart_arr = cart_arr.filter(car => car.id != id);
        //Reset storage
        window.sessionStorage.setItem("cart", JSON.stringify(cart_arr));
        //Remove from cart
        document.getElementById(`${id}`).remove();
    }
    </script>
</html>