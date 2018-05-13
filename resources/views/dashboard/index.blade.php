@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default card" id="pending-orders-card">
			<div class="panel-body">
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
					<tr>
						<td>Male Slipper</td>
						<td>White</td>
						<td>11</td>
						<td>9</td>
					</tr>
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
					<tr>
						<td>2</td>
						<td>12.2.2018</td>
						<td>hha</td>
						<td>Pending</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

</div>


@endsection
