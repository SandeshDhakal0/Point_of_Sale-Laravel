@extends('layouts.main');
@section('content')

    <!-- Button trigger modal -->
    <div class="container c">
        <div class="container d">
          <div class="row">
            <div class="col">
        <button type="button" class="btn btn-primary p-2" data-toggle="modal" data-target="#exampleModal">
            Add Product
        </button>
      </div>
      <div class="col">
        <a class="btn btn-secondary" href="{{route('inventory.index',['view_deleted'=>'DeletedRecords'])}}">View Removed Products</a>
      </div>
      <div class="col">
        <a class="btn btn-info" href="{{route('inventory.index')}}">Back</a>
      </div>
      </div>
    </div>
        <br>
        @if (session()->has('success'))
        <div id="flashmessage" class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <script>
      setTimeout(function () {
              $("#flashmessage").hide();
          }, 3000);
        </script>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="card" style="height: 60%">
                                <div class="card-header">
                                    <h4 class="card-title">Add to Inventory </h4>                                   
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form action="{{ route('inventory.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="integer" name="product_code"
                                                    class="form-control input-default " placeholder="Product code">
                                            </div>
                                            {{-- <div class="form-group">
                                    <input type="text" class="form-control input-rounded" placeholder="input-rounded">
                                </div> --}}
                                            <div class="form-group">
                                                <input type="text" name="product_name"
                                                    class="form-control input-default " placeholder="Product Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="tag_number" class="form-control input-default "
                                                    placeholder="Tag Number">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="marked_price"
                                                    class="form-control input-default " placeholder="Marked Price">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="quantity" class="form-control input-default "
                                                    placeholder="Total Quantity">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Tag Number</th>
                    <th scope="col">Marked Price (Rs)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>

            <tbody>
                @if (count($inventory) > 0)
                    @foreach ($inventory as $i)
                        <tr>
                            <th>{{ $i->product_code }}</th>
                            <td>{{ $i->product_name }}</td>
                            <td>{{ $i->tag_number }}</td>
                            <td>Rs.{{ $i->marked_price }}</td>
                            <td>{{$i->quantity}}</td>
                            <td style="display:-webkit-inline-box">
                              @if($i->deleted_at != null)
                              <a href="{{route('inventory.restore',$i->id)}}" class="btn btn-success btn-sm">Restore</a>
                              @else
                                <form method="POST" action="{{ route('inventory.destroy', $i->id) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif
                                <input type="hidden" name="_method" value="UPDATE"/>
                                <button type="submit" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#exampleModal" >Update</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No Post Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>


@endsection
