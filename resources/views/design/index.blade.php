@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newDesignModal">
                            +Add New Design
                        </button>
                    <h4>Designs</h4>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
        {!! implode('', $errors->all('<p class="bg-danger">:message</p>')) !!}
@endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Design</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($designs as $key => $design)

                                @if($key>0)
                                <tr>
                                    <td> <img src="/storage/designs/{{ $design->path }}" class="img-fluid design-image"/> &nbsp; &nbsp;  {{ $design->name }}</td>

                                    <td>
                                        <!-- <button onclick="stockEdit({{ $design->id }})" class="btn btn-info">Edit</button> -->

                                        <form action="{{ route('design.destroy',$design->id) }}" method="post" style="display:inline;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            <input type="hidden" name="filename" value="{{ $design->path }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 <!-- Modal for Add New Items -->

<div class="modal fade" id="newDesignModal" tabindex="-1" role="dialog" aria-labelledby="newDesignModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newDesignModalLabel">Add New Design</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/design" id="newdesign" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>

            <div class="form-group">
                <label for="gender">Select Picture:</label>
                <input type="file" name="design" class="form-control" id="design">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="document.getElementById('newdesign').submit();" class="btn btn-primary">Submit</button>
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

@endsection
