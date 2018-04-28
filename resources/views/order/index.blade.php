@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a href="order/create"><button type="button" class="btn btn-primary pull-right">
                            +Add New Order
                        </button></a>
                    <h4>Order</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="orders">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Phone No.</th>
                                <th>Address</th>
                                <th>status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <td class="id_input"></td>
                            <td class="non-searchable"></td>
                            <td class="input_box"></td>
                            <td class="input_box"></td>
                            <td class="input_box"></td>
                            <td class="input_box"></td>
                            <td class="non-searchable"></td>
                          </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Dialogue for Order Detail -->

<div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderDetailModal">Order Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      	<div>
        Order ID: <span id="orderId"></span>
      	</div>
        <div>
        Date: <span id="orderDate"></span>
      	<div>
        Customer Name: <span id="cusName"></span>
      	</div>
      	<div>
        Phone No.: <span id="cusPhone"></span>
      	</div>
        <div>
          Address: <span id="cusAddress"></span>
      	<div>

        <div>
          Email: <span id="cusEmail"></span>
        <div>

        <div>
          Status: <span id="status"></span>
        </div>
        <div>
          Discount: <span id="discount"></span>
        </div>
        <div>
          Remarks: <span id="remarks"></span>
        </div>
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
					</tr>
				</thead>
				<tbody id="tbody">

				</tbody>
			</table>
      	</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>



<script>

  $(document).ready(function() {

    $('#orders').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables.orderdata') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'orderdate', name: 'orderdate' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'customer_phone', name: 'customer_phone' },
            { data: 'customer_address', name: 'customer_address'},
            { data: 'status', name: 'status'},
            { data: 'button', name: 'button'}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var columnClass = column.footer().className;
                if (columnClass !== 'non-searchable') {
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
              }
            });
        }
    });
});

</script>

<script>

    function orderDetail(id){

        $.ajax(
        {
            url:"order/"+id,
            type:'GET',

        }).done(
            function (data){

              $('#orderId').html(data[0].id);
              $('#orderDate').html(data[0].orderdate);
              $('#cusName').html(data[0].name);
              $('#cusPhone').html(data[0].phone);
              $('#cusAddress').html(data[0].address);
              $('#cusEmail').html(data[0].email);
              $('#status').html(data[0].status);
              $('#discount').html(data[0].discount);
              $('#remarks').html(data[0].remarks);


              $('#tbody').empty();

            	for (var i = 1; i < data.length; i++){

            		var orderitem = data[i];

                $('#tbody').append($('<tr>'));
                $('#tbody tr:last').append($('<td>'+orderitem.gender+' '+orderitem.type+'</td>'));
                $('#tbody tr:last').append($('<td>'+orderitem.color+'</td>'));
                $('#tbody tr:last').append($('<td>'+orderitem.size+'</td>'));
                $('#tbody tr:last').append($('<td>'+orderitem.quantity+'</td>'));
                $('#tbody tr:last').append($('<td>'+orderitem.price+'</td>'));
                $('#tbody tr:last').append($('<td>'+orderitem.design_name+'</td>'));
                $('#tbody tr:last').append($('<td>'+orderitem.remarks+'</td>'));
                $('#tbody tr:last').append($('</tr>'));

            	}
                $("#orderDetailModal").modal("show");

            }
        )
    }
</script>


@endsection
