<!DOCTYPE html>
<html>
    <head><title>Hertz-UTS</title></head>
    <link rel="stylesheet" href="style.css">
    <body>
        <header>
            <div align="center"><h2 style="color:#fff;">Car Rental Center</h2></div>
        </header>

        <h2 style="text-align: center;">Checkout</h2><br>
        <form onSubmit="book(); return false;">
            <h3>Customer Details and Payment</h3>
            <div style="display:flex;">
                <p>Please fill in your details.</p>
                <p style="color:red;">&nbsp;*&nbsp;</p>
                <p>indicates required field.</p>
            </div>
            <div class="checkout-form">
                <div>
                    <label for="fname" class="required"><i class="fa fa-user"></i>First Name</label>
                    <input type="text" id="fname" name="firstname" required>
                </div>
                <div>
                    <label for="fname" class="required"><i class="fa fa-user"></i>Last Name</label>
                    <input type="text" id="lname" name="lastname" required>
                </div>
                <div>
                    <label for="email" class="required"><i class="fa fa-envelope"></i>Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="adr1" class="required"><i class="fa fa-address-card-o"></i>Address Line 1</label>
                    <input type="text" id="adr1" name="address" required>
                </div>
                <div>
                    <label for="adr2"><i class="fa fa-address-card-o"></i>Address Line 2</label>
                    <input type="text" id="adr2" name="address">
                    <label for="city" class="required"><i class="fa fa-institution"></i>City</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div>
                    <label for="state" class="required">State</label>
                    <select name="state" id="state">
                      <option value="nsw">NSW</option>
                      <option value="qld">QLD</option>
                      <option value="sa">SA</option>
                      <option value="tas">TAS</option>
                      <option value="vic">VIC</option>
                      <option value="wa">WA</option>
                      <option value="nt">NT</option>
                      <option value="act">ACT</option>
                    </select>
                </div>
                <div>
                    <label for="zip" class="required">Post Code</label>
                    <input type="text" id="zip" name="zip" required>
                </div>
                <div>
                    <label for="state" class="required">Payment Type</label>
                    <select name="state" id="state">
                      <option value="visa">Visa</option>
                      <option value="mastercard">Mastercard</option>
                      <option value="amex">AMEX</option>
                    </select>
                </div>
            </div>
            <div>
               <br><h3 style="text-align: left" id="price"></h3>
               <button class="button button-right" id="btn" onClick="redirect()">Continue Selection</button>
               <input type="submit" value="Booking" class="button button-right" id="btn">
            </div>
        </form>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    let cart;
    $(document).ready(function() {
        let total_price = window.sessionStorage.getItem("price");
        $("#price").append(`<h3>You are required to pay $${total_price}</h3>`);
    });
        
    function redirect(){
        window.location.href = "/"
    }
        
    function book() {
        let regex = /\S+@\S+\.\S+/;
        let email = document.getElementById("email").value;
        if(regex.test(email)) {
            alert("Purchase is Successful!");
            window.location.href = "/";
            window.sessionStorage.clear();
        } else {
            alert("Please enter a valid email address!");
        }
    }
    </script>
</html>