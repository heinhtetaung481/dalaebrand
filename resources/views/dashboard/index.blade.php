@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<span>{{ $pendingOrdersCount }}</span> <br>Pending Orders
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<span>{{ $itemsCount }}</span> <br>Products
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<span>{{ $salesCount }}</span> <br>Sales
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<span>{{ $customersCount }}</span> <br>Customers
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
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
		<div class="panel panel-default">
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


@endsection
