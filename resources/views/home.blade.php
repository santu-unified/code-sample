@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @foreach (['error', 'warning', 'success'] as $msg)
                      @if(Session::has($msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
                      @endif
                    @endforeach

                    @if(Auth::user())
                    <div class="card-body">
                    <form method="POST" action="{{ route('user-update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')? old('name'):$userData->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth (yyyy-mm-dd)') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob')? old('dob'):$userData->dob }}">
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="custom1" class="col-md-4 col-form-label text-md-right">{{ __('Custom1') }}</label>

                            <div class="col-md-6">
                                <input id="custom1" type="text" class="form-control @error('custom1') is-invalid @enderror" name="custom1" value="{{ isset($userData->userDetails->custom1)?$userData->userDetails->custom1:old('custom1') }}">
                                @error('custom1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="custom2" class="col-md-4 col-form-label text-md-right">{{ __('Custom2') }}</label>

                            <div class="col-md-6">
                                <input id="custom2" type="text" class="form-control" name="custom2" value="{{ isset($userData->userDetails->custom2)? $userData->userDetails->custom2:old('custom2') }}">
                                @error('cusom2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile image') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="profile_image" id="profile_image">
                            </div>
                            <div>
                                @if(isset($userData->profileImage->file_name) && !empty($userData->profileImage->file_name))
                                    <img src="{{ '/storage/'.config('constants.profile_thumb_path').$userData->profileImage->file_name }}">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
