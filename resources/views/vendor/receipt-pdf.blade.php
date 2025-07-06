<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Receipt</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafa;
            color: #2c3e50;
            padding: 50px 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 14px;
            padding: 40px 50px;
            border-top: 8px solid #07beb8;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        }

        h1 {
            text-align: center;
            color: #07beb8;
            font-size: 26px;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .section-title {
            margin-top: 30px;
            font-weight: 700;
            font-size: 17px;
            color: #34495e;
            border-bottom: 2px solid #eee;
            padding-bottom: 6px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 5px;
        }

        td.label {
            width: 40%;
            color: #2c3e50;
            font-weight: 600;
        }

        td.value {
            color: #555;
        }

        .note {
            margin-top: 25px;
            font-style: italic;
            color: #7f8c8d;
            font-size: 14px;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 13px;
            color: #999;
            border-top: 1px dashed #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h1>Payment Receipt</h1>

        @if(session('type') === 'stall')
            <div class="section-title">Stall Booking Summary</div>
            <table>
                <tr>
                    <td class="label">Vendor Name:</td>
                    <td class="value">{{ $vendor->shop_name }}</td>
                </tr>
                <tr>
                    <td class="label">Booking For:</td>
                    <td class="value">{{ $announcement?->title ?? 'N/A' }} Flea Market</td>
                </tr>
                <tr>
                    <td class="label">Amount Paid:</td>
                    <td class="value">KSh 1.00</td>
                </tr>
                <tr>
                    <td class="label">Booking Date:</td>
                    <td class="value">{{ \Carbon\Carbon::now()->toDateString() }}</td>
                </tr>
            </table>

            <p class="note">Please wait for admin confirmation. Your vendor status will be updated shortly. Thank you for your patience.</p>
        @else
            <div class="section-title">Product Purchase Summary</div>
            <table>
                <tr>
                    <td class="label">Product Name:</td>
                    <td class="value">{{ session('product_name') }}</td>
                </tr>
                <tr>
                    <td class="label">Quantity:</td>
                    <td class="value">{{ session('quantity') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Paid:</td>
                    <td class="value">KSh {{ session('total') }}</td>
                </tr>
                <tr>
                    <td class="label">Pickup Date:</td>
                    <td class="value">{{ session('pickup_date') }}</td>
                </tr>
            </table>
        @endif

        <div class="footer">
            This is an automated receipt generated on {{ now()->format('F j, Y') }}.<br>
            Thank you for supporting student entrepreneurship at our flea market!
        </div>
    </div>
</body>
</html>
