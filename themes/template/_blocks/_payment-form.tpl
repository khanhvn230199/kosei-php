<form class="consultation js-payment-form">
    <input type="hidden" name="cat_id" value="{$curCat.cat_id}">
    <div class="form-row form-group">
        <label class="col-form-label col-md-4 col-xl-3">Họ và tên:</label>
        <div class="col-md-8 col-xl-9">
            <input class="form-control" type="text" value="{$user.fullname}" readonly disabled>
        </div>
    </div>
    <div class="form-row form-group">
        <label class="col-form-label col-md-4 col-xl-3">Số điện thoại:</label>
        <div class="col-md-8 col-xl-9">
            <input class="form-control" type="text" value="{$user.mobile}">
        </div>
    </div>
    <!-- add -->
    <div class="sapo_khoahoc">
        <p>Khóa học : {$curCat.name}</p>
        <p>Học phí : {$core->callfunc("number_format", $curCat.price_vn, 0, ',', '.')} VNĐ</p>
        <p>Thời gian : {$curCat.duration}Tháng <strong>(Thời hạn học kể từ khi mua)</strong></p>
    </div>
    <!-- End -->
    <div class="form-row form-group">
        <label class="col-form-label col-md-4 col-xl-3">Phương thức thanh toán</label>
        <div class="col-md-8 col-xl-9">
            <select class="custom-select js-payment-method" name="payment_method" required>
                <option value="">-- Chọn phương thức thanh toán --</option>
                <option value="0" data-target="#payment-cash">Thanh toán trực tiếp tại Kosei</option>
                <option value="1" data-target="#payment-banking">Chuyển khoản ngân hàng Việt Nam</option>
                <option value="1" data-target="#payment-banking1">Chuyển khoản ngân hàng Nhật Bản</option>
            </select>
            <div class="js-payment-info pt-3 collapse" id="payment-banking">
                <div class="alert alert-info mb-0">
                    <div class="mb-12">
                        <strong class="text-danger">{'Transferring_content'|lang}:</strong><br>
                        <kbd class="ml-0" style="font-family: auto; font-size: 16px;padding-bottom: 0px;padding-top: 0px;">{$core->callfunc('utf8_nosign', $curCat.name)|replace:'tieng Nhat ':''}_{$core->_USER.email}{if $core->_USER.mobile}_{$core->_USER.mobile}{/if}</kbd>
                        <br>
                        Lưu ý: Nội dung chuyển khoản bỏ qua ký tự đặc biệt như: @ . , +, _
                        <br>
                        <!-- <strong>Ví dụ: {$core->callfunc('utf8_nosign', $curCat.slug)|replace:'tieng Nhat ':''}_{$core->_USER.email}</strong> -->
                        <br>
                        {if $core->_USER.mobile}
                        <strong>Hoặc : {$core->callfunc('utf8_nosign', $curCat.slug)|replace:'tieng Nhat ':''}_{$core->_USER.mobile}</strong>
                        {/if}
                        <br>
                    </div>
                    {if $bankAccounts}
                    {foreach from=$bankAccounts item=bank key=key name=name}
                    {if $key eq 0}
                    <div class="mb-12 m-last-0">
                        <div class="text-700">{$bank.name}</div>
                        <div>Chủ tài khoản: <strong>{$bank.account_holder}</strong></div>
                        <div>Số tài khoản: <strong>{$bank.account_number}</strong></div>
                    </div>
                    {/if}
                    {/foreach}
                    {/if}
                </div>
            </div>
            <div class="js-payment-info pt-3 collapse" id="payment-banking1">
                <div class="alert alert-info mb-0">
                   <strong class="text-danger">{'Transferring_content'|lang}:</strong><br>
                        <kbd class="ml-0" style="font-family: auto; font-size: 16px;padding-bottom: 0px;padding-top: 0px;">{$core->callfunc('utf8_nosign', $curCat.name)|replace:'tieng Nhat ':''}_{$core->_USER.email}{if $core->_USER.mobile}_{$core->_USER.mobile}{/if}</kbd>
                        <br>
                        Lưu ý: Nội dung chuyển khoản bỏ qua ký tự đặc biệt như: @ . , +, _
                        <br>
                        <!-- <strong>Ví dụ: {$core->callfunc('utf8_nosign', $curCat.slug)|replace:'tieng Nhat ':''}_{$core->_USER.email}</strong> -->
                        <br>
                        {if $core->_USER.mobile}
                        <strong>Hoặc : {$core->callfunc('utf8_nosign', $curCat.slug)|replace:'tieng Nhat ':''}_{$core->_USER.mobile}</strong>
                        {/if}
                        <br>
                    {if $bankAccounts}
                    {foreach from=$bankAccounts item=bank key=key name=name}
                    {if $key eq 1}
                    <div class="mb-12 m-last-0">
                        <div class="text-700">{$bank.name}</div>
                        <div>Chủ tài khoản: <strong>{$bank.account_holder}</strong></div>
                        <div>Số tài khoản: <strong>{$bank.account_number}</strong></div>
                    </div>
                    {/if}
                    {/foreach}
                    {/if}
                </div>
            </div>
            <div class="js-payment-info pt-3 collapse" id="payment-cash">
                <div class="alert alert-info mb-0">
                    {if $locations}
                    {foreach from=$locations item=location key=key name=name}
                    <div class="mb-12 m-last-0"><strong>Cơ sở {$key + 1}:</strong> {$location.name}</div>
                    {/foreach}
                    {/if}
                </div>
            </div>
        </div>
    </div>
    <div class="form-row form-group">
        <label class="col-form-label col-md-4 col-xl-3">Mã khuyến mại</label>
        <div class="col-md-8 col-xl-9">
            <div class="input-group consultation__promo-code">
                <input class="form-control js-promo-code" type="text" name="coupon" placeholder="Nhập mã khuyến mại tại đây">
                <div class="input-group-append">
                    <button class="input-group-text js-promo-btn" type="button">Áp dụng</button>
                </div>
            </div>
            <div class="js-promo-status">
            </div>
        </div>
    </div>
    <div class="form-row form-group">
        <label class="col-form-label col-md-4 col-xl-3">Ghi chú:</label>
        <div class="col-md-8 col-xl-9">
            <textarea name="note" rows="4" class="form-control" placeholder="Nhập ghi chú"></textarea>
        </div>
    </div>
    <div class="text-center mt-3">
        <button class="consultation__btn js-payment-submit" type="submit">Xác nhận đăng ký</button>
    </div>
</form>