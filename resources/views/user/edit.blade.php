@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('place.update') }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="justify-content-center row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ route('image.show', $user->profile->avatar) }}" alt="" width="200px"
                                height="200px">
                            <input type="file" class="form-control mt-2" name="avatar" id="avatar">
                            <button class="btn btn-danger w-100 mt-2" type="submit">{{ __('text.save') }}</button>
                        </div>
                        <div class="col-md-8 row">

                            <div class="col-md-4">
                                <label for="name">{{ __('text.name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" name="name" id="name"
                                    placeholder="{{ __('text.name') }}" value="{{ $user->name }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="name">{{ __('text.email') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" class="form-control mb-2" name="email" id="email"
                                    placeholder="{{ __('text.email') }}" value="{{ $user->email }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="name">{{ __('text.phone') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" class="form-control mb-2" name="phone" id="phone"
                                    placeholder="{{ __('text.phone') }}" value="{{ $user->phone }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="name">{{ __('text.address') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" name="address" id="address"
                                    placeholder="{{ __('text.address') }}" value="{{ $user->address }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="name">{{ __('text.link') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mb-2" name="link" id="link"
                                    placeholder="{{ __('text.link') }}" value="{{ $user->link }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="name">{{ __('text.defulthours') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" class="form-control mb-2" name="defult_reservation_hours"
                                    id="defult_reservation_hours" placeholder="{{ __('text.defulthours') }}"
                                    value="{{ $user->defult_reservation_hours }}" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ route('image.show', $user->profile->pic1) }}" alt="" width="200px"
                                height="200px">
                            <input type="file" class="form-control m-2" name="pic1" id="pic1">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ route('image.show', $user->profile->pic2) }}" alt="" width="200px"
                                height="200px">
                            <input type="file" class="form-control m-2" name="pic2" id="pic2">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ route('image.show', $user->profile->pic3) }}" alt="" width="200px"
                                height="200px">
                            <input type="file" class="form-control m-2" name="pic3" id="pic3">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ route('image.show', $user->profile->pic4) }}" alt="" width="200px"
                                height="200px">
                            <input type="file" class="form-control m-2" name="pic4" id="pic4">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
