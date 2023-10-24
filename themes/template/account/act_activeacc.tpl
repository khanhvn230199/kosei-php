<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'Activation_account'|lang}</li>
        </ol>
    </div>
</nav>
<section class="mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="sign-in card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title">{'Activation_account'|lang}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {if $success==1}
                                    <p class="text-success"><strong>{'Activation_account_successfully'|lang}!</strong></p>
                                    <p class="mt-3">{'Thank_you_for_register_to'|lang} <a href=".md-login" data-toggle="modal">{'Sign_in'|lang}</a> {'To_manage_your_account'|lang}.</p>
                                {elseif $success==-1}
                                    <p class="text-danger"><strong>{'Activation_account_unsuccessfully'|lang}!</strong></p>
                                    <p class="mt-3">{'Activation_fail_notice'|lang}.</p>
                                {else}
                                    <p class="text-danger">{'Error_occur_when_activation'|lang}.</p>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>