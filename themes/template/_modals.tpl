<article class="md-login modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="border: none;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="background: none; border-radius: 0;">
                        <a href="" class="create_acc" style="color:#4166b0">{'Login'|lang}</a>
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="background: none; border-radius: 0;"><a href="/register" style="color:red" class="create_acc">Tạo tài khoản</a></button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="modal-body">
                        <form id="login_form" action="" method="POST" onsubmit="ajax_login();return false;">
                            <div class="form-group alert alert-danger text-16 js-login-alert-box d-none">Bạn phải đăng nhập để xem được nội dung này!</div>
                            <div class="form-group">
                                <label class="title_login">Email hoặc tài khoản đăng nhập</label>
                                <div class="form-control-icon form-control-icon-user">
                                    <input class="form-control" type="text" name="user_name" placeholder="{'User_name'|lang}" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="title_login">Mật khẩu đăng nhập</label>
                                <div class="form-control-icon form-control-icon-lock">
                                    <input class="form-control" type="password" name="user_pass" placeholder="{'Password'|lang}" required />
                                </div>
                                <a class="text-default text-muted form-text mt-2 js-restore-btn" href=".md-restore" data-toggle="modal">{'Forgot_your_password'|lang}?</a>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="btnLogin" value="{'Login'|lang} ">
                                <button class="btn btn-block btn-danger" type="submit">{'Login'|lang}</button>
                            </div>
                            <div class="form-group">
                                <label class="title_login">Hoặc đăng nhập nhanh bằng</label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-facebook text-white" href="{$Rewrite->url_fbauth()}">
                                            <i class="fa fa-facebook mr-2"></i>
                                            <span>Facebook</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-google-plus text-white" href="{$Rewrite->url_ggauth()}">
                                            <i class="fa fa-google mr-2"></i>
                                            <span>Google</span>
                                        </a>
                                    </div>
                                </div>
                                <!--  <div class="col-4">
                            <div class="form-group">
                                <a class="btn btn-block btn-apple text-white" href="{$Rewrite->url_fbauth()}">
                                    <i class="fa fa-apple mr-2"></i>
                                    <span>Apple ID</span>
                                </a>
                            </div>
                        </div> -->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="modal-body">
                         <!-- <form method="POST" id="fRegister" name="fRegister"> -->
                        <form method="POST" action="/register">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Họ Và Tên</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="form-control-icon form-control-icon-user">
                                                <input class="form-control" type="text" id="fullname" name="fullname" value="{$fullname}" placeholder="Họ Và Tên" required>
                                            </div>
                                            {if $arr_error.fullname ne ''}<div class="text-danger">{$arr_error.fullname}</div>{/if}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tên đăng nhập</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="form-control-icon">
                                                <i class="fa fa-address-card" aria-hidden="true" style="color: #4166b0;position: absolute;top: 9px;left: 13px;"></i>
                                                <input class="form-control" type="text" id="user_name" name="user_name" value="{$user_name}" placeholder="{'User_name'|lang}" pattern="{literal}[A-Za-z0-9]{6,}{/literal}" title="Tài khoản phải viết liền không dấu, không được chứa khoảng trắng và ký tự đặc biệt, tối thiểu 6 ký tự" required>
                                            </div>
                                            {if $arr_error.user_name ne ''}<div class="text-danger">{$arr_error.user_name}</div>{/if}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="form-control-icon form-control-icon-envelope">
                                                <input class="form-control" type="email" id="email" name="email" value="{$email}" placeholder="email@example.com" pattern="{literal}[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}${/literal}" required>
                                            </div>
                                            {if $arr_error.email ne ''}<div class="text-danger">{$arr_error.email}</div>{/if}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="form-control-icon form-control-icon-phone">
                                                <input class="form-control" type="tel" id="mobile" name="mobile" value="{$mobile}" placeholder="{'Phone'|lang}" required>
                                            </div>
                                            {if $arr_error.mobile ne ''}<div class="text-danger">{$arr_error.mobile}</div>{/if}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Mật khẩu</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="form-control-icon form-control-icon-lock">
                                                <input class="form-control" type="password" id="user_pass" name="user_pass" value="{$user_pass}" placeholder="{'Password'|lang}" pattern="{literal}.{6,}{/literal}" title="mật khẩu tối thiểu 6 ký tự" required>
                                            </div>
                                            {if $arr_error.user_pass.0 ne ''}<div class="text-danger">{$arr_error.user_pass.0}</div>{/if}
                                        </div>
                                        <div class="form-group">
                                            <div class="form-control-icon form-control-icon-lock">
                                                <input class="form-control" type="password" id="user_pass_confirm" name="user_pass_confirm" value="{$user_pass_confirm}" placeholder="{'Confirm_password'|lang}" pattern="{literal}.{6,}{/literal}" title="mật khẩu tối thiểu 6 ký tự" required>
                                            </div>
                                            {if $arr_error.user_pass.1 ne ''}<div class="text-danger">{$arr_error.user_pass.1}</div>{/if}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="mr-4">{'Gender'|lang}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group form-inline">
                                            <label class="radio-styled mr-4">
                                                <input class="radio-styled__input" type="radio" name="gender" value="0" checked>
                                                <span class="radio-styled__icon"></span>
                                                <span>{'Male'|lang}</span>
                                            </label>
                                            <label class="radio-styled mr-4">
                                                <input class="radio-styled__input" type="radio" name="gender" value="1">
                                                <span class="radio-styled__icon"></span>
                                                <span>{'Female'|lang}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-styled">
                                    <input class="checkbox-styled__input" type="checkbox" name="agree" value="agree" required>
                                    <span class="checkbox-styled__icon"></span>
                                    <span>{'I_have_read_and_agree_with'|lang}</span>
                                    <a class="text-primary" href="{$_CONFIG.terms_of_use}">{'Terms_of_use'|lang}</a>
                                </label>
                                {if $arr_error.agree ne ''}<div class="text-danger">{$arr_error.agree}</div>{/if}
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit" name="btnRegister" value="Register">{'Register'|lang}</button>
                            </div>
                            <div class="form-group">
                                <label class="title_login">Hoặc đăng nhập nhanh bằng</label>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-facebook text-white" href="{$Rewrite->url_fbauth()}">
                                            <i class="fa fa-facebook mr-2"></i>
                                            <span>Facebook</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <a class="btn btn-block btn-google-plus text-white" href="{$Rewrite->url_ggauth()}">
                                            <i class="fa fa-google mr-2"></i>
                                            <span>Google</span>
                                        </a>
                                    </div>
                                </div>
                                <!--  <div class="col-4">
                            <div class="form-group">
                                <a class="btn btn-block btn-apple text-white" href="{$Rewrite->url_fbauth()}">
                                    <i class="fa fa-apple mr-2"></i>
                                    <span>Apple ID</span>
                                </a>
                            </div>
                        </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<article class="md-restore modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{'Password_retrieval'|lang}</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="forgot_form" action="" method="POST" onsubmit="ajax_forgot();return false;">
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-user">
                            <input class="form-control" type="text" name="user_name" placeholder="{'User_name'|lang}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-envelope">
                            <input class="form-control" type="email" name="email" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="btnForgot" value="btnForgot">
                        <button class="btn btn-block btn-danger" type="submit">{'Password_retrieval'|lang}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<article class="md-course modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{'Register_the_course'|lang}</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{$Rewrite->url_checkout()}" method="post">
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-user">
                            <input class="form-control" type="text" id="fullname" name="fullname" value="{$fullname}" placeholder="{'Example_name'|lang}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-envelope">
                            <input class="form-control" type="email" id="email" name="email" value="{$email}" placeholder="email@example.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-phone">
                            <input class="form-control" type="tel" id="mobile" name="mobile" value="{$mobile}" placeholder="{'Phone'|lang}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-book">
                            <input class="form-control" type="text" id="address" name="address" value="{$address}" placeholder="{'Address'|lang}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="cat_id" value="{$curCat.cat_id}">
                        <button class="btn btn-block btn-danger" type="submit" value="checkout">{'Proceed_to_payment'|lang}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<article class="md-result modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{'Result'|lang}</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body py-30">
                <div class="js-result md-result__text text-20 text-center"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary js_show_review_the_results" data-dismiss="modal">{'review_the_results'|lang}</button>
                <button class="btn btn-danger" data-dismiss="modal">{'Close'|lang}</button>
            </div>
        </div>
    </div>
</article>
<article class="md-test-result modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="test-result">
                    <img class="test-result__img" src="{$URL_IMAGES}/test-result-img.png" alt="" />
                    <div class="js-test-result">
                        <div>
                            <div class="test-result__title">JP</div>
                            <div class="test-result__info">
                                <table>
                                    <tr>
                                        <td>氏名 Họ tên:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>結果 Kết quả:</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="test-result__table table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="3">得点区分別得点 Điểm thành phần</td>
                                        <td rowspan="2">
                                            <div>総合得点</div>
                                            <div>Tổng điểm</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>言語知識（文字・語彙・文法）</div>
                                            <div>Từ vựng + Ngữ pháp</div>
                                        </td>
                                        <td>
                                            <div>読解</div>
                                            <div>Đọc hiểu</div>
                                        </td>
                                        <td>
                                            <div>聴解</div>
                                            <div>Nghe hiểu</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>00/60</td>
                                        <td>00/60</td>
                                        <td>00/60</td>
                                        <td>00/180</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <img class="test-result__logo" src="{$URL_IMAGES}/logo.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</article>
<div class="md-noexam modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <div class="w-100 pt-4 pb-3 text-18 text-center">
                    <p>{'This_lecture_has_no_exercises'|lang}.<br />{'Please_see_more_other_lectures'|lang}!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-expired-lession modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background-color:transparent!important; border:0px solid #FFF">
            <div class="modal-body">
                <button class="md-welcome__close" type="button" data-dismiss="modal">
                    <img src="{$URL_IMAGES}/close-btn.png" alt="close">
                </button>
                <div class="col-xl-12 mb-20">
                    <div class="sign-in card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h2 class="card-title">{'Notice'|lang}</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{'Expired_time_to_view_this_content'|lang}!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file="_blocks/_mock_exam.tpl"}
{if $mod eq 'lessons' and $act eq 'detail'}
<article class="md-purchase-require modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yêu cầu đăng ký</h5>
                <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                {if !$paymentStatus}
                <div class="form-group alert alert-danger text-16">Bạn phải đăng ký khoá học mới xem được nội dung ngày!</div>
                {include file="_blocks/_payment-form.tpl"}
                {elseif $paymentStatus.status ne '2'}
                {if $paymentStatus.combo_link}
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-circle mr-2"></i>
                    Bạn đã đăng ký <a class="text-700 text-primary" href="{$paymentStatus.combo_link}">{$paymentStatus.name}</a> nhưng chưa thanh toán.
                    <br>
                    Bạn có thể thực hiện thanh toán combo khoá học trên hoặc đăng ký khoá học này:
                </div>
                {include file="_blocks/_payment-form.tpl"}
                {else}
                <div class="alert alert-warning mb-0">
                    <i class="fa fa-exclamation-circle mr-2"></i>
                    Bạn đã đăng ký khoá học này nhưng chưa thanh toán.
                    <br>
                    Vui lòng <a class="text-700 text-primary" href="#payment-banking" data-toggle="collapse">thanh toán qua ngân hàng</a> hoặc <a class="text-700 text-primary" href="#payment-cash" data-toggle="collapse">thanh toán trực tiếp tại Kosei</a> để để kích hoạt khoá học.
                    <br>
                    <strong>Note:</strong> Nếu bạn đã thanh toán nhưng chưa kích hoạt khoá học. Vui lòng liên hệ lại với chúng tôi để nhận được sự hỗ trợ.
                </div>
                <div class="js-payment-info pt-3 collapse" id="payment-banking">
                    <div class="alert alert-info mb-0">
                        <div class="mb-12">
                            <strong class="text-danger">{'Transferring_content'|lang}:</strong><br>
                            <kbd class="ml-0">{$core->callfunc('utf8_nosign', $curCat.name)|replace:'tieng Nhat ':''}_{$core->_USER.user_name}_{$core->_USER.mobile}</kbd>
                        </div>
                        {if $bankAccounts}
                        {foreach from=$bankAccounts item=bank key=key name=name}
                        <div class="mb-12 m-last-0">
                            <div class="text-700">{$bank.name}</div>
                            <div>Chủ tài khoản: <strong>{$bank.account_holder}</strong></div>
                            <div>Số tài khoản: <strong>{$bank.account_number}</strong></div>
                        </div>
                        {/foreach}
                        {/if}
                    </div>
                </div>
                <div class="js-payment-info pt-3 collapse" id="payment-cash">
                    <div class="alert alert-info mb-0">
                        {if $locations}
                        {foreach from=$locations item=location key=key name=name}
                        <div class="mb-12 m-last-0"><strong>Cơ sở {$key + 1}:</strong> {$location.name}</div>
                        {/foreach}
                        {/if}
                    </div>
                </div>
                {/if}
                {elseif $paymentStatus.status eq '2' and $paymentStatus.expired}
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle mr-2"></i>
                    Đăng ký của bạn đã hết hạn vào ngày <strong>{$paymentStatus.expired_time|date_format:"%d/%m/%Y"}</strong>.
                    <br>
                    Bạn có thể đăng ký lại để tiếp tục tham gia khoá học.
                </div>
                {include file="_blocks/_payment-form.tpl"}
                {/if}
            </div>
        </div>
    </div>
    </div>
</article>
{/if}
<div class="md-continue modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bạn có muốn tiếp tục bài thi lần trước?</h5>
                <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">Có vẻ như lần trước của bạn đã chưa hoàn thành bài thi, bạn có muốn <strong class="text-16 text-danger">THI TIẾP</strong> hay <strong class="text-16 text-primary">THI LẠI TỪ ĐẦU</strong> không?</div>
                <div class="d-flex justify-content-center"><a class="button mr-3 js-continue-test" href="#!">Thi tiếp</a>
                    <button class="button bg-primary" type="button" data-dismiss="modal">Thi lại</button>
                </div>
            </div>
        </div>
    </div>
</div>