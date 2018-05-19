@extends('layouts.app')

@section('content')

	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                       
                        <a href="/export/customers" class="btn btn-info pull-right export-button">Export</a>
                    <h4>Customers</h4>
                </div>
                <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-striped" id="customers">
                        <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td class="id_input"></td>
                                <td class="input_box"></td>
                                <td class="input_box"></td>
                                <td class="input_box"></td>
                                <td class="input_box"></td>
                                <td class="input_box"></td>
                            </tr>
                        </tfoot>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>


    <script>

  $(document).ready(function() {

    $('#customers').DataTable({
        processing: true,
        serverSide: true,

        ajax: "{{ route('datatables.customerdata') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'email', name: 'email'},
            { data: 'remark', name: 'remark'}
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


@endsection