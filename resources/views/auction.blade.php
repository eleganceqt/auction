@extends('layouts.master')

@section('content')

    <div class="container">

        <auction-details :auction="{{ $auction }}" :user="{{ auth()->user() ? : 'null' }}"></auction-details>

    </div>
@endsection




