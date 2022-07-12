@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Add Image') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        <!--Grid column-->
                        <div class="col-md-6 mb-4 mx-auto">
                            <div class="file-field">
                                <div class="z-depth-1-half mb-4">
                                    <img src="" class="img-fluid" alt="example placeholder">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn btn-mdb-color btn-rounded float-left">
                                        <input id="image_path" name="image_path" type="file" require>

                                        @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="description_img">Description:</label>
                            <textarea class="form-control" id="description_img" name="description_img" rows="4"></textarea>

                            @error('description_img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="row mb-0">
                            <div class="col-md-3  mx-auto" >
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Publish image') }}
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