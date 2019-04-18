@extends('layout.master')
@section('content')
    <div id="home_page">
        @include('layout.slider')
        @include('page.new_book')
        @include('page.subscribe')
        @include('page.all_book')
        @include('page.blog')
        @include('page.best_seller')
    </div>
@endsection