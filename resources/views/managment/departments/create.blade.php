@extends('layouts.master')
@section('content')
    <h1>Create New Departement</h1>
    <form method="POST" action="{{ route('departments.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value ="{{ old('name') }}">
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label for="director_id">Director</label>
                    <select name="director_id" class="form-control" id="">
                        <option>Select a person</option>
                        <option value="1" @selected(old('director_id') == 1)>IT Director</option>
                        <option value="2" @selected(old('director_id') == 2)>HR Director</option>
                    </select>
                </div>
            </div> --}}
        </div>
        {{--  start show errors --}}
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        @endif
        {{--  End show errors --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-success float-right">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
