@extends('layouts.app')

@section('content')
    <style>
        .footer-container {
            max-width: 100%;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
            padding: 16px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: auto;
            text-align: center;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="text-center mb-3">Reservations</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>Customer</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($res as $item)
                            <tr>
                                <td><a href="{{ route('reservation.show', $item->id) }}">{{ $i }}</a></td>
                                <td><a
                                        href="{{ route('customer.show', $item->customer_id) }}">{{ $item->customer->name }}</a>
                                </td>
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
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">
            <form action="{{ route('reservation.filter') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <label for="from">From:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="from" id="from">
                    </div>
                    <div class="col-md-1">
                        <label for="to">To:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" name="to" id="to">
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" class="form-check-input" checked name="end" id="end">
                        <label for="end">Contain To of the Reservations:</label>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-danger w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </footer>
@endsection
