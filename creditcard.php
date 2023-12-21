<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Form</title>
    <!-- Bootstrap CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        #credit-card-form {
            background-color: #f7f7f7;
            width: 550px;
            height: 390px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 222px;
            border-radius: 9px;
            cursor: pointer;
            }
    </style>
</head>
<body>
    <!-- Credit Card Form -->
    <section id="credit-card-form" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <br>
                <h2>Payment</h2>
                <form id="creditCardForm">
                    <div class="form-group">
                        <label for="cardName">Name on Card:</label>
                        <input type="text" class="form-control" id="cardName" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="cardNumber">Card Number:</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 1234 5678" maxlength="19" required>
                    </div>
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date:</label>
                        <input type="month" class="form-control" id="expiryDate" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="number" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
                    </div>
                    <br>
                    <input type='submit' name='submit' value='Checkout' class='btn btn-primary'>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() 
        {
            $('#creditCardForm').submit(function(e) {
                e.preventDefault();
                alert('Credit card details submitted successfully!');
            });

            // Dynamic formatting for card number input.
            $("#cardNumber").on("keyup", function() {
                let value = $(this).val().replace(/\W/gi, '').replace(/(.4)/g, '$1 ');
                $(this).val(value.trim());
            });
        });
    </script>
</body>
</html>
