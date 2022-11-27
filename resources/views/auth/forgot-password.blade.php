{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Fashion</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url({{ asset('assets/login') }}/images/bg-1.jpg);">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Forget Password</h3>
                            </div>
                            {{-- <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#"
                                        class="social-icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-facebook"></span></a>

                                </p>
                            </div> --}}
                        </div>
                        <x-jet-validation-errors class="mb-4 text-danger" />
                        <div class="text-center mb-4">Forgot your password? No problem. Just let us know your email
                            address
                            and we will email you a password reset link that will allow you to choose a new one.</div>
                        <form action="{{ route('password.email') }}" class="signin-form" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="E-Mail"
                                    :value="old('email')" required autofocus>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Send New
                                    Password</button>
                            </div>
                            {{-- <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                        <input type="checkbox" name="remember" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                            </div> --}}
                        </form>
                        <p class="text-center">Not a member? <a href="{{ route('register') }}">Sign
                                Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
