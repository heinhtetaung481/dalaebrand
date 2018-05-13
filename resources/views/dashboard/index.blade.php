@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default card" id="pending-orders-card">
			<div class="panel-body">

				<span>{{ $pendingOrdersCount }}</span> <br>Pending Orders

				<div class="col-md-8">
					<span class="numbers">24</span> <br>Pending Orders
				</div>
				<div class="col-md-4">
					<span class="glyphicon glyphicon-shopping-cart card-icon"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default card" id="products-card">
			<div class="panel-body">

				<span>{{ $itemsCount }}</span> <br>Products

				<div class="col-md-8">
					<span class="numbers">4</span> <br>Products
				</div>
				<div class="col-md-4">
					<span class="glyphicon glyphicon-list-alt card-icon"></span>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default card" id="sales-card">

			<div class="panel-body">

				<span>{{ $salesCount }}</span> <br>Sales


				<div class="col-md-8">
					<span class="numbers">24</span> <br>Sales
				</div>

				<div class="col-md-4">
					<span class="glyphicon glyphicon-tags card-icon"></span>
				</div>


			</div>

		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default card" id="customers-card">
			<div class="panel-body">

				<span>{{ $customersCount }}</span> <br>Customers

				<div class="col-md-8">
					<span class="numbers">2402</span> <br>Customers
				</div>
				<div class="col-md-4">
					<span class="glyphicon glyphicon-user card-icon"></span>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default panel-danger">
			<div class="panel-heading">STOCKS UNDER 10 PAX</div>
			<div class="panel-body">
				<table class="table table-striped">
						<tr>
							<th>Type</th>
							<th>Color</th>
							<th>Size</th>
							<th>Qty</th>
						</tr>
						@if($leastItems->count() > 0)
							@foreach($leastItems as $item)
								<tr>
									<td>{{ $item->itemtype->gender }} {{ $item->itemtype->type }}</td>
									<td>{{ $item->color }}</td>
									<td>{{ $item->size }}</td>
									<td>{{ $item->quantity }}</td>
								</tr>
							@endforeach
						@else
							<tr><td colspan="4">All Items are above 10 Pax</td></tr>
						@endif

						
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-default panel-info">
			<div class="panel-heading">Latest Orders</div>
			<div class="panel-body">
				<table class="table table-striped">
					<tr>
						<th>Order ID</th>
						<th>Date</th>
						<th>Customer Name</th>
						<th>Status</th>
					</tr>
					@if($latestOrders->count() > 0)
						@foreach($latestOrders as $order)
							<tr>
								<td>{{ $order->id }}</td>
								<td>{{ Carbon\Carbon::parse($order->orderdate)->format('d-m-Y') }}</td>
								<td>{{ $order->customer->name }}</td>
								<td>{{ $order->status }}</td>
							</tr>
						@endforeach
					@else
						<tr><td>There is no Orders</td></tr>
					@endif
				</table>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default panel-primary">
			<div class="panel-heading">Popular Items <span class="glyphicon glyphicon-star pull-right"><span></div>
			<div class="panel-body">
				<table class="table table-striped">
					<tr>
						<th>Type</th>
						<th>Color</th>
						<th>Size</th>
						<th>Total Sales</th>
					</tr>
					<tr>
						<td>Male Slipper</td>
						<td>White</td>
						<td>11</td>
						<td>480</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">

	</div>
</div>


@endsection
