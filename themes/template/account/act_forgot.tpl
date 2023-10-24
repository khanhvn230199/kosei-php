<div class="bg-gray my-2">
    <div class="container">
        <div class="row">
        	{if $smarty.get.success==1}
            <div class="col-md-12 mb-4 mt-4">
              	<h2 class="text-danger">{'Forgot_account'|lang}!</h2>
              	<p>{'Forgot_success_notice1'|lang}</p>
              	<p class="mt-3"><a href="{$core->callfunc('url_login')}">{'Sign_in'|lang}</a> {'To_manage_your_account'|lang}.</p>
            </div>			
			{else}
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8 mx-auto">
                <form class="m-form sign-in-form" action="" method="POST" id="fForgot" name="fForgot" class="fLoginRegister">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="{'User_name'|lang}"  id="user_name" name="user_name" value="{$user_name}"  required>
                        {if $arr_error.user_name ne ''}<div class="text-danger">{$arr_error.user_name}</div>{/if}
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Email" id="email" name="email" value="{$email}"  required>
                        {if $arr_error.email ne ''}<div class="text-danger">{$arr_error.email}</div>{/if}
                    </div>
                    <button class="m-form__btn btn btn-block rounded-0" type="submit" value="Login" name="btnForgot" value="Forgot">{'Reset_password'|lang}</button>
                    <div class="m-form__text">
                        <p>
                            <span>{'Dont_have_an_account'|lang}</span>
                            <a href="{$core->callfunc('url_register')}">{'Register_here'|lang}</a>
                        </p>
                        <p>
                            <span class="uppercase">{'Or'|lang}</span>
                            <a href="{$core->callfunc('url_login')}">{'Sign_in'|lang}</a>
                        </p>
                    </div>
                </form>
            </div>
            {/if}
        </div>
    </div>
</div>