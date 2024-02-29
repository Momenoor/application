@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{__('app.commissions')}}
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('commissions.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-5">
                    <div class="col-12">
                        <label for="file" class="form-label">الملف</label>
                        <input type="file" id="file" name="file" class="form-control">
                        @error('file')
                        <span class="text-dander">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        @include('common._form_buttons')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
