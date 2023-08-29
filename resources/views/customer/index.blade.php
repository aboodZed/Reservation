@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="text-center mb-3">Customers</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>ID</th>
                            <th>Reservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($customers as $item)
                            <tr>
                                <td><a href="{{ route('customer.show', $item->id) }}">{{ $i }}</a></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->id_number }}</td>
                                <td>{{ count($item->reservations) }}</td>
                            </tr>
                            @php
                                ++$i;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                @php
                    $products = $customers;
                @endphp
                @include('layouts.pagination')
            </div>
        </div>
    </div>
@endsection
