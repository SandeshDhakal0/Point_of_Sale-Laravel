@extends('layouts.main');
@section('content')
    
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add to Inventory </h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="product_code" class="form-control input-default " placeholder="Product code">
                    </div>
                    {{-- <div class="form-group">
                        <input type="text" class="form-control input-rounded" placeholder="input-rounded">
                    </div> --}}
                    <div class="form-group">
                        <input type="text" name="product_name" class="form-control input-default " placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tag_number" class="form-control input-default " placeholder="Tag Number">
                    </div>
                    <div class="form-group">
                        <input type="text" name="marked_price" class="form-control input-default " placeholder="Marked Price">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>    

</div>


@endsection