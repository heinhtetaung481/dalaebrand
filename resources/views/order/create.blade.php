@extends('layouts.app')

@section('content')


<div class="col-md-12">
	<div class="col-md-6">
		<form method="POST" action="/order" id="newOrder">
	            {{ csrf_field() }}
	            <div class="col-md-6">
	            <div class="form-group">
	                <label for="cusName">Customer Name:</label>
	                <input type="text" name="cusName" class="form-control">
	            </div>

	            <div class="form-group">
	                <label for="cusPhone">Customer Phone:</label>
	                <input type="phone" name="cusPhone" class="form-control">
	            </div>

	            <div class="form-group">
	                <label for="cusAddress">Delivery Address:</label>
	                <input type="text" name="cusAddress" class="form-control">
	            </div>

	            <div class="form-group">
	                <label for="cusEmail">Email:</label>
	                <input type="email" name="cusEmail" class="form-control">
	            </div>

	            <div class="form-group">
	                <label for="date">Date:</label>
	                <input type="date" name="date" class="form-control">
	            </div>
	            </div>


	    </form>
	</div>
	<div class="col-md-6">
		<button class="btn btn-primary order-button" onclick="updateOrder()">Order</button>
	</div>
	<table class="table table-striped">
		 <thead>
				 <tr>
						 <th>Type</th>
						 <th>Color</th>
						 <th>Size</th>
						 <th>Quantity</th>
						 <th>Unit Price</th>
						 <th>Design</th>
						 <th>Remarks</th>
						 <th></th>
				 </tr>
		 </thead>
		 <tbody id="tbody">


		 </tbody>
 </table>


    <form method="POST" action="/oitemp" id="newOrderItem">

            <div class="form-group col-md-2">
            	<label for="gender">Gender:</label>
            	<select name="gender" class="form-control" id="gender" onchange="checkGender()">
            		<option selected value="">Choose Gender</option>
            		<option value="Male">Male</option>
            		<option value="Female">Female</option>
            	</select>
            </div>

            <div class="form-group col-md-2">
            	<label for="itemType">Item Type:</label>
            	<select name="itemType" class="form-control" id="itemType" onchange="checkType()">


            	</select>
            </div>

            <div class="form-group col-md-2">
                <label for="size">Size:</label>
                <select name="size" class="form-control" id="size" onchange="checkColor()">

            	</select>
            </div>

            <div class="form-group col-md-2">
                <label for="color">Color:</label>
                <select name="color" class="form-control" id="color">
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="remarks">Remarks:</label>
                <input type="text" name="remarks" class="form-control" id="remarks">
            </div>

            <div class="form-group col-md-1">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" class="form-control" id="quantity">
            </div>

						<div class="form-group col-md-1">
                <span class="btn btn-primary glyphicon glyphicon-plus" onclick="addOrderItemTemp()" id="plusbutton" data="1"></span>
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
						}
						);

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
// Add Order to temp
        function addOrderItemTemp(){


        var gender = $('#gender').val();
        var itemtype = $('#itemType').val();
        var size = $('#size').val();
        var color = $('#color').val();
        var quantity = $('#quantity').val();
        var remarks = $('#remarks').val();
        var design  = $('#design').val();

        $.ajax(
        {

            url:"/oitemp",
            type:'post',
            data:{gender:gender,itemtype:itemtype,size:size,color:color,quantity:quantity,remarks:remarks,design:design,_token:'{{csrf_token()}}'},
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
                $('#remarks').val('');
                $('#quantity').val('');

            }
            },



        });

    }

    function updateOrder(){

        $('#newOrder').submit();

    }

</script>

@endsection