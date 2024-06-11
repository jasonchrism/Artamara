@extends('layouts.details')

@section('title')
    details
@endsection
    <h1>{{$product->title}}</h1>
    <img src="{{$product->thumbnail}}" alt="">
@section('content')
    
@endsection
