<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fbfc;
            color: #333;
            margin: 0;
            padding: 40px;
        }

        .invoice-box {
            max-width: 750px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            border-top: 6px solid #07beb8;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #07beb8;
            font-size: 28px;
            margin: 0;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .info-table td {
            padding: 8px 0;
        }

        .info-table td:first-child {
            font-weight: 600;
            color: #1e5c5c;
            width: 220px;
        }

        .total-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .total-table th,
        .total-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .total-table th {
            background-color: #07beb8;
            color: white;
        }

        .total-table td.label {
            font-weight: 600;
            color: #1e5c5c;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        @media print {
            body {
                padding: 0;
                background: none;
            }

            .invoice-box {
                box-shadow: none;
                border: none;
                padding: 0;
            }

            .footer {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>Payment Receipt</h1>
        </div>

        <table class="info-table">
            <tr>
                <td>Customer Name:</td>
                <td>{{ session('buyer_name') }}</td>
            </tr>
            <tr>
                <td>Product Name:</td>
                <td>{{ session('product_name') }}</td>
            </tr>
            <tr>
                <td>Quantity Purchased:</td>
                <td>{{ session('quantity') }}</td>
            </tr>
            <tr>
                <td>Shop Name:</td>
                <td>{{ session('shop_name') }}</td>
            </tr>
            <tr>
                <td>Stall Number:</td>
                <td>{{ session('stall_number') }}</td>
            </tr>
        </table>

        <table class="total-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label">Full Product Price</td>
                    <td>Ksh. {{ number_format(session('full_price')) }}</td>
                </tr>
                <tr>
                    <td class="label">Amount Paid</td>
                    <td style="color: rgb(60, 144, 21)">Ksh. {{ number_format(session('total')) }}</td>
                </tr>
                <tr>
                    <td class="label">Outstanding Balance</td>
                    <td style="color: rgb(177, 32, 54)">Ksh. {{ number_format(session('full_price') - session('total')) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Thank you for your payment!
        </div>
    </div>
</body>
</html>
