@extends('layouts.app')

@section('content')
    <style>
        #today {
            border: 2px solid black;
        }

        form {
            border-right: solid;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="px-5" action="{{ route('reservation.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        @php
                            $firstDayOfday = new DateTime(date($day));
                            $day = $firstDayOfday->format('d');
                        @endphp
                        <label for="date">{{ __('text.from') }}:</label>
                        <input type="datetime-local" class="form-control" name="from" id="from"
                            value="{{ $firstDayOfday->format('Y-m-d\T00:00') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="date">{{ __('text.to') }}:</label>
                        <input type="datetime-local" class="form-control" name="to" id="to" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">{{ __('text.name') }}:</label>
                        <input type="text" class="form-control" name="name" id="name" required
                            placeholder="{{ __('text.name') }}" autofocus>
                    </div>
                    <div class="form-group mb-2">
                        <label for="id">{{ __('text.phone') }}:</label>
                        <input type="number" class="form-control" id="phone" name="phone" required
                            placeholder="{{ __('text.phone') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="id">{{ __('text.id') }}:</label>
                        <input type="number" class="form-control" name="id" id="id" required
                            placeholder="{{ __('text.id') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="id">{{ __('text.cost') }}:</label>
                        <input type="number" class="form-control" name="cost" step="0.1" id="cost" required
                            placeholder="{{ __('text.cost') }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger w-100" type="submit">{{ __('text.save') }}</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form class="mb-3" action="{{ route('home') }}" method="get">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <input class="form-control" type="date" name="day" id="day"
                                value="{{ $firstDayOfday->format('Y-m-d') }}">
                        </div>
                        <button class="btn btn-danger col-md-2" type="submit">{{ __('text.select') }}</button>
                    </div>
                </form>
                @php
                    $d = ['Sat' => 0, 'Sun' => 1, 'Mon' => 2, 'Tue' => 3, 'Wed' => 4, 'Thu' => 5, 'Fri' => 6];
                    $firstDayOfday = new DateTime(date($firstDayOfday->format('Y-m-01')));
                    $i = $d[$firstDayOfday->format('D')];
                    $number_of_days = cal_days_in_month(CAL_GREGORIAN, $firstDayOfday->format('m'), $firstDayOfday->format('Y'));
                    $d = 0;
                @endphp
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>{{ __('text.sat') }}</th>
                            <th>{{ __('text.sun') }}</th>
                            <th>{{ __('text.mon') }}</th>
                            <th>{{ __('text.tue') }}</th>
                            <th>{{ __('text.wed') }}</th>
                            <th>{{ __('text.thu') }}</th>
                            <th>{{ __('text.fri') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($j = 0; $j < 6; $j++)
                            <tr>
                                @for ($k = 0; $k < $i; $k++)
                                    <td></td>
                                @endfor
                                @for ($k = $i; $k < 7; $k++)
                                    @if (++$d <= $number_of_days)
                                        <td @if ($d == $day) id="today" @endif>
                                            <a
                                                href="{{ env('APP_URL') }}home?day={{ $firstDayOfday->format('Y-m') . '-' . $d }}">
                                                {{ $d }}
                                            </a>
                                        </td>
                                    @endif
                                @endfor
                            </tr>
                            @php
                                $i = 0;
                            @endphp
                        @endfor
                    </tbody>
                </table>
                <h5>{{ __('text.reservations') }}</h5>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>{{ __('text.name') }}</th>
                            <th>{{ __('text.from') }}</th>
                            <th>{{ __('text.to') }}</th>
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
@endsection

@section('script')
    <script>
        $(function() {
            $('#from').change(function(e) {
                set();
            });

            $('#from').keyup(function(e) {
                set();
            });

            function set() {
                var d = moment(new Date($('#from').val()))
                    .add('{{ Auth::user()->defult_reservation_hours }}', 'hours').format('YYYY-MM-DDTHH:mm');
                $('#to').val(d);
            }
        });
    </script>
@endsection
