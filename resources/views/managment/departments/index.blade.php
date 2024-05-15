@extends('layouts.master')
@section('content')
    <departments></departments>
    {{-- @if (session()->has('status'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h1>Departments</h1>
        </div>
        <div class="col-md-6">
            <a href="{{ route('departments.create') }}" class="btn btn-dark mt-2 float-right">Create New Department</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Director</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td> {{ $loop->index + 1 }} </td>
                                <td> {{ $department->name }} </td>
                                <td>{{ $department->director_id }}</td>
                                <td>
                                    <div class="d-inline-block">
                                        <a href="{{ route('departments.edit', ['department' => $department->id]) }}"
                                            class="btn btn-warning mr-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <form method="POST" class="d-inline-block"
                                        action="{{ route('departments.destroy', ['department' => $department->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group">
                                            <button class="btn btn-danger mr-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
@endsection
