<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Form</title>
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
    <script>
        function validateForm() {
            var validCardName = 'Zavier Ong';
            var validCardNumber = '1234567812345678'; // Not the actual length of a credit card number
            var validExpiryDate = 'February, 2025'; // Format to match your input
            var validCvv = '888';

            var enteredCardName = document.getElementById('cardName').value;
            var enteredCardNumber = document.getElementById('cardNumber').value;
            var enteredExpiryDate = document.getElementById('expiryDate').value;
            var enteredCvv = document.getElementById('cvv').value;

            var validationMessage = document.getElementById('validationMessage');

            if (
                enteredCardName === validCardName &&
                enteredCardNumber === validCardNumber &&
                enteredExpiryDateFormatted === validExpiryDate &&
                enteredCvv === validCvv
            ) {
                validationMessage.innerHTML = 'Payment successful!';
                validationMessage.style.color = 'green';
                return true; // Allows the form to submit
            } else {
                validationMessage.innerHTML = 'Payment unsuccessful. Please re-enter correct card details.';
                validationMessage.style.color = 'red';
                return false; // Prevents the form from submitting
            }
        }
    </script>
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
                        <input type="month" class="form-control" id="expiryDate" required 
                            min="<?php echo date('Y-m'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="number" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
                    </div>
                    <br>
                    <input type='submit' name='submit' value='Checkout' class='btn btn-primary' onclick="return validateForm()">
                    <p id="validationMessage" style="margin-top: 10px;"></p>                
                </form>
            </div>
        </div>
    </section>
</body>
</html>
