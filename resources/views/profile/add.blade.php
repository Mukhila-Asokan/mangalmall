@extends('profile-layouts.profile')
@section('content')
<div class="col-md-10">
    <h4 class="font-semibold text-gray-900 mt-3">{{ __('Profile Information') }}</h4>
    <form method="post" action="{{ route('profile.update') }}" class="card p-3">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" 
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" 
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="col-12">
                    <p class="text-muted">{{ __('Your email address is unverified.') }}</p>
                    <button form="send-verification" class="btn btn-link p-0">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success mt-2">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>
                @if (session('status') === 'profile-updated')
                    <span class="text-success ms-3">{{ __('Saved.') }}</span>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection