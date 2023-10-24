<div class="container">
  <div class="border-top"></div>
</div>

<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
      </li>
      <li class="breadcrumb-item active">{'Trial_test_register'|lang}</li>
    </ol>
  </div>
</nav>

<section class="mb-50">
  <div class="container">
      {if $optionLevel}
          {if $isLogin eq 1}
              {include file="trialtest/act_register.tpl"}
          {else}
            <div class="row">
              <div class="col-xl-8 offset-xl-2">
                <div class="sign-in card border-primary">
                  <div class="card-header bg-primary text-white">
                      {if $smarty.get.success==1}
                        <h2 class="card-title">{'Register_successfully'|lang}</h2>
                      {else}
                        <h2 class="card-title">{'Register'|lang}</h2>
                      {/if}
                  </div>
                  <div class="card-body">
                    <div class="row">
                        {if $smarty.get.success==1}
                          <div class="col-md-12">
                            <h2 class="text-danger">{'Register_successfully'|lang}!</h2>
                            <p>{'Thank_you_for_register_to'|lang} <a
                                      href="{$Rewrite->url_trialtest()}">{'Click_here'|lang}</a> {'To_go_to_the_mock_exam_page'|lang}
                              .</p>
                          </div>
                        {else}
                          <div class="col-md-6 order-md-1">
                            <form method="POST" id="fRegister" name="fRegister">
                                {if $isLogin ne 1}
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-user">
                                      <input class="form-control" type="text" id="fullname" name="fullname"
                                             value="{$fullname}" placeholder="Họ Và Tên" required>
                                    </div>
                                      {if $arr_error.fullname ne ''}
                                        <div class="text-danger">{$arr_error.fullname}</div>{/if}
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-user">
                                      <input class="form-control" type="text" id="user_name" name="user_name"
                                             value="{$user_name}" placeholder="{'User_name'|lang}"
                                             pattern="{literal}[A-Za-z0-9]{6,}{/literal}"
                                             title="Tài khoản phải viết liền không dấu, không được chứa khoảng trắng và ký tự đặc biệt, tối thiểu 6 ký tự"
                                             required>
                                    </div>
                                      {if $arr_error.user_name ne ''}
                                        <div class="text-danger">{$arr_error.user_name}</div>{/if}
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-envelope">
                                      <input class="form-control" type="email" id="email" name="email" value="{$email}"
                                             placeholder="email@example.com"
                                             pattern="{literal}[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}${/literal}"
                                             required>
                                    </div>
                                      {if $arr_error.email ne ''}
                                        <div class="text-danger">{$arr_error.email}</div>{/if}
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-phone">
                                      <input class="form-control" type="tel" id="mobile" name="mobile" value="{$mobile}"
                                             placeholder="{'Phone'|lang}" required>
                                    </div>
                                      {if $arr_error.mobile ne ''}
                                        <div class="text-danger">{$arr_error.mobile}</div>{/if}
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-lock">
                                      <input class="form-control" type="password" id="user_pass" name="user_pass"
                                             value="{$user_pass}" placeholder="{'Password'|lang}"
                                             pattern="{literal}.{6,}{/literal}" title="mật khẩu tối thiểu 6 ký tự"
                                             required>
                                    </div>
                                      {if $arr_error.user_pass.0 ne ''}
                                        <div class="text-danger">{$arr_error.user_pass.0}</div>{/if}
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-lock">
                                      <input class="form-control" type="password" id="user_pass_confirm"
                                             name="user_pass_confirm" value="{$user_pass_confirm}"
                                             placeholder="{'Confirm_password'|lang}" pattern="{literal}.{6,}{/literal}"
                                             title="mật khẩu tối thiểu 6 ký tự" required>
                                    </div>
                                      {if $arr_error.user_pass.1 ne ''}
                                        <div class="text-danger">{$arr_error.user_pass.1}</div>{/if}
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-book">
                                      <select class="form-control" name="level_id" {if $smarty.get.lid}disabled{/if}>
                                        <option>{'Select_level'|lang}</option>
                                          {$optionLevel}
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group form-inline">
                                    <label class="mr-4">{'Gender'|lang}</label>
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
                                {else}
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-user">
                                      <input class="form-control" type="text" id="fullname" name="fullname"
                                             value="{$core->_USER.fullname}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-envelope">
                                      <input class="form-control" type="email" id="email" name="email"
                                             value="{$core->_USER.email}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-phone">
                                      <input class="form-control" type="tel" id="mobile" name="mobile"
                                             value="{$core->_USER.mobile}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="form-control-icon form-control-icon-book">
                                      <select class="form-control" name="level_id" {if $smarty.get.lid}disabled{/if}
                                              required>
                                        <option>{'Select_level'|lang}</option>
                                          {$optionLevel}
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group form-inline">
                                    <label class="mr-4">{'Gender'|lang}</label>
                                    <label class="radio-styled mr-4">
                                      <input class="radio-styled__input" type="radio" name="gender" value="0"
                                             {if $core->_USER.gender eq 0}checked{/if} disabled>
                                      <span class="radio-styled__icon"></span>
                                      <span>{'Male'|lang}</span>
                                    </label>
                                    <label class="radio-styled mr-4">
                                      <input class="radio-styled__input" type="radio" name="gender" value="1"
                                             {if $core->_USER.gender eq 1}checked{/if} disabled>
                                      <span class="radio-styled__icon"></span>
                                      <span>{'Female'|lang}</span>
                                    </label>
                                  </div>
                                {/if}
                              <div class="form-group">
                                <label class="checkbox-styled">
                                  <input class="checkbox-styled__input" type="checkbox" name="agree" value="agree"
                                         required>
                                  <span class="checkbox-styled__icon"></span>
                                  <span>{'I_have_read_and_agree_with'|lang}</span>
                                  <a class="text-primary" href="{$_CONFIG.terms_of_use}">{'Terms_of_use'|lang}</a>
                                </label>
                                  {if $arr_error.agree ne ''}
                                    <div class="text-danger">{$arr_error.agree}</div>{/if}
                              </div>
                              <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit" name="btnRegister"
                                        value="Register">{'Register'|lang}</button>
                              </div>
                              <div>
                                <a class="text-primary text-uppercase" href=".md-login"
                                   data-toggle="modal">{'Login'|lang}</a>
                                <span>{'If_you_already_have_an_account'|lang}</span>
                              </div>
                            </form>
                          </div>
                          <div class="col-md-6">
                            <div class="w-100 h-100 position-relative">
                              <div class="sign-in__detail">
                                <div class="sign-in__subtitle mb-2">{'Terms_of_use'|lang}</div>
                                <div class="card card-body px-0 border-primary">
                                  <div class="sign-in__rule">
                                      {if $_CONFIG.terms_of_use}
                                          {$_CONFIG.terms_of_use|htmlDecode}
                                      {else}
                                          {'Updating'|lang}
                                      {/if}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        {/if}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          {/if}
      {else}
        <div class="row">
          <div class="col-xl-8 offset-xl-2">
            <div class="card card-body py-50 mb-50">
              <div class="text-20 text-center">{'Oh_no_the_test_has_ended'|lang}</div>
              <div class="text-30 text-center">{'We_will_notify_you_when_the_next_test_is_available'|lang}</div>
            </div>
          </div>
        </div>
      {/if}
  </div>
</section>
