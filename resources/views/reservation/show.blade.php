@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-3">{{ __('text.reservation') }}</h2>
                <hr>
                <form action="{{ route('reservation.update', $reservation->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table-danger">#</th>
                                <td>{{ $reservation->id }}</td>
                            </tr>
                            <tr>
                                <th class="table-danger">{{ __('text.customer') }}:</th>
                                <td><a
                                        href="{{ route('customer.show', $reservation->customer_id) }}">{{ $reservation->customer->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-danger">{{ __('text.from') }}:</th>
                                <td><input class="form-control" type="datetime-local" name="from" id="form"
                                        value="{{ $reservation->from->format('Y-m-d H:i') }}" autofocus required>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-danger">{{ __('text.to') }}:</th>
                                <td><input class="form-control" type="datetime-local" name="to" id="to"
                                        value="{{ $reservation->to->format('Y-m-d H:i') }}" required></td>
                            </tr>
                            <tr>
                                <th class="table-danger">{{ __('text.cost') }}:</th>
                                <td><input class="form-control" type="number" name="cost" id="cost" required
                                        value="{{ $reservation->cost }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-danger w-100" type="submit">{{ __('text.save') }}</button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
