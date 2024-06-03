@extends('layouts.master')
@section('content')
    <h1>Edit Departement</h1>
    <form method="POST" action="{{ route('departments.update', ['department' => $department->id]) }}">
        @csrf
        @method('PUT')

        @include('managment.departments.form')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-warning float-right">

                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
