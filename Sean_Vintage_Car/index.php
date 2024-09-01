<!DOCTYPE html>
<html>
    <head><title>Hertz-UTS</title></head>
    <link rel="stylesheet" href="style.css">
    <body>
        <header>
            <div class="inner">
                <div><h1 style="color: yellow;">Hertz-UTS</h1></div>
                <div align="center"><h2 style="color:#fff;">Car Rental Center</h2></div>
                <div><button class="button button-reservation" onClick=cart()>Car Reservation</button></div>
            </div>
        </header>
		<div class="main"></div>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    //Store cars.json
    let car_arr = [];
    //Store car to cart
    let cart_arr = [];
    if(window.sessionStorage.getItem("cart")) {
        cart_arr = JSON.parse(window.sessionStorage.getItem("cart"));
    }
    $(document).ready(function() {
        $.getJSON("cars.json", function(result) {
            car_arr = result;
            $.each(result, function(i, field) {
                let carComponent = 
                `
                <div class="card card-1">
                <div class="car-img-container"><img style="width:350px;height:350px;" src=${field.img} alt="${field.brand} ${field.model}"></div>
                <h2>${field.brand}-${field.model}-${field.model_year}</h2><br>
                <p><b>mileage: </b>${field.mileage} kms</p>
                <p><b>fuel_type: </b>${field.fuel_type}</p>
                <p><b>seats: </b>${field.seats}</p>
                <p><b>Price_per_day: </b>${field.price_per_day}</p>
                <p><b>availability: </b>${field.availability}</p>
                <br>
                <p><b>Description: </b>${field.description}</p>
                <br>
                <button class="button button-add" onClick="addCar(${field.id})">Add to cart</button>
                </div>
                `
                $(".main").append(carComponent);
            });
        });
    });
        
    function addCar(id) {
        //Find car in cars.json
        let car = car_arr.find(car => car.id == id);
        //Find car in cart
        let car_in_cart = cart_arr.find(car => car.id == id);
        if (car_in_cart) {
            alert(`Sorry, ${car.brand}-${car.model}-${car.model_year} is already in your cart!`);
            } else if (car.availability == "False") {
                alert(`Sorry, ${car.brand}-${car.model}-${car.model_year} is not available now. Please try other cars!`);
            } else {
                cart_arr.push(car);
                alert(`${car.brand}-${car.model}-${car.model_year} is now added in your cart!`);
            }
            return true;
        }
        
        function cart() {
            //
            let cart_json = JSON.stringify(cart_arr); //convert cart_array into string
            window.sessionStorage.setItem("cart", cart_json); //set storage
            window.location.href="cart.php";
        }
        
        function checkCart(){
        //Convert cart_arr into string and set storage
        window.sessionStorage.setItem("cart", JSON.stringify(cart_arr));
        window.location.href="cart.php";
        }
	</script>
</html>