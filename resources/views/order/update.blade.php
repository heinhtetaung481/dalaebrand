@extends('layouts.app')

@section('content')

<div class="col-md-12">
	<div class="col-md-12">
	<form class="form-horizontal" method="POST" action="/order/{{ $order->id }}" id="updateOrder">

            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="cusName" class="control-label col-md-2">Customer Name:</label>
								<div class="col-md-6">
                	<input type="text" name="cusName" class="form-control" value="{{ $order->customer->name }}">
								</div>
            </div>

            <div class="form-group">
                <label for="cusPhone" class="control-label col-md-2">Customer Phone:</label>
								<div class="col-md-6">
                	<input type="phone" name="cusPhone" class="form-control" value="{{ $order->customer->phone }}">
								</div>
            </div>

            <div class="form-group">
                <label for="cusAddress" class="control-label col-md-2">Delivery Address:</label>
								<div class="col-md-6">
                	<input type="text" name="cusAddress" class="form-control" value="{{ $order->customer->address }}">
								</div>
            </div>

            <div class="form-group">
                <label for="cusEmail" class="control-label col-md-2">Email:</label>
								<div class="col-md-6">
                	<input type="email" name="cusEmail" class="form-control" value="{{ $order->customer->email }}">
								</div>
            </div>

            <div class="form-group">
                <label for="date" class="control-label col-md-2">Date:</label>
								<div class="col-md-6">
                	<input type="date" name="date" class="form-control" value="{{ date('Y-m-d', strtotime($order->orderdate)) }}">
								</div>
            </div>
            <div class="form-group">
                <label for="discount" class="control-label col-md-2">Discount:</label>
								<div class="col-md-6">
                	<input type="text" name="discount" class="form-control" value="{{ $order->discount }}">
								</div>
            </div>
            <div class="form-group">
                <label for="remarks" class="control-label col-md-2">Remarks:</label>
								<div class="col-md-6">
                	<input type="text" name="remarks" class="form-control" value="{{ $order->remarks }}">
								</div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Order Status</label>
								<div class="col-md-6">
	                <select class="form-control" name="status" id="status">

	                    <option value="pending" @if($order->status == "pending") {{ "selected" }} @endif >Pending</option>
	                    <option value="confirm" @if($order->status == "confirm") {{ "selected" }} @endif >Confirm</option>
	                    <option value="processing">Processing</option>
	                    <option value="delivered">Delivered</option>
	                </select>
								</div>
            </div>
						<div class="row">
							<div class="col-md-3 pull-right">
								<button class="btn btn-primary order-button" onclick="updateOrder()">Update</button>
							</div>
						</div>
            </form>

        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Design</th>
                        <th>Remarks</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody">


                    @foreach($oitemps as $oitemp)


                     <tr>
                         <td>{{ $oitemp->item->itemtype->gender }}  {{ $oitemp->item->itemtype->type }}</td>
                         <td>{{ $oitemp->item->color }}</td>
                         <td>{{ $oitemp->item->size }}</td>
                         <td>{{ $oitemp->quantity }}</td>
                         <td>{{ $oitemp->price }}</td>
                         <td>{{ $oitemp->design->name }}</td>
                         <td>{{ $oitemp->remarks }}</td>
                         <td><span class="btn btn-danger glyphicon glyphicon-minus" onclick="deleteOrderItemTemp({{ $oitemp->id }})"></span></td>
                     </tr>

                     @endforeach

                </tbody>
            </table>



        <br>

        <form method="POST" action="/oitemp" id="newOrderItem">
					<div class="row">
						<div class="form-group col-md-3">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" id="gender" onchange="checkGender()">
                    <option selected value="">Choose Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="itemType">Item Type:</label>
                <select name="itemType" class="form-control" id="itemType" onchange="checkType()">


                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="size">Size:</label>
                <select name="size" class="form-control" id="size" onchange="checkColor()">

                </select>
            </div>

						<div class="form-group col-md-3">
                <label for="color">Color:</label>
                <select name="color" class="form-control" id="color">
                </select>
            </div>

					</div>

					<div class="row">
						<div class="form-group col-md-3">
								<label for="remarks">Remarks:</label>
								<input type="text" name="remarks" class="form-control" id="remarks">
						</div>

            <div class="form-group col-md-3">
                <label for="price">Price:</label>
                <input type="text" name="price" class="form-control" id="price">
            </div>

						<div class="form-group col-md-3">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" class="form-control" id="quantity">
            </div>
						<div class="form-group col-md-3">
                <span class="btn btn-primary glyphicon glyphicon-plus" onclick="addOrderItemTemp()" id="plusbutton"></span>
            </div>
					</div>








            <div class="form-group col-md-12 design-select-hide design-select">
                <label for="design">Select Design:</label>
                <select name="design" class="form-control image-picker" id="design">
									<option value="1">--- No Design ---</option>
                    @foreach($designs as $key => $design)
                        @if($key>0)
                    <option data-img-src="/storage/designs/{{ $design->path }}" value="{{ $design->id }}">{{ $design->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

                <!-- Error Message -->
                <span style="display:none" class="col-md-3 alert alert-danger" id="error"></span>
    </form>
</div>

<script>


    function deleteOrderItemTemp(id){

        $.ajax(
        {
            url:"/oitemp/"+id,
            type:'get',
            success: function (items){

                $('#tbody').empty();

                for (var i = 0; i < items.length; i++) {
                    var item = items[i]

                $('#tbody').append($('<tr>'));
                $('#tbody tr:last').append($('<td>'+item.gender+' '+item.type+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.color+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.size+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.quantity+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.price+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.design_name+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.remarks+'</td>'));
                $('#tbody tr:last').append($('<td><span class="btn btn-danger glyphicon glyphicon-minus" onclick="deleteOrderItemTemp('+item.id+')"></span></td>'));
                $('#tbody tr:last').append($('</tr>'));

                }

            }

        })

    }

    function checkGender(){
        var gender = $('#gender').val();

        $(".design-select").addClass('design-select-hide');
        $("#design option[value=1]").prop('selected',true);

        if(gender){
        $.ajax({
            url:'/order/gender/'+gender,
            type:'GET',
            success:function(data){

                $('#itemType').empty();
                $('#size').empty();
                $('#color').empty();
                $('#itemType').append($('<option selected>Choose Item Type</option>'));
                for(i=0; i< data.length; i++){

                $('#itemType').append($('<option value='+data[i].id+'>'+data[i].type+'</option>'));
            }
            }

        })
        }else{
            $('#itemType').empty();
            $('#size').empty();
            $('#color').empty();
        }
    }

    function checkType(){

        var itemType = $('#itemType').val();

        if (itemType == 3) {


            $("#design").imagepicker({
							hide_select: false,
							show_label: true,
						});

            $(".design-select").removeClass('design-select-hide');
        }else{

            $(".design-select").addClass('design-select-hide');
            $("#design option[value=1]").prop('selected',true);

        }

        if(itemType){
        $.ajax({
            url:'/order/size/'+itemType,
            type:'GET',
            success:function(data){

                $('#size').empty();
                $('#color').empty();
                $('#size').append($('<option selected>Choose Size</option>'));
                for(i=0; i< data.length; i++){

                $('#size').append($('<option value="'+data[i].size+'">'+data[i].size+'</option>'));
            }
            }

        })
        }else{
            $('#size').empty();
            $('#color').empty();
        }
    }

    function checkColor(){
        var itemType = $('#itemType').val();
        var size = $('#size').val();
        if(itemType && size){
        $.ajax({
            url:'/order/'+itemType+'/'+size,
            type:'GET',
            success:function(data){

                $('#color').empty();
                $('#color').append($('<option selected>Choose Color</option>'));
                for(i=0; i< data.length; i++){

                $('#color').append($('<option value="'+data[i].color+'">'+data[i].color+'</option>'));

                }
            }

        })
        }else{
            $('#color').empty();
        }
    }

        function addOrderItemTemp(){


        var gender = $('#gender').val();
        var itemtype = $('#itemType').val();
        var size = $('#size').val();
        var color = $('#color').val();
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var remarks = $('#remarks').val();
        var design = $('#design').val();

        $.ajax(
        {

            url:"/oitemp",
            type:'post',
            data:{gender:gender,itemtype:itemtype,size:size,color:color,price:price,quantity:quantity,remarks:remarks,design:design,_token:'{{csrf_token()}}'},
            success:function(items){

                if(items.error){

                    alert(items.error);
                }else{

                $('#tbody').empty();

                for (var i = 0; i < items.length; i++) {
                    var item = items[i]

                $('#tbody').append($('<tr>'));
                $('#tbody tr:last').append($('<td>'+item.gender+' '+item.type+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.color+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.size+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.quantity+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.price+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.design_name+'</td>'));
                $('#tbody tr:last').append($('<td>'+item.remarks+'</td>'));
                $('#tbody tr:last').append($('<td><span class="btn btn-danger glyphicon glyphicon-minus" onclick="deleteOrderItemTemp('+item.id+')"></span></td>'));
                //$('#tbody').append($('</tr>'));

                }
                $('#gender').prop('selectedIndex',0);
                $('#itemType').empty();
                $('#size').empty();
                $('#color').empty();
                $('#price').empty();
                $('#remarks').val('');
                $('#quantity').val('');
            }
            },



        });

    }

    function updateOrder(){

       var status = $('#status').val()

        if (status == 'processing' || status == 'delivered') {

            if (confirm("If you chose processing or delivered, This order cannot be edit again!")) {

                $('#updateOrder').submit();
            }

        }else{

            $('#updateOrder').submit();
        }

    }

</script>

@endsection
