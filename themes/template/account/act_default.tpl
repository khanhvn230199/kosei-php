<div class="container">
    <div class="border-top"></div>
</div>
<nav>
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a>
            </li>
            <li class="breadcrumb-item active">{'Profile'|lang}</li>
        </ol>
    </div>
</nav>
<section class="section mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="profile-panel card">
                    <h2 class="card-header">{'Profile'|lang}</h2>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-active" href="{$Rewrite->url_history()}">
                            <img src="{$URL_IMAGES}/icon-file-list.png" alt="{'Learning_information'|lang}">
                            <span>{'Learning_information'|lang}</span>
                        </a>
                        <a class="list-group-item list-group-item-active active" href="javascript:;">
                            <img src="{$URL_IMAGES}/icon-user-blue.png" alt="{'Profile'|lang}">
                            <span>{'Profile'|lang}</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="{$Rewrite->url_historylearning()}">
                            <img src="{$URL_IMAGES}/icon-file-list.png" alt="{'Lịch sử học tập'|lang}">
                            <span>{'Lịch sử học tập'|lang}</span>
                        </a>
                        <a class="list-group-item list-group-item-active" href="{$Rewrite->url_logout()}">
                            <img src="{$URL_IMAGES}/icon-power-off-blue.png" alt="{'Logout'|lang}">
                            <span>{'Logout'|lang}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <section class="profile-section">
                    <h2 class="profile-section__title">{$core->getLang('Account_information')}</h2>
                    <ul class="profile-info">
                        <li>
                            <span>Email:</span>
                            <span>{$core->_USER.email}</span>
                            <a class="profile-info__edit" href="{$Rewrite->url_changeinfo()}">{'Change_email'|lang}</a>
                        </li>
                        <li>
                            <span>{'Phone'|lang}:</span>
                            <a class="profile-info__number" href="tel:{$core->_USER.mobile}">{$core->_USER.mobile|phone_format}</a>
                            <a class="profile-info__edit" href="{$Rewrite->url_changeinfo()}">{'Change_phone_number'|lang}</a>
                        </li>
                        <li>
                            <span>{'Password'|lang}:</span>
                            <span>********</span>
                            <a class="profile-info__edit" href="{$Rewrite->url_changeinfo()}">{'Change_password'|lang}</a>
                        </li>
                    </ul>
                </section>
                <section class="profile-section">
                    <h2 class="profile-section__title">{'Profile'|lang}</h2>
                    <form class="profile" method="post" enctype="multipart/form-data">
                        <div class="media">
                            <div class="profile__thumbs">
                                <div class="profile__thumbs-iwrap">
                                    {* <div class="profile__thumbs-placeholder">*}
                                        {* <span>Chưa cập nhật</span>*}
                                        {* <span>Hình Ảnh</span>*}
                                        {* </div>*}
                                    <img id="avatar" class="js-thumb-img" src="{$URL_UPLOADS}/{$core->_USER.avatar}" onerror="this.src='{$URL_IMAGES}/no_profile.png'" alt="{'Fullname'|lang}">
                                </div>
                                <label class="profile__thumbs-btn">
                                    <input class="js-thumb-input" name="avatar" onChange="setPreviewAvatar(this, 'avatar');" accept=".jpg,.png,.bmp,.gif" type="file" />
                                    <i class="fa fa-picture-o"></i>
                                    <span>{'Choose_avatar'|lang}</span>
                                </label>
                            </div>
                            <div class="media-body">
                                <div class="form-group row">
                                    <label class="col-form-label col-xl-2">{'Full_name'|lang}</label>
                                    <div class="col-xl-10">
                                        <input class="form-control" type="text" name="fullname" value="{$core->_USER.fullname}" placeholder="{'Example_name'|lang}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-xl-2">{'Date_of_birth'|lang}</label>
                                    <div class="col-xl-10">
                                        <div class="form-row">
                                            {assign var=birthday value=$core->_USER.birthday|date_format:"%d/%m/%Y"}
                                            {assign var=arrBirthday value="/"|explode:$birthday}
                                            <div class="col-2">
                                                <select name="ngay" class="form-control">
                                                    {for $ngay=1 to 31}
                                                    {if $ngay < 10} {assign var=ngay value="0`$ngay`" } {/if} <option {if $ngay eq $arrBirthday[0]}selected{/if}>{$ngay} </option> {/for} </select> </div> <div class="col-2">
                                                        <select name="thang" class="form-control">
                                                            {for $thang=1 to 12}
                                                            {if $thang < 10} {assign var=thang value="0`$thang`" } {/if} <option {if $thang eq $arrBirthday[1]}selected{/if}>{$thang} </option> {/for} </select> </div> <div class="col-2">
                                                                <select name="nam" class="form-control">
                                                                    {for $nam=1900 to 'Y'|date}
                                                                    <option {if $nam eq $arrBirthday[2]}selected{/if}>{$nam} </option> {/for} </select> </div> </div> </div> </div> <div class="form-group row">
                                                                        <label class="col-form-label col-xl-2">{'Province_City'|lang}</label>
                                                                        <div class="col-xl-10">
                                                                            <select class="form-control" name="province_id">
                                                                                {$htmlOptionKhuvuc}
                                                                            </select>
                                                                        </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-xl-2">{'Address'|lang}</label>
                                                <div class="col-xl-10">
                                                    <input class="form-control" type="text" name="address" value="{$core->_USER.address}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-xl-2">{'Gender'|lang}</label>
                                                <div class="col-xl-10">
                                                    <select class="form-control" name="gender">
                                                        <option value="0">{'Male'|lang}</option>
                                                        <option value="1">{'Female'|lang}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary text-700 px-35 py-2" type="submit" name="btnSubmit" value="UpdateAccount">{'Update'|lang}</button>
                                    </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>