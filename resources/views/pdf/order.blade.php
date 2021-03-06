<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Order</title>
	<style>
		#orderTable{
			border-collapse: collapse;
    	width: 100%;
		}
		#cusTable{
			border-collapse: collapse;
    	width: 50%;
		}

		#orderTable th{
			padding-top: 12px;
	    padding-bottom: 12px;
	    text-align: left;
	    background-color: #12447A;
	    color: white;
		}

		/* #orderTable tr:nth-child(even){
			background-color: #f2f2f2;
		} */

		#orderTable td,#orderTable th{
			border: 1px solid #ddd;
    	padding: 8px;
		}
		#orderTable td span.total{
			float: right;
		}
	</style>
</head>
<body>
	<h2>Order Detail</h2>
		<table id="cusTable">
			<tr>
				<td>Order ID:</td>
				<td>{{ $order->id }}</td>
			</tr>
			<tr>
				<td>Date:</td>
				<td>{{ date('Y-m-d', strtotime($order->orderdate)) }}</td>
			</tr>
			<tr>
				<td>Customer Name:</td>
				<td>{{ $order->customer->name }}</td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td>{{ $order->customer->phone }}</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td>{{ $order->customer->address }}</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>{{ $order->customer->email }}</td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>{{ $order->status }}</td>
			</tr>
			<tr>
				<td>Remarks:</td>
				<td>{{ $order->remarks }}</td>
			</tr>
		</table>
		<br>

        <div>
    		<table id="orderTable">
    			<thead>
    				<tr>
    					<th>Type</th>
    					<th>Color</th>
    					<th>Size</th>
    					<th>Quantity</th>
              <th>Price</th>
    					<th>Design</th>
              <th>Remarks</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($order->orderitems as $orderitem)
	    				<tr>
	    					<td>{{ $orderitem->item->itemtype->gender }} {{ $orderitem->item->itemtype->type }}</td>
	    					<td>{{ $orderitem->item->color }}</td>
	    					<td>{{ $orderitem->item->size }}</td>
	    					<td>{{ $orderitem->quantity }}</td>
	    					<td>{{ $orderitem->price }}</td>
	    					<td>{{ $orderitem->design->name }}</td>
	    					<td>{{ $orderitem->remarks }}</td>
	    				</tr>
    				@endforeach

    				@php ($subtotal = 0)
    				@foreach ($order->orderitems as $orderitem)

    					{{ $subtotal += $orderitem->price }}

    				@endforeach

    					<tr>
    						<td colspan=4><span class="total">Subtotal</span></td>
    						<td colspan=3>{{ $subtotal }}</td>
    					</tr>
    					<tr>
    						<td colspan=4><span class="total">Discount</span></td>
    						<td colspan=3>-{{ $order->discount }}</td>
    					</tr>
    					<tr>
    						<td colspan=4><span class="total">Total</span></td>
    						<td colspan=3>{{ $subtotal - $order->discount }}</td>
    					</tr>
    			</tbody>
    		</table>
        </div>


</body>
</html>
