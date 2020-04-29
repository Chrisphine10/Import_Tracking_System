@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Document') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">document name</label>
                            <div class="col-md-6">
                                <input type="text" required class="form-control" id="name" name='name'>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="image">Image</label>
                            <div class="col-md-6">
                                <input class="form-control" type="file" name="image" id="image">
                            </div>
                        </div>

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection