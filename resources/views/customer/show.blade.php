@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <h2 class="text-center mb-3">{{ __('text.customer') }}</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-danger">{{ __('text.name') }}</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th class="table-danger">{{ __('text.phone') }}</th>
                            <td>{{ $customer->phone }}</td>

                        </tr>
                        <tr>
                            <th class="table-danger">{{ __('text.id') }}</th>
                            <td>{{ $customer->id_number }}</td>
                        </tr>
                        <tr>
                            <th class="table-danger">{{ __('text.reservations') }}</th>
                            <td>{{ count($customer->reservations) }}</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="col-md-7">
                <h2 class="text-center mb-3">{{ __('text.reservations') }} </h2>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>{{ __('text.from') }}</th>
                            <th>{{ __('text.to') }}</th>
                            <th>{{ __('text.cost') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $res = $customer->reservations()->paginate(20);
                        @endphp
                        @foreach ($res as $item)
                            <tr>
                                <td><a href="{{ route('reservation.show', $item->id) }}">{{ $i }}</a></td>
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
