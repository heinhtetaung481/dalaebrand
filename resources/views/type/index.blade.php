@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newTypeModal">
                            +Add New Type
                        </button>
                    <h4>Product Type</h4>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                        {!! implode('', $errors->all('<p class="bg-danger">:message</p>')) !!}
                    @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="itemtype">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td class="id_input"></td>
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
    </div>

 <!-- Modal for Add New Items -->

<div class="modal fade" id="newTypeModal" tabindex="-1" role="dialog" aria-labelledby="newTypeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newTypeModalLabel">Add New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/itemtype" id="newitem">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>

            <div class="form-group">
                <label for="type">Product Type:</label>
                <input type="text" name="type" class="form-control" id="type">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" id="gender">
                    <option selected value="">Choose Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="document.getElementById('newitem').submit();" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<script>

  $(document).ready(function() {

    $('#itemtype').DataTable({
        processing: true,
        serverSide: true,

        ajax: "{{ route('datatables.itemtypedata') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'type', name: 'type' },
            { data: 'gender', name: 'gender' },
            { data: 'button', name: 'button' }
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

  function confirmDelete(){

        return confirm("Are you sure you want to delete this product type. This will also delete every related products and orders records?");
    }

</script>
@endsection