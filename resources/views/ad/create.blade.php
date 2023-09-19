@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>{{ __('text.ad') }}</h1>
                <form action="{{ route('ad.store') }}" method="post">
                    @csrf
                    <input type="file" name="pic" id="pic" required>
                    <button type="submit">{{ __('text.save') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
