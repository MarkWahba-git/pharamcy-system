@extends('adminlte::page')

@section('title', 'pharmacies')

@section('content_header')

@stop

@section('content')

<div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" method="post" action="{{route('pharmacies.store')}}">
            @csrf
            <div class="form-group">
                <label class="control-label col-sm" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter pharmacy's name" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm" for="street name">Street Name</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" id="street_name" placeholder="Enter street's name" name="street_name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm" for="building number">Building Number</label>
                <div class="col-sm-10">          
                    <input type="number" class="form-control" id="building_number" placeholder="Enter building number" name="building_number" required>
                </div>
            </div>
            <label class="control-label col-sm" for="users">Owner</label>
            <select class="form-control" id="users">
            @foreach($users as $user)
                <option value={{$user->owner_id}}>{{$user->name}}</option>
            @endforeach
            </select>
            <br>
            <label class="control-label col-sm" for="areas">Area</label>
            <select class="form-control" id="areas">
            @foreach($areas as $area)
                <option value={{$area->id}}>{{$area->name}}</option>
            @endforeach
            </select>
            <label class="control-label col-sm" for="priority_area">Priority Area</label>
            <select class="form-control" id="areas">
            @foreach($areas as $area)
                <option value={{$area->id}}>{{$area->name}}</option>
            @endforeach
            </select>
            <br>
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop