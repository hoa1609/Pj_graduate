<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>Rizz | Rizz - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="backend/assets/images/favicon.ico">
    <link href="backend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="backend/assets/css/app.min.css" rel="stylesheet" type="text/css" />
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
                                        <a href="" class="logo logo-admin">
                                            <img src="backend/assets/images/logo-sm.png" height="50" alt="logo"
                                                class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Tạo một tài khoản</h4>
                                        <p class="text-muted fw-medium mb-0">Nhập thông tin của bạn để tạo tài khoản ngay hôm nay.</p>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <form method="POST" action="{{ route('register') }}" class="my-4">
                                        @csrf
                                        <!-- Tên -->
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="name">Họ Tên</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}"  autofocus autocomplete="name">
                                            @if ($errors->has('name'))
                                                <span class="text-danger mt-5">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}"  autocomplete="username">
                                            @if ($errors->has('email'))
                                                <span class="text-danger mt-5">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <!-- Số điện thoại -->
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone') }}" >
                                            @if ($errors->has('phone'))
                                                <span class="text-danger mt-5">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>

                                        <!-- Địa chỉ -->
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="address">Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ old('address') }}"  autocomplete="address">
                                            @if ($errors->has('address'))
                                                <span class="text-danger mt-5">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>

                                        <!-- Mật khẩu -->
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input type="password" class="form-control" id="password"
                                                name="password"  autocomplete="new-password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger mt-5">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                        <!-- Xác nhận mật khẩu -->
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation"  autocomplete="new-password">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger mt-5">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        Đăng ký <i class="fas fa-sign-in-alt ms-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <p class="text-muted">Đã có tài khoản? <a href="{{ route('login') }}"
                                                class="text-primary ms-2">Đăng nhập</a></p>
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!-- container -->
</body>

</html>
