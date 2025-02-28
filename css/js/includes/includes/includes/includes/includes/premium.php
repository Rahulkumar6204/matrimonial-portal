<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Features - Matrimonial Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Premium Features</h2>
        <p>Unlock enhanced matchmaking and profile boosts for just ₹499!</p>
        <button id="rzp-button">Buy Now</button>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('rzp-button').onclick = function (e) {
            var options = {
                "key": "your-razorpay-key", // Replace with your Razorpay API Key
                "amount": 49900, // Amount in paise (₹499 = 49900 paise)
                "currency": "INR",
                "name": "Matrimonial Portal",
                "description": "Premium Features",
                "image": "https://your-website.com/logo.png", // Replace with your logo
                "handler": function (response) {
                    alert("Payment successful! Payment ID: " + response.razorpay_payment_id);
                    // Save payment details to database
                    fetch('includes/payment_process.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            payment_id: response.razorpay_payment_id,
                            amount: 499,
                            user_id: <?php echo $_SESSION['user_id']; ?>
                        }),
                    });
                },
                "prefill": {
                    "name": "<?php echo $_SESSION['name']; ?>",
                    "email": "<?php echo $_SESSION['email']; ?>"
                },
                "theme": {
                    "color": "#007bff"
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
            e.preventDefault();
        };
    </script>
</body>
</html>
