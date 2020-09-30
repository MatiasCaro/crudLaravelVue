@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestion de usuarios</div>
                <div class="card-body">
                    <crud-component />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
