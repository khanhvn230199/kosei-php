<div class="container pt-5">
    {if $optionLevel}
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="row mb-20">
                <div class="col-md-6 mb-30">
                    <div class="registration-card">{'You_have_not_registered_for_the_test'|lang}?</div>
                </div>
                <div class="col-md-6 mb-30">
                    <form action="{$Rewrite->url_trialtestregister()}" method="POST" id="fRegister" name="fRegister">
                        <h2 class="text-700 text-20 text-center text-uppercase">{'Trial_test_register'|lang}</h2>
                        <div class="form-group">
                            <input class="form-control" type="text" name="fullname" placeholder="Họ &amp; tên" value="{$core->_USER.fullname}" disabled>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="tel" name="mobile" placeholder="Số điện thoại" value="{$core->_USER.mobile}" disabled>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email" value="{$core->_USER.email}" disabled>
                        </div>
                        <div class="form-group">
                            <div class="form-control-icon form-control-icon-book">
                                <select class="form-control" name="level_id" {if $smarty.get.lid}disabled{/if} required>
                                    <option>{'Select_level'|lang}</option>
                                    {$optionLevel}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-styled">
                                <input class="checkbox-styled__input" type="checkbox" name="agree" value="agree" required>
                                <span class="checkbox-styled__icon"></span>
                                <span>{'I_have_read_and_agree_with'|lang}</span>
                                <a class="text-primary" href="{$_CONFIG.terms_of_use}">{'Terms_of_use'|lang}</a>
                            </label>
                            {if $arr_error.agree ne ''}
                            <div class="text-danger">{$arr_error.agree}</div>{/if}
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-block btn-danger text-700 text-uppercase" name="btnRegister" value="Register">Đăng ký thi thử</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {else}
    <div class="row">
        <div class="col-xl-8 offset-xl-2">
            <div class="alert-box">
                <div class="alert-box__wrapper">
                    <img class="alert-box__bg" src="{$URL_IMAGES}/test-end.png" alt="test-end">
                    <div class="alert-box__content">
                        <div>
                            <div class="alert-box__text-1">{'Oh_no_the_test_has_ended'|lang}</div>
                            <div class="alert-box__text-2">{'We_will_notify_you_when_the_next_test_is_available'|lang}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {/if}
</div>