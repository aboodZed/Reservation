@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ route('image.show', $user->profile->avatar) }}" alt="" width="200px"
                            height="200px">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <td><label for="name">{{ __('text.name') }}:</label></td>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td><label for="phone">{{ __('text.phone') }}:</label></td>
                                <td>
                                    {{ $user->phone }}
                                </td>
                            </tr>
                            <tr>
                                <td><label for="address">{{ __('text.address') }}:</label></td>
                                <td>
                                    {{ $user->address }}
                                </td>
                            </tr>
                            <tr>
                                <td><label for="link">{{ __('text.link') }}:</label></td>
                                <td>
                                    <a href="{{ $user->link }}" target="_blank"
                                        rel="noopener noreferrer">{{ $user->link }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="defult_reservation_hours">{{ __('text.defulthours') }}:</label></td>
                                <td>
                                    {{ $user->defult_reservation_hours }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <img src="{{ route('image.show', $user->profile->pic1) }}" alt="" width="200px"
                            height="200px">
                    </div>
                    <div class="col-md-6 mb-3">
                        <img src="{{ route('image.show', $user->profile->pic2) }}" alt="" width="200px"
                            height="200px">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ route('image.show', $user->profile->pic3) }}" alt="" width="200px"
                            height="200px">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ route('image.show', $user->profile->pic4) }}" alt="" width="200px"
                            height="200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
