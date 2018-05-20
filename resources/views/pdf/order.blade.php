<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Order</title>
</head>
<body>
	<h2>Order Detail</h2>
	<div>
        Order ID: <span id="orderId">{{ $order->id }}</span>
      	</div>
        <div>
        Date: <span id="orderDate">{{ $order->orderdate }}</span>
      	<div>
        Customer Name: <span id="cusName">{{ $order->customer->name }}</span>
      	</div>
      	<div>
        Phone No.: <span id="cusPhone">{{ $order->customer->phone }}</span>
      	</div>
        <div>
          Address: <span id="cusAddress">{{ $order->customer->address }}</span>
      	<div>

        <div>
          Email: <span id="cusEmail">{{ $order->customer->email }}</span>
        <div>

        <div>
          Status: <span id="status">{{ $order->status }}</span>
        </div>
        <div>
          Discount: <span id="discount">{{ $order->discount }}</span>
        </div>
        <div>
          Remarks: <span id="remarks">{{ $order->remarks }}</span>
        </div>
        <div>
    		<table>
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
    			</tbody>
    		</table>
        </div>
</body>
</html>