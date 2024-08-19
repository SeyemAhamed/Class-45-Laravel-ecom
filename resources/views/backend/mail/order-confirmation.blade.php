<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ecommerce.com</title>
</head>
<body>
    <p>
        Your order has been deilivered to the {{$order->courier_name}} courier!!
    </p>
    <h1>
        OrderId: {{$order->invoiceId}}
    </h1>
</body>
</html>