@extends('layouts.main');
@section('content')

    
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
                            <td>{{ $i->quantity }}</td>
                            {{-- <td style="display:-webkit-inline-box">
                                @if ($i->deleted_at != null)
                                    <a href="{{ route('inventory.restore', $i->id) }}"
                                        class="btn btn-success btn-sm">Restore</a>
                                @else
                                    <form method="POST" action="{{ route('inventory.destroy', $i->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                                <button value="{{ $i->id }}" data-id="{{ $i->id }}"
                                    data-prod_code="{{ $i->product_code }}" data-prod_name="{{ $i->product_name }}"
                                    data-tag_number="{{ $i->tag_number }}" data-marked_price="{{ $i->marked_price }}"
                                    data-quantity="{{ $i->quantity }}" type="submit"
                                    class="btn btn-info edit-btn btn-sm ml-2">Update</button>
                            </td> --}}
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
