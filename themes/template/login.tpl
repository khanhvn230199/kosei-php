<!-- header for about page-->
<!DOCTYPE html>
<html lang="vi">
    <head>
        <title>Title</title>
        <meta charset="utf-8" />
        <meta name="description" content="Description" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- vendor style-->
        <link rel="stylesheet" href="./vendor/font-awesome-4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="./vendor/swiper/css/swiper.min.css" />
        <link rel="stylesheet" href="./vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
        <link rel="stylesheet" href="./vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css" />
        <!-- custom style-->
        <link rel="stylesheet" href="./css/style.css" />
    </head>
    <body>
        <!-- main content-->
        <div class="login-page">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <a class="login-logo" href="#!">
                        <img src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <img class="d-block w-100" src="images/login-large-img.png" alt="">
                    </div>
                    <div class="col-lg-6 pt-30">
                        <ul class="nav login-nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#registration" role="tab" data-toggle="tab">
                                    <img class="icon mr-1" src="images/icon-user-plus.png" alt="">
                                    <img class="icon-white mr-1" src="images/icon-user-plus-white.png" alt="">
                                    <span>Tạo tài khoản</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#login" role="tab" data-toggle="tab">
                                    <img class="icon mr-1" src="images/icon-login.png" alt="">
                                    <img class="icon-white mr-1" src="images/icon-login-white.png" alt="">
                                    <span>Đăng nhập</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="registration" role="tabpanel">
                                <form class="login-form" action="#!">
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Họ và tên</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Tên đăng nhập</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Mật khẩu</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Nhập lại mật khẩu</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Mã xác nhận</label>
                                        <div class="col-md-9">
                                            <div class="form-row">
                                                <div class="col-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-row h-100">
                                                        <div class="col-8">
                                                            <div class="captcha-img">
                                                                <img src="images/captcha-img.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <a class="captcha-btn" href="#!">
                                                                <img src="images/icon-undo.png" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center py-2">
                                        <button class="btn btn-gradient btn-md btn-circle font-weight-bold" type="submit">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="login" role="tabpanel">
                                <form class="login-form" action="#!">
                                    <div class="text-divider">Đăng nhập qua mạng xã hội</div>
                                    <div class="form-row">
                                        <div class="col-sm-6">
                                            <a class="btn btn-block btn-default py-10 my-2 rounded-0 link-unstyled d-flex align-items-center justify-content-center" href="#!">
                                                <img class="mr-2" src="images/icon-google-plus-colored.png" alt="">
                                                <span>Dùng tài khoản Google</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="btn btn-block btn-default py-10 my-2 rounded-0 link-unstyled d-flex align-items-center justify-content-center" href="#!">
                                                <img class="mr-2" src="images/icon-facebook-square.png" alt="">
                                                <span>Dùng tài khoản Facebook</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-divider mb-2">Đăng nhập bằng tài khoản
                                        <strong class="ml-1">Thesafe</strong>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Tên đăng nhập</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Mật khẩu</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a class="text-purple" href="#!">Quên mật khẩu?</a>
                                    </div>
                                    <div class="text-center py-2">
                                        <button class="btn btn-gradient btn-md btn-circle font-weight-bold" type="submit">Đăng nhập</button>
                                    </div>
                                    <div class="text-center mt-2">
                                        <div>Bạn chưa có tài khoản?
                                            <a class="text-purple" href="#!">TẠO TÀI KHOẢN</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- javascript library-->
        <!-- vendor script-->
        <script src="./vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="./vendor/popper/popper.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="./vendor/swiper/js/swiper.min.js"></script>
        <script src="./vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!-- custom script-->
        <script src="./js/globals.js"></script>
    </body>
</html>
