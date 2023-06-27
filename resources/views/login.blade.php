  @extends('layouts.head')
  @section('title', 'Login')

  @section('content')
      {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
      <div>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          @if (session('status'))
              <script>
                  swal("{{ session('status') }}");
              </script>
          @endif
      </div>
      <div class="col-lg-7">
          <div class="right_container centredH">
              <div>

                  <div class="d-flex">
                      <img src="img/login.png" alt="">
                      <p class="title ml-2">
                          Login
                      </p>
                  </div>


                  <p class="desc mt-2">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem vulputate ac, volutpat cursus.
                  </p>
                  <div class="card">
                      <form method="post" action="{{ route('log') }}">
                          @csrf
                          <div class="row">
                              <div class="card-body">
                                  <h5>Login to continue shopping with us</h5>
                                  <hr>

                                  <div class="col-md-6 mb-3">
                                      <label for="email" class="form-label">{{ __('Email') }}</label>
                                      <input v-model="userData.email" type="email" name="email" placeholder="Email"
                                          autocomplete="email" required
                                          class="form-control @error('lastname') is-invalid @enderror"
                                          value="{{ old('lastname') }}" autofocus>

                                      @error('lastname')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror

                                  </div>


                                  <div class="col-md-6 mb-3">
                                      <label for="password" class=" col-form-label">{{ __('Password') }}</label>
                                      <input v-model="userData.password" type="password" name="password"
                                          placeholder="Password" autocomplete="password" required
                                          class="form-control @error('password') is-invalid @enderror"
                                          value="{{ old('password') }}" autofocus>

                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror

                                  </div>
                              </div>

                          </div>
                          <p class="desc mt-2 ml-1">
                              <a href="#">Forgot Password?</a>
                          </p>

                          <div class="col-md-6">
                              <button type="submit" class="btn btn-primary form-control mb-3">Login</button>
                          </div>
                          <!-- </Link> -->

                      </form>
                  </div>

                  {{-- <script>
                      < Link: href = "url('/')" >
                          <
                          p class = "desc mt-4 ml-1" >
                          <
                          span > Don’ t have an account ? Register now < /span> < /
                          p > <
                          /Link>
                  </script> --}}

              </div>
          </div>
      </div>
  @endsection
