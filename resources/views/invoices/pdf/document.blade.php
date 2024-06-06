<!DOCTYPE html>
<html>
<head>
    <title>Invoice PDF</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            margin: 0;
        }
        .invoice-container {
            width: 60%;
            margin: 0 auto;
            text-align: center;
        }
        .invoice-details { 
            width: 100%; 
            margin-bottom: 20px; 
            border-collapse: collapse; 
        }
        .invoice-details th, .invoice-details td { 
            padding: 10px; 
            text-align: left; 
            border: 1px solid #ddd;
        }
        .invoice-details th {
            width: 50%;
            background-color: #f2f2f2;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <h1>Invoice Details</h1>
        <table class="invoice-details">
            <tr>
                <th>Client Name:</th>
                <td>{{ $invoice->firstName }} {{ $invoice->lastName }}</td>
            </tr>
            <tr>
                <th>Additional Charges:</th>
                <td>{{ number_format($invoice->additionalCharges, 2) }}DH</td>
            </tr>
            <tr>
                <th>Total Amount:</th>
                <td>{{ number_format($invoice->totalAmount, 2) }}DH</td>
            </tr>
            <tr>
                <th>Created At:</th>
                <td>{{ $invoice->created_at }}</td>
            </tr>
        </table>
        <div class="signature">
            <p>Signature</p>
            <div class="signature-line"></div>
        </div>
    </div>
</body>
</html>
