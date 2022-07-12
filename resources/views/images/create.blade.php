@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Add Image') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        <!--Grid column-->
                        <div class="col-md-6 mb-4 mx-auto">
                            <div class="file-field">
                                <div class="z-depth-1-half mb-4">
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid" alt="example placeholder">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn btn-mdb-color btn-rounded float-left">
                                        <span>Choose file</span>
                                        <input type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                            <label class="form-label" for="form6Example7">Description</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection