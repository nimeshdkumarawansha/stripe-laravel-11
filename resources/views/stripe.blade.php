<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stripe Payment Gateway</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style type="text/css">
		body {
			background-color: #f7f9fc;
			font-family: 'Arial', sans-serif;
		}
		.card {
			margin-top: 50px;
			border: none;
			border-radius: 15px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			background-color: #ffffff;
		}
		.card-header {
			background-color: #4CAF50;
			color: white;
			font-weight: bold;
			font-size: 24px;
			text-align: center;
			border-top-left-radius: 15px;
			border-top-right-radius: 15px;
		}
		.form-control {
			border-radius: 8px;
			padding: 12px;
			font-size: 16px;
			margin-bottom: 20px;
		}
		#card-element {
			height: 50px;
			padding-top: 16px;
			border: 1px solid #ced4da;
			border-radius: 8px;
		}
		#pay-btn {
			width: 100%;
			padding: 12px;
			font-size: 18px;
			font-weight: bold;
			background-color: #28a745;
			color: white;
			border: none;
			border-radius: 8px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}
		#pay-btn:hover {
			background-color: #218838;
		}
		.loader {
			display: none;
			border: 4px solid #f3f3f3;
			border-radius: 50%;
			border-top: 4px solid #3498db;
			width: 40px;
			height: 40px;
			animation: spin 1s linear infinite;
			margin: 0 auto;
		}
		@keyframes spin {
			0% { transform: rotate(0deg); }
			100% { transform: rotate(360deg); }
		}
		#processing-message {
			text-align: center;
			margin-top: 10px;
			font-weight: bold;
			display: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card">
					<h3 class="card-header">Secure Payment</h3>
					<div class="card-body p-4">
						@session('success')
						<div class="alert alert-success" role="alert"> 
							{{ $value }}
						</div>
						@endsession
						<form id='checkout-form' method='post' action="{{ route('stripe.post') }}">
							@csrf    
							<strong>Name:</strong>
							<input type="input" class="form-control" name="name" placeholder="Enter your name" required>
							<input type='hidden' name='stripeToken' id='stripe-token-id'>
							<strong>Card Details:</strong>
							<div id="card-element" class="form-control"></div>
							<div class="loader mt-4" id="loader"></div>
							<p id="processing-message">Processing your payment...</p>
							<button 
								id='pay-btn'
								class="btn btn-success mt-3"
								type="button"
								onclick="createToken()">Pay $10
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
		var stripe = Stripe('{{ env('STRIPE_KEY') }}');
		var elements = stripe.elements();
		var cardElement = elements.create('card');
		cardElement.mount('#card-element');

		function createToken() {
			document.getElementById("pay-btn").disabled = true;
			document.getElementById("loader").style.display = 'block';
			document.getElementById("processing-message").style.display = 'block';
			
			stripe.createToken(cardElement).then(function(result) {
				if (result.error) {
					document.getElementById("pay-btn").disabled = false;
					document.getElementById("loader").style.display = 'none';
					document.getElementById("processing-message").style.display = 'none';
					alert(result.error.message);
				}

				if (result.token) {
					document.getElementById("stripe-token-id").value = result.token.id;
					document.getElementById('checkout-form').submit();
				}
			});
		}
	</script>
</body>
</html>
