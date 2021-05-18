@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <form action="/admin/import" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name ="files">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
