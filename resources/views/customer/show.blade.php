@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="text-center mb-3">Customer</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>Name</th>
                            <th>Phone</th>
                            <th>ID</th>
                            <th>Reservations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->id_number }}</td>
                            <td>{{ count($customer->reservations) }}</td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
                <h2 class="text-center mb-3">Reservations of Customer</h2>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>Customer</th>
                            <th>from</th>
                            <th>to</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $res = $customer->reservations()->paginate(1);
                        @endphp
                        @foreach ($res as $item)
                            <tr>
                                <td><a href="{{ route('reservation.show', $item->id) }}">{{ $i }}</a></td>
                                <td><a href="{{ route('customer.show', $item->id) }}">{{ $item->customer->name }}</a></td>
                                <td>{{ $item->from->format('d/m/Y - h:i a') }}</td>
                                <td>{{ $item->to->format('d/m/Y - h:i a') }}</td>
                                <td>{{ $item->cost }}</td>
                            </tr>
                            @php
                                ++$i;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                @php
                    $products = $res;
                @endphp
                @include('layouts.pagination')
            </div>
        </div>
    </div>
@endsection
