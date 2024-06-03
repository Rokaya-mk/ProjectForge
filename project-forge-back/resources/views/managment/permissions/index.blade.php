@extends('layouts.master')
@section('content')
    @if (session()->has('status'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h1>Permissions</h1>
        </div>
        <div class="col-md-6">
            <a href="{{ route('permissions.create') }}" class="btn btn-success mt-2 float-right">Create New Permission</a>
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
                            <th>Display Name</th>
                            <th>Description</th>
                            @canany(['permissions-update', 'permissions-delete'])
                                <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->display_name}}</td>
                                <td>{{$permission->description}}</td>
                                <td>
                                    @can('permissions-update')
                                    <div class="d-inline-block">
                                        <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                                            class="btn btn-success mr-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    @endcan 
                                    @can('permissions-delete') 
                                    <form method="POST" class="d-inline-block"
                                        action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-group">
                                            <button class="btn btn-danger mr-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
