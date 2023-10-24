<div class="bg-gray my-2">
    <div class="container">
        <div class="row">
            {if $smarty.get.success==1}
            <div class="col-md-12 mb-4 mt-4">
                <h2 class="text-danger">{'Reset_password'|lang}!</h2>
                <p>{'Reset_password_success_notice1'|lang}</p>
                <p class="mt-3"><a href="/login">{'Sign_in'|lang}</a> {'To_manage_your_account'|lang}.</p>
            </div>
            {elseif $existskey==0}
            <div class="col-md-12 mb-4 mt-4">
                <h2 class="text-danger">{'Reset_password'|lang}!</h2>
                <p class="text-danger">{'This_link_is_not_correct_or_expired'|lang}</p>
                <p class="mt-3"><a href=".md-login" data-toggle="modal">{'Sign_in'|lang}</a> {'To_manage_your_account'|lang}.</p>
            </div>
            {else}
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 mx-auto">
                <form class="m-form sign-in-form" action="" method="POST" id="fForgot" name="fForgot" class="fLoginRegister">
                    <h2 class="text-danger">{'Create_new_password'|lang}!</h2>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="{'Password'|lang}" id="user_pass" name="user_pass" value="{$smarty.post.user_pass}" required>
                        {if $arr_error.user_pass.0 ne ''}<div class="text-danger">{$arr_error.user_pass.0}</div>{/if}
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="{'Confirm_password'|lang}" id="user_pass_confirm" name="user_pass_confirm" required>
                        {if $arr_error.user_pass.1 ne ''}<div class="text-danger">{$arr_error.user_pass.1}</div>{/if}
                    </div>
                    <button class="m-form__btn btn btn-block rounded-0" type="submit" value="Login" name="btnReset" value="Create" style="background: #dc2428;
    color: white;
    text-transform: uppercase;
    font-weight: bold;">{'Create_password'|lang}</button>
    <br>
                    <div class="m-form__text">
                        <p>
                            <span>{'Dont_have_an_account'|lang}</span>
                            <a href="/register">{'Register_here'|lang}</a>
                        </p>
                        <p>
                            <span class="uppercase">{'Or'|lang}</span>
                            <a href="/login">{'Sign_in'|lang}</a>
                        </p>
                    </div>
                </form>
            </div>
            {/if}
        </div>
    </div>
</div>