<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        @foreach($invoices as $invoice)
        <li style="list-style-type: none;">
                <p>{{ $invoice->id}}&nbsp&nbsp&nbsp&nbsp{{ $invoice->customerName}}&nbsp&nbsp&nbsp&nbsp<span><button type="button" onclick="document.location='editInvoice/{{ $invoice->id }}'">Edit</button>&nbsp&nbsp&nbsp&nbsp<button type="button" onclick="document.location='showInvoice/{{ $invoice->id }}'">Show</button></span></p>
        </li>
        @endforeach
    </ul>
    <a href="/">Go back</a>
</body>
</html>