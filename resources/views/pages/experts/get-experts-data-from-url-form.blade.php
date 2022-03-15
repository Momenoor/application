@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('expert.parse-data')}}" method="POST">
                @csrf
                <div class="mb-10">
                    <label class="form-label">Data URL</label>
                    <input type="text" name="data-url" class="form-control" placeholder="http://example.com">
                </div>
                <button type="submit" class="btn btn-info">Get</button>
            </form>
        </div>
    </div>
    {{-- Inject Scripts --}}
@endsection
