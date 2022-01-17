@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body auth-section">
                        <div class="row">
                            <div class="col-12 text-center mt-2 mb-3">
                                <i class="fa fa-user-plus change-password-icon"></i>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12 p-0">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        placeholder="{{ __('Username') }}" value="{{ old('username') }}" required
                                        autocomplete="username" maxlength="20" autofocus>
                                    <span class="focus-border"></span>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 p-0">
                                    <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" maxlength="50" required autocomplete="email">
                                    <span class="focus-border"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 p-0">
                                    <select id="gender" placeholder="{{ __('Gender') }}"
                                        class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                        <option value="">--Select--</option>
                                        <option value="man" {{ old('gender') == 'man' ? 'selected' : '' }}>Man</option>
                                        <option value="woman" {{ old('gender') == 'woman' ? 'selected' : '' }}>Woman
                                        </option>
                                    </select>
                                    <span class="focus-border"></span>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 p-0">
                                    <input id="password" placeholder="{{ __('Password') }}" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password" maxlength="50"
                                        required autocomplete="new-password">
                                    <span class="focus-border"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 p-0">
                                    <input id="password-confirm" placeholder="{{ __('Confirm Password') }}"
                                        type="password" class="form-control" name="password_confirmation" maxlength="50" required
                                        autocomplete="new-password">
                                    <span class="focus-border"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label>
                                    By clicking Register you certify that you are over
                                    {{ getSetting('MINIMUM_AGE') }} years old and accept our <a href="http://localhost:8000/terms-and-conditions"
                                        target="_blank">Terms &amp; Conditions</a> and our
                                    <a href="http://localhost:8000/privacy-policy" target="_blank">Privacy Policy</a>.
                                </label>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-0">
                                    <button type="submit" class="btn btn-theme w-100">
                                        {{ __('Register') }}
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
