@extends('layouts.app')

@section('title')
401
@endsection

@section('content')
<div class="container mt-5">
    <div class="page-error">
        <div class="page-inner">
        <h1>401</h1>
        <div class="page-description">
            <h2>UNAUTHORIZED!</h2>
            Access is denied due to invalid credentials!
        </div>
        <div class="page-search">
            <div class="mt-3">
            <a href="{{ route('home') }}">Back to Home</a>
            </div>
        </div>
        </div>
    </div>
    <div class="simple-footer mt-5">
        Copyright &copy; Dest 2019
    </div>
</div>
@endsection
