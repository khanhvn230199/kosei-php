<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'Mock_exam'|lang}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        {if $isLogin eq 1}
        {* {if $arrOneCandidates}*}
        {if $arrListTest}
        <h2 class="section__title text-uppercase">{'List_of_exam_questions'|lang}</h2>
        <div class="row">
            {foreach from=$arrListTest key=e item=test}
            <div class="col-lg-4 col-sm-6 mb-30">
                <div class="exam card card-body">
                    <h3 class="exam__title">
                        <a class="text-default" href="{$Rewrite->url_trialtest($test)}">{$test.name}</a>
                    </h3>
                    <div class="d-flex align-items-center mb-4">
                        {if $test.time_end}
                        <div class="mr-20">
                            <i class="fa fa-clock-o mr-1"></i>
                            <span>{$test.time_end} {'minute'|lang}</span>
                        </div>
                        {/if}
                        <span class="exam__badge badge badge-danger">{'Free'|lang}</span>
                    </div>
                    <div class="nav mb-1">
                        {if $test.list_user}
                        {foreach from=$test.list_user key=u item=user}
                        <a class="exam__user" href="javascript:;" title="{$user.fullname}">
                            <img src="{$URL_IMAGES}/{$user.image}" onerror="this.src='{$URL_IMAGES}/user.png'" alt="{$user.fullname}" />
                        </a>
                        {/foreach}
                        {if $test.total_user > 3 && ($test.total_user - 3) > 0}
                        <a class="exam__user" href="javascript:;">
                            <span>+{$test.total_user - 3}</span>
                        </a>
                        {/if}
                        {/if}
                    </div>
                    <div class="nav justify-content-between">
                        <div class="exam__tags mt-20">
                            <a class="btn btn-danger text-700" href="#!">{$test.code}</a>
                        </div>
                        <a class="exam__link btn btn-primary mt-20" href="{$Rewrite->url_trialtest($test)}">{'Mock_exam'|lang}</a>
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
        <div class="text-center">
            <a class="section__btn btn btn-primary" href="javascript:;">{'View_more'|lang}</a>
        </div>
        {else}
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="alert-box">
                    <div class="alert-box__wrapper">
                        <img class="alert-box__bg" src="{$URL_IMAGES}/test-start.png" alt="test-start">
                        <div class="alert-box__content">
                            <div>
                                <div class="alert-box__text-1">{'The_test_will_take_place'|lang}</div>
                                <div class="alert-box__text-2">{$arrOneLatestTest.start_date|date_format:"%H:%M Day %d/%m/%Y"|replace:"Day":'Day'|lang}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Đăng ký thu thử -->
        <div class="trial-test" style="text-align: center;width: 500px; margin:0 auto;">
            <form action="" class="trial_email_form" method="POST" onsubmit="ajax_trial(); return false;">
                <h2 class="text-700 text-20 text-center text-uppercase">{'Trial_test_register'|lang}</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Họ &amp; tên" value="{$core->_USER.fullname}" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="tel" name="phone" placeholder="Số điện thoại" value="{$core->_USER.mobile}" required>
                </div>

                    <input type="hidden" name="user_id" value="{$core->_USER.user_id}">
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email" value="{$core->_USER.email}">
                </div>
                <div class="form-group">
                    <div class="form-control-icon form-control-icon-book">
                        <select class="form-control" name="level_id" {if $smarty.get.lid}disabled{/if} required>
                            <option>{'Select_level'|lang}---</option>
                            {foreach from = $arrListLevels key =j item = level}
                            <option value="{$level.level_id}">{$level.name}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-block btn-danger text-700 text-uppercase js-submit-btn" type="submit">Đăng ký thi thử</button>
                    <img class="d-none js-loading-icon" src="{$URL_IMAGES}/loading.gif" alt="{('gui')|lang}">
                </div>
            </form>
        </div>
        <!-- End -->
        {/if}
        {else}
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="alert-box">
                    <div class="alert-box__wrapper">
                        <img class="alert-box__bg" src="{$URL_IMAGES}/test-start.png" alt="test-start">
                        <div class="alert-box__content">
                            <div>
                                <div class="alert-box__text-1">{'The_test_will_take_place'|lang}</div>
                                <div class="alert-box__text-2">{$arrOneLatestTest.start_date|date_format:"%H:%M Day %d/%m/%Y"|replace:"Day":'Day'|lang}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Đăng ký thu thử -->
        {if $isLogin ne 1}
        <div class="trial-test" style="text-align: center;">
            <a class="button" href=".md-login" data-toggle="modal">Đăng ký & Đăng nhập</a>
            <br>
            <p class="login-trail">Vui lòng đăng ký hoặc đăng nhập tài khoản để đăng ký thi thử</p>
        </div>
        {else}
     <!--    <div class="trial-test"style="text-align: center;width: 500px; margin:0 auto;">
            <form action="" class="trial_email_form" method="POST" onsubmit="ajax_trial(); return false;">
                <h2 class="text-700 text-20 text-center text-uppercase">{'Trial_test_register'|lang}</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Họ &amp; tên" value="{$core->_USER.fullname}" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="tel" name="phone" placeholder="Số điện thoại" value="{$core->_USER.mobile}">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email" value="{$core->_USER.email}">
                </div>
                <div class="form-group">
                    <div class="form-control-icon form-control-icon-book">
                        <select class="form-control" name="level" {if $smarty.get.lid}disabled{/if} required>
                            <option>{'Select_level'|lang}</option>
                            {foreach from = $arrListLevels key =j item = level}
                            <option value="{$level.name}">{$level.name}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-block btn-danger text-700 text-uppercase js-submit-btn" name="btnRegister" value="Register">{'Trial_test_register'|lang}</button>
                    <img class="d-none js-loading-icon" src="{$URL_IMAGES}/loading.gif" alt="{('gui')|lang}">
                </div>
            </form>
        </div> -->
        {/if}
        <!-- End -->
        {/if}
    </div>
</section>
<!-- Đăng ký thi thử -->
<!-- <article class="rg-trail modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" class="trial_email_form" method="POST" onsubmit="ajax_trial(); return false;">
                    <h2 class="text-700 text-20 text-center text-uppercase">{'Trial_test_register'|lang}</h2>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Họ &amp; tên" value="{$core->_USER.fullname}" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="tel" name="phone" placeholder="Số điện thoại" value="{$core->_USER.mobile}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email" value="{$core->_USER.email}">
                    </div>
                    <div class="form-group">
                        <div class="form-control-icon form-control-icon-book">
                            <select class="form-control" name="level" {if $smarty.get.lid}disabled{/if} required>
                                <option>{'Select_level'|lang}</option>
                                {foreach from = $arrListLevels key =j item = level}
                                <option value="{$level.name}">{$level.name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-block btn-danger text-700 text-uppercase js-submit-btn" type="submit">{'Trial_test_register'|lang}</button>
                        <img class="d-none js-loading-icon" src="{$URL_IMAGES}/loading.gif" alt="{('gui')|lang}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-block w-100">
                    <a class="text-primary" href="{$Rewrite->url_register()}">{'Register_now'|lang}</a>
                    {'If_you_do_not_have_an_account'|lang}
                </div>
            </div>
        </div>
    </div>
</article> -->
<!-- End -->