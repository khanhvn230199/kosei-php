<div class="container">
  <div class="border-top"></div>
</div>
<!-- breadcrumb-->
<nav>
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="link-unstyled" href="{$VNCMS_URL}">{'Home'|lang}</a></li>
      <li class="breadcrumb-item active">{'Payment'|lang}</li>
    </ol>
  </div>
</nav>
<div class="container">
  <form class="mb-60" method="post">
    {if $smarty.get.success eq 1}
      <div class="row">
        <div class="col-xl-6 offset-xl-3">
          <div class="sign-in card border-primary">
            <div class="card-header bg-primary text-white">
              <h2 class="card-title">{'Notice'|lang}</h2>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-danger">{'Sign_up_course_successful'|lang}!</h2>
                  <p>{'Thank_you_for_registering_the_course_please_pay_the_tuition_fee_so_that_you_can_see_the_full_content_of_this_course'|lang|replace:"%c":$arrOneCourse.name}
                    !</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    {else}
      <div class="row">
        <div class="col-lg-4">
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-home"></i>
              <span>{'Your_information'|lang}</span>
            </h2>
            {if $arrOneUser}
              <div class="form-group">
                <label class="payment__label">{'Full_name'|lang}</label>
                <input class="form-control" type="text" id="fullname" name="fullname" value="{$arrOneUser.fullname}" placeholder="{'Example_name'|lang}" required>
              </div>
              <div class="form-group">
                <label class="payment__label">{'Phone'|lang}</label>
                <input class="form-control" type="tel" id="mobile" name="mobile" value="{$arrOneUser.mobile}" placeholder="{'Phone'|lang}" required>
              </div>
              <div class="form-group">
                <label class="payment__label">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{$arrOneUser.email}" placeholder="email@example.com" required>
              </div>
              <div class="form-group">
                <label class="payment__label">{'Address'|lang}</label>
                <input class="form-control" type="text" name="address" value="{$arrOneUser.address}" placeholder="{'Address'|lang}">
              </div>
            {else}
              <div class="form-group">
                <label class="payment__label">{'Full_name'|lang}</label>
                <input class="form-control" type="text" id="fullname" name="fullname" value="{$fullname}" placeholder="{'Example_name'|lang}" required>
              </div>
              <div class="form-group">
                <label class="payment__label">{'Phone'|lang}</label>
                <input class="form-control" type="tel" id="mobile" name="mobile" value="{$mobile}" placeholder="{'Phone'|lang}" required>
              </div>
              <div class="form-group">
                <label class="payment__label">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{$email}" placeholder="email@example.com" required>
              </div>
              <div class="form-group">
                <label class="payment__label">{'Address'|lang}</label>
                <input class="form-control" type="text" name="address" value="{$address}" placeholder="{'Address'|lang}">
              </div>
            {/if}
            <div class="form-group">
              <label>{'Content'|lang}</label>
              <textarea class="form-control" name="note" rows="3">{$note}</textarea>
            </div>
            <div class="form-group">
              <label class="payment__label">{'Register_the_course'|lang}</label>
              <input class="form-control" type="text" value="{$arrOneCourse.name}" readonly>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          {*<div class="payment">
                        <h2 class="payment__header">
                            <i class="fa fa-truck"></i>
                            <span>{'COD_shipping'|lang}</span>
                        </h2>
                        <div class="form-group">
                            <div class="d-flex flex-wrap justify-content-between">
                                <label class="radio-styled">
                                    <input class="radio-styled__input" type="radio" name="shipping_method" value="1">
                                    <span class="radio-styled__icon"></span>
                                    <span>50.000đ</span>
                                </label>
                                <span>{'Shipping_by_post'|lang}</span>
                            </div>
                        </div>
                    </div>*}
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-credit-card-alt"></i>
              <span>{'Bank_transfer'|lang}</span>
            </h2>
            <div class="card bg-light rounded-0 mb-3 js-account-holder">
              <div class="card-body py-12">
                <span id="account_holder" class="d-none">{'Account_holder'|lang}:</span>
                <strong class="js-account-name">{'Select_the_bank_you_want_to_transfe'|lang}</strong>
              </div>
            </div>
            {foreach from=$arrListPaymentMethod key=p item=payment}
              {if $payment.ctype eq 0}
                <div class="form-group">
                  <label class="radio-styled">
                    <input class="radio-styled__input js-card-payment js-account-select" type="radio" name="payment_id" value="{$payment.payment_id}" data-currency="{$payment.country}" data-ah="{$payment.account_holder}" />
                    <span class="radio-styled__icon"></span>
                    <div>
                      <div>{'Account_number'|lang}: {$payment.account_number}</div>
                      <div>{$payment.name}</div>
                    </div>
                  </label>
                </div>
              {/if}
            {/foreach}
            <div class="form-group">
              <div class="form-text">
                <strong class="text-danger">{'Transferring_content'|lang}:</strong><br>
                <kbd class="ml-0">{$core->callfunc('utf8_nosign', $arrOneCourse.name)|replace:'tieng Nhat ':''}_{$core->_USER.user_name}_{$core->_USER.mobile}</kbd>
              </div>
            </div>
          </div>
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-code"></i>
              <span>Mã khuyến mại</span>
            </h2>
            <div class="mb-3">
              <div class="input-group">
                <input class="form-control" type="text" id="coupon" name="coupon" placeholder="Nhập mã khuyến mại vào đây">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary ml-2 js-btn-coupon">Áp dụng</button>
                </div>
              </div>
            </div>
            <div class="collapse js-currency-vn">
              <div class="media text-700 mt-1">
                <div class="media-body">Học phí:</div>
                <div class="text-right text-danger">{$core->callfunc("number_format", $arrOneCourse.price_vn, 0, ',', '.')} vnđ</div>
              </div>
              <div class="js-save-block">
                <div class="media text-700 mt-1">
                  <div class="media-body">Khuyến mại:</div>
                  <div class="text-right text-danger">
                    <span class="js-save-vn"></span> vnđ
                  </div>
                </div>
                <div class="media text-20 mt-1">
                  <div class="media-body"><strong>Học phí cần thanh toán:</strong></div>
                  <div class="text-right text-danger">
                    <strong><span class="js-total-vn"></span> vnđ</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="collapse js-currency-jp">
              <div class="media text-700 mt-1">
                <div class="media-body">Học phí:</div>
                <div class="text-right text-danger">{$core->callfunc("number_format", $arrOneCourse.price_jp, 0, ',', '.')} JPY</div>
              </div>
              <div class="js-save-block">
                <div class="media text-700 mt-1">
                  <div class="media-body">Khuyến mại:</div>
                  <div class="text-right text-danger">
                    <sapn class="js-save-jp"></sapn> JPY
                  </div>
                </div>
                <div class="media text-20 mt-1">
                  <div class="media-body"><strong>Học phí cần thanh toán:</strong></div>
                  <div class="text-right text-danger">
                    <strong>
                      <sapn class="js-total-jp"></sapn> JPY
                    </strong>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="payment">
            <h2 class="payment__header">
              <i class="fa fa-money"></i>
              <span>{'Pay_directly_at_Kosei'|lang}</span>
            </h2>
            {assign var="i" value=1}
            {foreach from=$arrListPaymentMethod key=p item=payment}
              {if $payment.ctype eq 1}
                <div class="form-group">
                  <label class="radio-styled">
                    <input class="radio-styled__input" type="radio" name="payment_id" value="{$payment.payment_id}">
                    <span class="radio-styled__icon"></span>
                    <span>{'Base'|lang} {$i}: {$payment.name}</span>
                  </label>
                </div>
                {$i = $i+1}
              {/if}
            {/foreach}
          </div>
        </div>
      </div>
      <div class="text-center pt-30">
        <input type="hidden" name="cat_id" id="cat_id" value="{if $cat_id}{$cat_id}{else}{$smarty.get.cid}{/if}">
        <button class="payment-btn" type="submit" name="btnCheckout" value="checkout">{'Confirm_registration'|lang}</button>
      </div>
    {/if}
  </form>
</div>
