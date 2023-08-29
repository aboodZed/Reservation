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
                        <label for="date">From:</label>
                        <input type="datetime-local" class="form-control" name="from" id="from"
                            value="{{ $firstDayOfday->format('Y-m-d\T00:00') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="date">To:</label>
                        <input type="datetime-local" class="form-control" name="to" id="to" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" required
                            placeholder="Customer name" autofocus>
                    </div>
                    <div class="form-group mb-2">
                        <label for="id">Phone Number:</label>
                        <input type="number" class="form-control" id="phone" name="phone" required
                            placeholder="Phone Number">
                    </div>
                    <div class="form-group mb-2">
                        <label for="id">ID Number:</label>
                        <input type="number" class="form-control" name="id" id="id" required
                            placeholder="ID Number">
                    </div>
                    <div class="form-group mb-3">
                        <label for="id">Cost:</label>
                        <input type="number" class="form-control" name="cost" step="0.1" id="cost" required
                            placeholder="Cost">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger w-100" type="submit">Save</button>
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
                        <button class="btn btn-danger col-md-2" type="submit">Select</button>
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
                            <th>Sat</th>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
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
                <h5>Reservations</h5>
                <table class="table">
                    <thead>
                        <tr class="table-danger">
                            <th>#</th>
                            <th>Customer</th>
                            <th>from</th>
                            <th>to</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($res as $item)
                            <tr>
                                <td><a href="{{ route('reservation.show', $item->id) }}">{{ $i }}</a></td>
                                <td><a href="{{ route('customer.show', $item->customer_id) }}">{{ $item->customer->name }}</a></td>
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
