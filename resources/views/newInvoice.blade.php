
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Project</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="/css/website.css">-->

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

		input[id^="c"] {
			width: 50%;
			padding: 2px;
			margin: 4px;
			box-sizing: border-box;
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
  <div id="app">
	
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
				@empty($invoice)
				<form method="post" action="/insertInvoice">
				@endempty
				@isset($invoice)
				<form method="post" action="/updateInvoice/{{$invoice->id}}">
				@endisset
					@csrf
					<div class="row contacts">
						<div class="col invoice-to">
							<div class="text-gray-light">INVOICE TO:<br>
								@empty($invoice)
								<input type="text" class="to" id="cName" name="cName" placeholder="Customer Name"><br>
								<input type="text" class="address" id="cAddress" name="cAddress" placeholder="Customer Address"><br>
								<input type="email" class="email" id="cEmail" name="cEmail" placeholder="Customer Email">
								@endempty
								@isset($invoice)
								<input type="text" class="to" id="cName" name="cName" value="{{$invoice->customerName}}" placeholder="{{$invoice->customerName}}"><br>
								<input type="text" class="address" id="cAddress" name="cAddress" value="{{ $invoice->customerAddress ?? '' }}" placeholder="{{ $invoice->customerAddress ?? '' }}"><br>
								<input type="email" class="email" id="cEmail" name="cEmail" value="{{$invoice->customerEmail}}" placeholder="{{$invoice->customerEmail}}">
								@endisset
							</div>
						</div>
						@isset($invoice)
						<div class="col invoice-details">
							<h1 class="invoice-id">INVOICE {{ $invoice->id}}</h1>
							<div class="date">Date of Invoice: {{ $invoice->invoiceDate}}</div>
							<div class="date">Due Date: {{$invoice->dueDate}}</div>
						</div>
						@endisset
					</div>
				<!--
					<add-invoice-item></add-invoice-item>
				-->
					<input type="number" name="newEntries" id="newEntries" value="0" hidden>

					<div>
						<p class="btn btn-primary" id="addItemButton" onclick="itemAdd()">Add new item to invoice</p>
					</div>
					<table border="0" cellspacing="0" cellpadding="0" id="itemTable">
						<thead>
							<tr>
								<th>PRODUCT # and NAME</th>
								<th class="text-left">QUANTITY</th>
							</tr>
						</thead>
						<tbody>
							@isset($invoice)
							@foreach($invoiceEntries as $invoiceEntry)
							<tr>
								@foreach($products as $product)
									@if ($invoiceEntry->productId == $product->productId)
									<td>
										<select name="eId{{$invoiceEntry->id}}" id="eId{{$invoiceEntry->id}}">
											<option value="{{$invoiceEntry->productId}}" selected hidden>{{$product->productId}}&nbsp&nbsp&nbsp&nbsp{{$product->productName}}</option>
											@foreach($products as $product)
												<option value="{{$product->productId}}">{{$product->productId}}&nbsp&nbsp&nbsp&nbsp{{$product->productName}}</option>
											@endforeach
										</select>
									</td>									
									@endif
								@endforeach
								<td><input type="number" id="eQty{{$invoiceEntry->id}}" name="eQty{{$invoiceEntry->id}}" value="{{$invoiceEntry->productQuantity}}" placeholder="{{$invoiceEntry->productQuantity}}"></td>
							</tr>
							@endforeach
							@endisset
						</tbody>
						<tfoot>
						</tfoot>						
					</table>
					<div>
						<button type="submit" class="btn btn-primary">Save invoice</button>
						<a class="btn btn-primary" href="listInvoices">List Invoices</a>
					</div>
				</form>
				</main>
				<footer>
					This is just a project and nothing more
				</footer>
			</div>
			<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
			<div></div>
		</div>
	</div>
  </div>
	<script>
			function itemAdd() {
				var x = parseInt(document.getElementById("newEntries").value);
				x += 1;
				document.getElementById("newEntries").value = x;

				var table = document.getElementById("itemTable");
				var row = table.insertRow(1);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				cell1.innerHTML = '<td><select name="pId' + x + '">@foreach($products as $product)<option value="{{$product->productId}}">{{$product->productId}}&nbsp&nbsp&nbsp&nbsp{{$product->productName}}</option>@endforeach</select></td>';
				cell2.innerHTML = '<td><input type="number" name="pQty' + x + '" placeholder="Quantity"></td>';
			}
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script src="/js/app.js"></script>
</body>
</html>