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
                            <label for="min_value">Min Value:</label>
                            <p>{{ $mean->min_value }}</p>
                        </div>
                        <div class="form-group">
                            <label for="max_value">Max Value:</label>
                            <p>{{ $mean->max_value }}</p>
                        </div>
                        <div class="form-group">
                            <label for="statement">Statement:</label>
                            <p>{{ $mean->statement }}</p>
                        </div>
                        <div class="form-group">
                            <label for="deleted_at">Deleted At:</label>
                            <p>{{ $mean->deleted_at }}</p>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('means.edit', $mean->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('means.destroy', $mean->id) }}" method="POST" style="display: inline">
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
