<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'Contact'|lang}</li>
        </ol>
    </div>
</nav>
<section class="mb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-30">
                <!-- contact infomation-->
                <article class="ct-info">
                    <h2 class="ct-info__title text-uppercase">{'Contact_us'|lang}</h2>
                    <div class="ct-info__content mb-20">
                        {$_CONFIG.contact_info|htmlDecode}
                    </div>
                    {$core->echoAdverNonTime('CN','branch')}
                </article>
            </div>
            <div class="col-lg-6 mb-30">
                <!-- contact form-->
                <form class="ct-form" method="post">
                    <div class="form-group">
                        <label>
                            <span>{$core->getLang('Your_name')}</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" name="name" type="text" id="name" placeholder="{$core->getLang('Your_name')}" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>{$core->getLang('Phone')}</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="tel" name="phone" id="phone" placeholder="{$core->getLang('Phone')}" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>Email</span>
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="{$core->getLang('Email')}" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>{$core->getLang('Title')}</span>
                        </label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="{$core->getLang('Title')}" required="required">
                    </div>
                    <div class="form-group">
                        <label>
                            <span>{$core->getLang('Content')}</span>
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="content" name="content" placeholder="{$core->getLang('Content')}" rows="7"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary text-700 text-uppercase" name="btnSend" value="{$core->getLang('Submmit_now')}" type="submit">{'Contact_now'|lang}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>