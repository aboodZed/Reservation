@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-3">Reservation</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-danger">#</th>
                            <td>{{ $reservation->id }}</td>
                        </tr>
                        <tr>
                            <th class="table-danger">Customer:</th>
                            <td><a
                                    href="{{ route('customer.show', $reservation->customer_id) }}">{{ $reservation->customer->name }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-danger">From:</th>
                            <td>{{ $reservation->from->format('d/m/Y - h:i a') }}</td>
                        </tr>
                        <tr>
                            <th class="table-danger">To:</th>
                            <td>{{ $reservation->to->format('d/m/Y - h:i a') }}</td>
                        </tr>
                        <tr>
                            <th class="table-danger">Cost:</th>
                            <td>{{ $reservation->cost }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
