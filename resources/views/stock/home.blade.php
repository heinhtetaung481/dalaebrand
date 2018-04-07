@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newItemModal">
                            +Add New Item
                        </button>
                    <h4>Stock</h4>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
        {!! implode('', $errors->all('<p class="bg-danger">:message</p>')) !!}
@endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td> {{ $item->itemtype->name }}</td>
                                    <td>{{ $item->itemtype->gender }}  {{ $item->itemtype->type }}</td>
                                    <td> {{ $item->color }}</td>
                                    <td> {{ $item->size }}</td>
                                    <td> {{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <button onclick="stockEdit({{ $item->id }})" class="btn btn-info">Edit</button>
                                        
                                        <form action="{{ route('stock.destroy',[$item->id]) }}" method="post" style="display:inline;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal for Add New Items -->

<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newItemModalLabel">Add New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/stock" id="newitem">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" id="gender" onchange="checkGender()">
                    <option selected>Choose Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="type">Item Type:</label>
                <select class="form-control" name="type" id="type">
                    
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" name="color" class="form-control" id="color">
            </div>

            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" name="size" class="form-control" id="size">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" class="form-control" id="price">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" class="form-control" id="quantity">
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

<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="edititem">

            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" id="editName">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" id="editGender" onchange="checkEditGender()">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="type">Item Type:</label>
                <select class="form-control" name="type" id="editType">
                    
                </select>
            </div>

            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" name="color" class="form-control" id="editColor">
            </div>

            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" id="editSize" class="form-control" name="size">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="editPrice" class="form-control" name="price">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" id="editQuantity" class="form-control" name="quantity">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="document.getElementById('edititem').submit();" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>

<script>

    function stockEdit(id){

        $.ajax(
        {
            url:"stock/"+id+"/edit",
            type:'GET',
    
        }).done(
            function (data){
                $("#edititem").attr("action","/stock/"+data[0].id);
                $("#editName").val(data[0].name);
                $("#editGender option[value="+data[0].gender+"]").prop('selected',true).trigger('change');
                $("#editType option[value="+data[0].type+"]").prop('selected', true);
                $("#editColor").val(data[0].color);
                $("#editSize").val(data[0].size);
                $("#editPrice").val(data[0].price);
                $("#editQuantity").val(data[0].quantity);
                //$("input[name='");
                $("#editItemModal").modal("show");

            }
        )
    }

    function checkGender(){
        var gender = $('#gender').val();
        if(gender){
        $.ajax({
            url:'/order/gender/'+gender,
            type:'GET',
            success:function(data){

                $('#type').empty();
                $('#type').append($('<option selected>Choose Item Type</option>'));
                for(i=0; i< data.length; i++){

                $('#type').append($('<option value='+data[i].id+'>'+data[i].type+'</option>'));
            }
            }

        })
        }
    }

    function checkEditGender(){
        var gender = $('#editGender').val();
        if(gender){
        $.ajax({
            url:'/order/gender/'+gender,
            type:'GET',
            success:function(data){

                $('#editType').empty();
                $('#editType').append($('<option selected>Choose Item Type</option>'));
                for(i=0; i< data.length; i++){

                $('#editType').append($('<option value='+data[i].id+'>'+data[i].type+'</option>'));
            }
            }

        })
        }
    }

</script>

@endsection
