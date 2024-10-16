<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>


        <meta charset="utf-8" />
                <title>Login - shop</title>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
                <meta content="" name="author" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />

                <link rel="shortcut icon" href="backend/assets/images/favicon.ico">


         <link href="backend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
         <link href="backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
         <link href="backend/assets/css/app.min.css" rel="stylesheet" type="text/css" />
         <link href="backend/assets/css/customize.css" rel="stylesheet" type="text/css" />

    </head>


    <body>
    <div class="container-xxl">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 bg-black auth-header-box rounded-top">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="backend/assets/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Bắt đầu quyền ADMIN</h4>
                                        <p class="text-muted fw-medium mb-0">Đăng nhập để thực hiện quyền.</p>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <form class="my-4" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label>Email</label>
                                            <input type="text"
                                            class="form-control"
                                            name="email"
                                            placeholder="Nhập email"
                                            value="{{ old('email') }}">
                                        </div>

                                            @if ($errors->has('email'))
                                                <label class="err-message">*
                                                        {{$errors->first('email') }}
                                                </label>
                                            @endif


                                        <div class="form-group">
                                            <label>Mật khẩu</label>
                                            <input type="password"
                                            class="form-control"
                                            name="password"
                                            placeholder="Nhập mật khẩu"
                                            value="{{ old('password') }}">
                                        </div>

                                            @if ($errors->has('password'))
                                                <label class="err-message">*
                                                        {{$errors->first('password') }}
                                                </label>
                                            @endif

                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                {{-- <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" id="customSwitchSuccess">
                                                    <label class="form-check-label" for="customSwitchSuccess">Remember me</label>
                                                </div> --}}
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Quên mật khẩu?</a>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">Đăng nhập <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center  mb-2">
                                        <p class="text-muted">Bạn chưa có tài khoản ?  <a href="{{route('register')}}" class="text-primary ms-2">Đăng ký</a></p>
                                        <h6 class="px-3 d-inline-block">Hoặc đăng nhập với</h6>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="d-flex justify-content-center align-items-center thumb-md bg-blue-subtle text-blue rounded-circle me-2">
                                            <i class="fab fa-facebook align-self-center"></i>
                                        </a>
                                        <a href="#" class="d-flex justify-content-center align-items-center thumb-md bg-info-subtle text-info rounded-circle me-2">
                                            <i class="fab fa-twitter align-self-center"></i>
                                        </a>
                                        <a href="#" class="d-flex justify-content-center align-items-center thumb-md bg-danger-subtle text-danger rounded-circle">
                                            <i class="fab fa-google align-self-center"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

</html>
