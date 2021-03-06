@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a href="order/create"><button type="button" class="btn btn-primary pull-right">
                            +Add New Order
                        </button></a>
                        <a href="/export/orders" class="btn btn-info pull-right export-button">Orders Export</a>
                        <a href="/export/orderitems" class="btn btn-info pull-right export-button">Order Items Export</a>
                    <h4>Order</h4>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped" id="orders">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Phone No.</th>
                                <th>Address</th>
                                <th>status</th>
                                <th>Actions</th>
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
          <div class="row">
            <div class="col-md-3 orderLabel">
              Order ID:
            </div>
            <div class="col-md-3">
              <span id="orderId"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 orderLabel">
              Customer Name:
            </div>
            <div class="col-md-3">
              <span id="cusName"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 orderLabel">
              Phone:
            </div>
            <div class="col-md-3">
              <span id="cusPhone"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 orderLabel">
              Address:
            </div>
            <div class="col-md-3">
              <span id="cusAddress"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 orderLabel">
              Email:
            </div>
            <div class="col-md-3">
              <span id="cusEmail"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 orderLabel">
              Status:
            </div>
            <div class="col-md-3">
              <span id="status"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 orderLabel">
              Remarks:
            </div>
            <div class="col-md-3">
              <span id="remarks"></span>
            </div>
          </div>
          <br/>

            <div class="table-responsive">
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
          <a class="btn btn-primary" id="order-pdf">Print</a>
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
              $('#order-pdf').prop('href','/pdf/order/'+data[0].id);


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
                var subtotal = 0;

                  for (var i = 1; i<data.length; i++){
                    subtotal += data[i].price
                  }

                total = subtotal - data[0].discount

                $('#tbody').append($('<tr><td class="total" colspan=4><span class="bold pull-right">Subtotal :</span></td><td colspan=3>'+subtotal+'</td></tr>'));
                $('#tbody').append($('<tr><td class="total" colspan=4><span class="bold pull-right">Discount :</span></td><td class="total" colspan=3>-'+data[0].discount+'</td></tr>'));
                $('#tbody').append($('<tr><td class="total" colspan=4><span class="bold pull-right">Total :</span></td><td colspan=3>'+total+'</td></tr>'));


                $("#orderDetailModal").modal("show");

            }
        )
    }
</script>


@endsection
