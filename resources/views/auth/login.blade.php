@extends('app')

@section('app_content')
<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome to Garagiste</h3>
                </div>
                <div class="card-body">
                  <form role="form"method="post" action="{{ route('login.perform') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <label>Username</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" name="username" id="username" placeholder="username" aria-label="username" aria-describedby="username-addon">
                      @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password"  aria-label="Password" aria-describedby="password-addon">
                      @if ($errors->has('password'))
                      <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                  @endif
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">Forgot you password? Reset you password 
                  <a href="{{ route('forget.password.get') }}">Reset Password</a>
                </small>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection