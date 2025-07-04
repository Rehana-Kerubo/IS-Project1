<!DOCTYPE html>
<html>
<head>
    <title>Booking Receipt</title>
    <style>
        body { font-family: sans-serif; }
        .invoice {
            padding: 20px;
            border: 1px solid #ccc;
            width: 100%;
        }
        .title { text-align: center; margin-bottom: 20px; }
        .field { margin: 8px 0; }
    </style>
</head>
<body>
    <div class="invoice">
        <h2 class="title">🎉 Payment Receipt</h2>
        <p class="field"><strong>Product:</strong> {{ session('product_name') }}</p>
        <p class="field"><strong>Quantity:</strong> {{ session('quantity') }}</p>
        <p class="field"><strong>Total Paid:</strong> KSh {{ number_format(session('total')) }}</p>
        <p class="field"><strong>Total Product Price:</strong> KSh {{ number_format(session('full_price')) }}</p>
        <p class="field"><strong>Remaining Balance:</strong> KSh {{ number_format(session('full_price') - session('total')) }}</p>
        <!-- <p class="field"><strong>Pickup Date:</strong> {{ session('pickup_date') }}</p> -->
        <p class="field"><strong>Shop Name:</strong> {{ session('shop_name') }}</p>
        <p class="field"><strong>Stall Number:</strong> {{ session('stall_number') }}</p>
    </div>
</body>
</html>
