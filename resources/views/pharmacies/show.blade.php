@extends('adminlte::page')

@section('title', 'pharmacies')

@section('content_header')
    <center><h2>{{ $pharmacy->name }}</h2></center>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">Name: {{$pharmacy->name}}</div>
            <div class="card-body">Owner National ID: {{$pharmacy->owner_nat_id}}</div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Adress:</td>
                        <td></td>
                        <td>Street Name:</td>
                        <td></td>
                        <td></td>
                        <td>{{ $pharmacy->street_name }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Building Number:</td>
                        <td></td>
                        <td></td>
                        <td>{{ $pharmacy->building_number }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Area:</td>
                        <td></td>
                        <td></td>
                        <td>{{ $pharmacy->area_id }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Priority Area:</td>
                        <td></td>
                        <td></td>
                        <td>{{ $pharmacy->priority_area_id }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop