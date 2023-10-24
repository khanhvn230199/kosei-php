<div class="container">
  <div class="border-top"></div>
</div>
<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
      </li>
      <li class="breadcrumb-item active">{'Login'|lang}</li>
    </ol>
  </div>
</nav>
<section class="mb-50">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3">
        <div class="sign-in card border-primary">
          <div class="card-header bg-primary text-white">
            <h2 class="card-title">{'Login'|lang}</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" id="fLogin" name="fLogin">
                  <div class="form-group">
                    <div class="form-control-icon form-control-icon-user">
                      <input class="form-control" type="text" placeholder="{'User_name'|lang}" id="user_name" name="user_name" value="{$user_name}" required>
                    </div>
                    {if $arr_error.user_name ne ''}<div class="text-danger">{$arr_error.user_name}</div>{/if}
                  </div>
                  <div class="form-group">
                    <div class="form-control-icon form-control-icon-lock">
                      <input class="form-control" type="password" placeholder="{'Password'|lang}" id="user_pass" name="user_pass" required>
                    </div>
                    {if $arr_error.user_pass ne ''}<div class="text-danger">{$arr_error.user_pass}</div>{/if}
                  </div>
                  <div class="form-group">
                    <button class="btn btn-danger btn-block" type="submit" value="Login" name="btnLogin">{'Login'|lang}</button>
                  </div>
                  <div>
                    <span>{'Dont_have_an_account'|lang}</span>
                    <a class="text-primary" href="{$Rewrite->url_register()}">{'Register_here'|lang}</a>
                  </div>
                  <div>
                    <span>{'Forgot_your_password'|lang}</span>
                    <a class="text-primary" href=".md-restore" data-toggle="modal">{'Click_here'|lang}</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
