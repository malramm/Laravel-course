
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Project</title>
	<style>
	
		#invoice{
			padding: 30px;
		}

		.invoice {
			position: relative;
			background-color: #FFF;
			min-height: 680px;
			padding: 15px
		}

		.invoice header {
			padding: 10px 0;
			margin-bottom: 20px;
			border-bottom: 1px solid #3989c6
		}

		.invoice .company-details {
			text-align: right
		}

		.invoice .company-details .name {
			margin-top: 0;
			margin-bottom: 0
		}

		.invoice .contacts {
			margin-bottom: 20px
		}

		.invoice .invoice-to {
			text-align: left
		}

		.invoice .invoice-to .to {
			margin-top: 0;
			margin-bottom: 0
		}

		.invoice .invoice-details {
			text-align: right
		}

		.invoice .invoice-details .invoice-id {
			margin-top: 0;
			color: #3989c6
		}

		.invoice main {
			padding-bottom: 50px
		}

		.invoice main .thanks {
			margin-top: -100px;
			font-size: 2em;
			margin-bottom: 50px
		}

		.invoice main .notices {
			padding-left: 6px;
			border-left: 6px solid #3989c6
		}

		.invoice main .notices .notice {
			font-size: 1.2em
		}

		.invoice table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			margin-bottom: 20px
		}

		.invoice table td,.invoice table th {
			padding: 15px;
			background: #eee;
			border-bottom: 1px solid #fff
		}

		.invoice table th {
			white-space: nowrap;
			font-weight: 400;
			font-size: 16px
		}

		.invoice table td h3 {
			margin: 0;
			font-weight: 400;
			color: #3989c6;
			font-size: 1.2em
		}

		.invoice table .qty,.invoice table .total,.invoice table .unit {
			text-align: right;
			font-size: 1.2em
		}

		.invoice table .no {
			color: #fff;
			font-size: 1.6em;
			background: #3989c6
		}

		.invoice table .unit {
			background: #ddd
		}

		.invoice table .total {
			background: #3989c6;
			color: #fff
		}

		.invoice table tbody tr:last-child td {
			border: none
		}

		.invoice table tfoot td {
			background: 0 0;
			border-bottom: none;
			white-space: nowrap;
			text-align: right;
			padding: 10px 20px;
			font-size: 1.2em;
			border-top: 1px solid #aaa
		}

		.invoice table tfoot tr:first-child td {
			border-top: none
		}

		.invoice table tfoot tr:last-child td {
			color: #3989c6;
			font-size: 1.4em;
			border-top: 1px solid #3989c6
		}

		.invoice table tfoot tr td:first-child {
			border: none
		}

		.invoice footer {
			width: 100%;
			text-align: center;
			color: #777;
			border-top: 1px solid #aaa;
			padding: 8px 0
		}

		@media print {
			.invoice {
				font-size: 11px!important;
				overflow: hidden!important
			}

			.invoice footer {
				position: absolute;
				bottom: 10px;
				page-break-after: always
			}

			.invoice>div:last-child {
				page-break-before: always
			}
		}
	</style>
</head>

<body>


	<!--Author      : @arboshiki-->
	<div id="invoice">

		
		<div class="invoice overflow-auto">
			<div style="min-width: 600px">
				<header>
					<div class="row">
						<div class="col">
							<a target="_blank" href="#">
								<img src="https://res.cloudinary.com/pixel-penguin/image/upload/c_scale,h_100/v1582807680/pixel_penguin_logos/new/pixel_penguin_without_creative_solutions-01_xaejgv.png" data-holder-rendered="true" />
								</a>
						</div>
						<div class="col company-details">
							<h2 class="name">
								<a target="_blank" href="#">
								PixelPenguin
								</a>
							</h2>
							<div>PixelPenguin Place</div>
							<div>(123) 456-789</div>
							<div>sample@email.com</div>
						</div>
					</div>
				</header>
				
				<main>
					<div class="row contacts">
						<div class="col invoice-to">
							<div class="text-gray-light">INVOICE TO:</div>
							<h2 class="to">{{$invoice->customerName}}</h2>
							<div class="address">{{ $invoice->customerAddress ?? '' }}</div>
							<div class="email"><a href="mailto:john@example.com">{{$invoice->customerEmail}}</a></div>
						</div>
						<div class="col invoice-details">
							<h1 class="invoice-id">INVOICE {{ $invoice->id}}</h1>
							<div class="date">Date of Invoice: {{ $invoice->invoiceDate}}</div>
							<div class="date">Due Date: {{$invoice->dueDate}}</div>
						</div>
					</div>
										
					<table border="0" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-left">DESCRIPTION</th>
								<th class="text-right">PRICE</th>
								<th class="text-right">QUANTITY</th>
								<th class="text-right">TOTAL</th>
							</tr>
						</thead>
						<tbody>
							@php
								$total = 0;
							@endphp
							@foreach($invoiceEntries as $invoiceEntry)
							<tr>
								<td class="no">{{$invoiceEntry->productId}}</td>
								@foreach($products as $product)
									@if ($invoiceEntry->productId == $product->productId)
									<td class="text-left"><h3>{{$product->productName}}</h3>{{$product->productDescription}}</td>
									<td class="unit">${{$invoiceEntry->invoiceEntryPrice}}</td>
									<td class="qty">{{$invoiceEntry->productQuantity}}</td>
									<td class="total">${{$invoiceEntry->invoiceEntryPrice * $invoiceEntry->productQuantity}}.00</td>
									@php
										$total = $total + $invoiceEntry->invoiceEntryPrice * $invoiceEntry->productQuantity;
									@endphp
									@endif
								@endforeach
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">SUBTOTAL</td>
								<td>${{$total * .75}}.00</td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">TAX 25%</td>
								<td>${{$total * .25}}.00</td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">GRAND TOTAL</td>
								<td>${{$total}}.00</td>
							</tr>
						</tfoot>						
					</table>
					<div class="thanks">Thank you!</div>
					<div class="notices">
						<div>NOTICE:</div>
						<div class="notice">A finance charge of 1.5% will be made on unpaid balances after due date.</div>
					</div>
					<div>
						<p></p>
						<div class="btn btn-primary">Print invoice</div>
						<a class="btn btn-primary" href="/listInvoices">List Invoices</a>
					</div>

				</main>
				<footer>
					This is just a project and nothing more
				</footer>
			</div>
			<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
			<div></div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
</body>
</html>