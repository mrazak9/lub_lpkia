@extends('layouts.backend')

@section('title', ' Mean')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Mean Detail</h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="code">Nama:</label>
                            <p>{{ $student->user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="code">NIM:</label>
                            <p>{{ $student->code }}</p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <p>{{ $student->user->email }}</p>
                        </div>
                        <div class="form-group">
                            <label for="classroom">Kelas:</label>
                            <p>{{ $student->classroom }}</p>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi:</label>
                            <p>{{ $student->prodi }}</p>
                        </div>
                        <div class="form-group">
                            <label for="deleted_at">Deleted At:</label>
                            <p>{{ $student->deleted_at }}</p>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
