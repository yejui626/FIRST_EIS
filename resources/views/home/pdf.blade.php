<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice - TSK Synergy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-details {
            margin-bottom: 40px;
        }

        .invoice-details p {
            margin: 0;
        }

        .invoice-number {
            font-weight: bold;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .invoice-total {
            text-align: right;
        }

        .thank-you {
            text-align: center;
            font-weight: bold;
        }

        .company-address {
            margin-bottom: 10px;
        }

        .company-phone {
            font-weight: bold;
        }

        .receipt-details {
            margin-bottom: 40px;
        }

        .receipt-details p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="header">
            <h1 class="company-name">TSK Synergy</h1>
        </div>

        <div class="company-address">
            <p>19 & 21 Jalan Mega 1/8,</p>
            <p>Taman Perindustrian Nusa Cemerlang</p>
            <p>79200 Iskandar Puteri, Johor.</p>
        </div>

        <div class="company-phone">
            <p>Phone: 011 3935 7998</p>
        </div>

        <div class="receipt-details">
            <p>Receipt Number: <span class="receipt-number">{{$receiptNumber}}</span></p>
            <p>Date: <?php echo date('Y-m-d'); ?></p>
        </div>

        <table class="invoice-table">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price(RM)</th>
                <th>Total(RM)</th>
            </tr>
            @php
            $totalPrice = 0.00;
            @endphp

            @foreach ($cart as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_quantity }}</td>
                <td>{{ $item->product_price }}</td>
                <td>{{ number_format($item->product_quantity * $item->product_price,2 )}}</td>
                @php
                $totalPrice += $item->product_quantity * $item->product_price;
                @endphp
            </tr>
            @endforeach

        </table>

        <div class="invoice-total">
            <p>Total: RM{{ number_format($totalPrice, 2) }}</p>
        </div>

    </div>


    <div class="thank-you">
        <p>Thank you for your business!</p>
    </div>
    </div>
</body>

</html>