@extends('adminlte::page')

@section('title', 'pharmacies')

@section('content_header')
<a href="{{route('pharmacies.create')}}" class="btn btn-success">Add pharmacy</a>
<center><h2>Pharmacies</h2></center>
@stop

@section('content')
<table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Owner National Id</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pharmacies as $pharmacy)
                        <tr>
                            <th scope="row">{{ $pharmacy->id }}</th>
                            <td>{{ $pharmacy->name }}</td>
                            <td>{{ $pharmacy->owner_nat_id }}</td>
                            <td>
                                <a href="{{route('pharmacies.show',['pharmacy' => $pharmacy->id])}}" type="button" class="btn btn-primary btn-xs">View</a>                                
                                <a type="button" class="btn btn-primary btn-xs">Edit</a>
                                <a type="button" class="btn btn-danger btn-xs">Delete</a>
                            </td>   
                        </tr>
                    @endforeach
              </tbody>
            </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop