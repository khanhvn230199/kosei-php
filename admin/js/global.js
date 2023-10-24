// JavaScript Document
function gotoUrl(url){
	window.location.href = url;
	return false;
}
function confirmUrl(url){
	if (confirm("Bạn có chắc thực hiện hành động này không?")){
		window.location.href = url;
		return true;
	}
	return false;
}
function confirmRemove(url){
	if (confirm("Bạn có chắc muốn xóa không?")){
		gotoUrl(url);
	}
	return false;
}
function submitform(formid){
	if (typeof formid == "undefined"){
		formid = "theForm";
	}
	$("#"+formid).submit();
	return false;
}
function changeTTime(id, id_from, id_to){
	var from = $('#'+id+' :selected').attr('rel');
	var to = $('#'+id+' :selected').attr('rev');
	$("#"+id_from).val(from);
	$("#"+id_to).val(to);
}
/*begin for category*/
function change_category_ctype(){
	var ctype = $("#ctype").val();
	gotoUrl(vncms_url_admin+"/?mod=category&ctype=" + ctype);
}
/*begin for category*/
function change_payment_ctype(){
	var ctype = $("#ctype").val();
	gotoUrl(vncms_url_admin+"/?mod=payment&ctype=" + ctype);
}
function change_category_dtype(){
	var dtype = $("#dtype").val();
	gotoUrl(vncms_url_admin+"/?mod=defines&dtype=" + dtype);
}
function ajax_get_cat_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_name = $("#name").val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ' ');
	var cur_slug = $("#slug").val();
	if (cur_slug!="" && modeInt==1){
		ajax_check_cat_slug(modeInt);		
	}else{
		var url1 = vncms_url_admin + "/?sub=ajax&act=get_cat_slug&cat_name=" + cur_name;
		$.ajax({	
				type: "POST",
				url: url1,
				dataType: 'html',
				data: {}
		}).done(function(msg) {
			$("#slug").val(msg);
		}).fail(function(msg){
			
		});
	}
	return false;
}
function ajax_check_cat_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_slug = $("#slug").val();	
	var url1 = vncms_url_admin + "/?sub=ajax&act=check_cat_slug&slug=" + cur_slug + "&old_slug=" + old_slug;
	$.ajax({	
			type: "POST",
			url: url1,
			dataType: 'html',
			data: {}
	}).done(function(msg) {
		if (msg==0){//if Slug is exists
			$("#slug").parent().find('span.red').remove();
			$("#slug").parent().append("<span class='red'>Slug URL '" + cur_slug +"' đã tồn tại rồi</span>");
			setTimeout(function(){remove_slug_alert();ajax_get_cat_slug(0);}, 1000);						
		}
	}).fail(function(msg){
		
	});
	var cur_slug = $("#slug").val();
	$("#slug").val(cur_slug.trim());	
	return false;
}
function ajax_get_exam_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_name = $("#name").val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ' ');
	var cur_slug = $("#slug").val();
	if (cur_slug!="" && modeInt==1){
		ajax_check_exam_slug(modeInt);
	}else{
		var url1 = vncms_url_admin + "/?sub=ajax&act=get_exam_slug&exam_name=" + cur_name;
		$.ajax({
				type: "POST",
				url: url1,
				dataType: 'html',
				data: {}
		}).done(function(msg) {
			$("#slug").val(msg);
		}).fail(function(msg){

		});
	}
	return false;
}
function ajax_check_exam_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_slug = $("#slug").val();
	var url1 = vncms_url_admin + "/?sub=ajax&act=check_exam_slug&slug=" + cur_slug + "&old_slug=" + old_slug;
	$.ajax({
			type: "POST",
			url: url1,
			dataType: 'html',
			data: {}
	}).done(function(msg) {
		if (msg==0){//if Slug is exists
			$("#slug").parent().find('span.red').remove();
			$("#slug").parent().append("<span class='red'>Slug URL '" + cur_slug +"' đã tồn tại rồi</span>");
			setTimeout(function(){remove_slug_alert();ajax_get_exam_slug(modeInt);}, 1000);
		}
	}).fail(function(msg){

	});
	var cur_slug = $("#slug").val();
	$("#slug").val(cur_slug.trim());
	return false;
}
function ajax_get_trialtest_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_name = $("#name").val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ' ');
	var cur_slug = $("#slug").val();
	if (cur_slug!="" && modeInt==1){
		ajax_check_trialtest_slug(modeInt);
	}else{
		var url1 = vncms_url_admin + "/?sub=ajax&act=get_trialtest_slug&test_name=" + cur_name;
		$.ajax({
				type: "POST",
				url: url1,
				dataType: 'html',
				data: {}
		}).done(function(msg) {
			$("#slug").val(msg);
		}).fail(function(msg){

		});
	}
	return false;
}
function ajax_check_trialtest_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_slug = $("#slug").val();
	var url1 = vncms_url_admin + "/?sub=ajax&act=check_trialtest_slug&slug=" + cur_slug + "&old_slug=" + old_slug;
	$.ajax({
			type: "POST",
			url: url1,
			dataType: 'html',
			data: {}
	}).done(function(msg) {
		if (msg==0){//if Slug is exists
			$("#slug").parent().find('span.red').remove();
			$("#slug").parent().append("<span class='red'>Slug URL '" + cur_slug +"' đã tồn tại rồi</span>");
			setTimeout(function(){remove_slug_alert();ajax_get_trialtest_slug(modeInt);}, 1000);
		}
	}).fail(function(msg){

	});
	var cur_slug = $("#slug").val();
	$("#slug").val(cur_slug.trim());
	return false;
}
function ajax_get_test_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_name = $("#name").val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, ' ');
	var cur_slug = $("#slug").val();
	if (cur_slug!="" && modeInt==1){
		ajax_check_test_slug(modeInt);
	}else{
		var url1 = vncms_url_admin + "/?sub=ajax&act=get_test_slug&test_name=" + cur_name;
		$.ajax({
				type: "POST",
				url: url1,
				dataType: 'html',
				data: {}
		}).done(function(msg) {
			$("#slug").val(msg);
		}).fail(function(msg){

		});
	}
	return false;
}
function ajax_check_test_slug(modeInt){//modeInt==0 is New, ==1 is Edit
	var cur_slug = $("#slug").val();
	var url1 = vncms_url_admin + "/?sub=ajax&act=check_test_slug&slug=" + cur_slug + "&old_slug=" + old_slug;
	$.ajax({
			type: "POST",
			url: url1,
			dataType: 'html',
			data: {}
	}).done(function(msg) {
		if (msg==0){//if Slug is exists
			$("#slug").parent().find('span.red').remove();
			$("#slug").parent().append("<span class='red'>Slug URL '" + cur_slug +"' đã tồn tại rồi</span>");
			setTimeout(function(){remove_slug_alert();ajax_get_test_slug(modeInt);}, 1000);
		}
	}).fail(function(msg){

	});
	var cur_slug = $("#slug").val();
	$("#slug").val(cur_slug.trim());
	return false;
}
function remove_slug_alert(){
	$("#slug").parent().find('span.red').remove();
}
/*end for category*/
/*Begin DocSo -> Chu*/
var ChuSo=new Array(" không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín ");
var Tien=new Array( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");
//1. Hàm đọc số có ba chữ số;
function DocSo3ChuSo(baso)
{
    var tram;
    var chuc;
    var donvi;
    var KetQua="";
    tram=parseInt(baso/100);
    chuc=parseInt((baso%100)/10);
    donvi=baso%10;
    if(tram==0 && chuc==0 && donvi==0) return "";
    if(tram!=0)
    {
        KetQua += ChuSo[tram] + " trăm ";
        if ((chuc == 0) && (donvi != 0)) KetQua += " linh ";
    }
    if ((chuc != 0) && (chuc != 1))
    {
            KetQua += ChuSo[chuc] + " mươi";
            if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh ";
    }
    if (chuc == 1) KetQua += " mười ";
    switch (donvi)
    {
        case 1:
            if ((chuc != 0) && (chuc != 1))
            {
                KetQua += " mốt ";
            }
            else
            {
                KetQua += ChuSo[donvi];
            }
            break;
        case 5:
            if (chuc == 0)
            {
                KetQua += ChuSo[donvi];
            }
            else
            {
                KetQua += " lăm ";
            }
            break;
        default:
            if (donvi != 0)
            {
                KetQua += ChuSo[donvi];
            }
            break;
        }
    return KetQua;
}

//2. Hàm đọc số thành chữ (Sử dụng hàm đọc số có ba chữ số)

function DocTienBangChu(SoTien)
{
    var lan=0;
    var i=0;
    var so=0;
    var KetQua="";
    var tmp="";
    var ViTri = new Array();
    if(SoTien<0){ //return "Số tiền âm !";
			SoTien = -1 * SoTien;
		}
    if(SoTien==0) return "";
    if(SoTien>0)
    {
        so=SoTien;
    }
    else
    {
        so = -SoTien;
    }
    if (SoTien > 8999999999999999)
    {
        //SoTien = 0;
        return "Số quá lớn!";
    }
    ViTri[5] = Math.floor(so / 1000000000000000);
    if(isNaN(ViTri[5]))
        ViTri[5] = "0";
    so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
    ViTri[4] = Math.floor(so / 1000000000000);
     if(isNaN(ViTri[4]))
        ViTri[4] = "0";
    so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
    ViTri[3] = Math.floor(so / 1000000000);
     if(isNaN(ViTri[3]))
        ViTri[3] = "0";
    so = so - parseFloat(ViTri[3].toString()) * 1000000000;
    ViTri[2] = parseInt(so / 1000000);
     if(isNaN(ViTri[2]))
        ViTri[2] = "0";
    ViTri[1] = parseInt((so % 1000000) / 1000);
     if(isNaN(ViTri[1]))
        ViTri[1] = "0";
    ViTri[0] = parseInt(so % 1000);
  if(isNaN(ViTri[0]))
        ViTri[0] = "0";
    if (ViTri[5] > 0)
    {
        lan = 5;
    }
    else if (ViTri[4] > 0)
    {
        lan = 4;
    }
    else if (ViTri[3] > 0)
    {
        lan = 3;
    }
    else if (ViTri[2] > 0)
    {
        lan = 2;
    }
    else if (ViTri[1] > 0)
    {
        lan = 1;
    }
    else
    {
        lan = 0;
    }
    for (i = lan; i >= 0; i--)
    {
       tmp = DocSo3ChuSo(ViTri[i]);
       KetQua += tmp;
       if (ViTri[i] > 0) KetQua += Tien[i];
       if ((i > 0) && (tmp.length > 0)) KetQua += ',';//&& (!string.IsNullOrEmpty(tmp))
    }
   if (KetQua.substring(KetQua.length - 1) == ',')
   {
        KetQua = KetQua.substring(0, KetQua.length - 1);
   }
   KetQua = KetQua.substring(1,2).toUpperCase()+ KetQua.substring(2);
   return KetQua;//.substring(0, 1);//.toUpperCase();// + KetQua.substring(1);
}
function setNum2Text(numid, txtid){
	var i = $("#" + numid).val();
	$("#" + txtid).html(DocTienBangChu(i));
}
function showNumberText(event, obj){
	var i = $(obj).val();
	i = i.replace(/[^0-9]/g, '');
	var html = "<span>"+DocTienBangChu(i)+"</span>";
	$(obj).parent().find("span").remove();
	$(obj).parent().append(html);

	executeComma(event, obj);
}
/*begin for number*/
function executeComma2(fr) {
	var temp = fr.value;
	for (i=0;i<temp.length;i++) {
		for (k=i;k<temp.length;k++) {
			if (temp.charAt(k) == '.') {
				temp = temp.replace('.','');
			}
		}
	}

	var j = 0;
	var s = "";
	var s1 = "";
	var s2 = "";
	for (i=temp.length-1;i>=0;i--) {
		j = j+1;
		if (j == 3) {
			j = 0;
			s1 = temp.substring(0,i);
			s2 = temp.substring(i,i+3);
			s = "." + s2 + s;
		}
	}
	if (s1.length > 0) {
		//alert(s1.length);
		s = s1 + s;
		fr.value = s;
	}else if (s.length > 0 && s2.length > 0){
		fr.value = s.substring(1,s.length);
	}
}
function executeComma(event,fr) {
	var temp1 = fr.value;
	var temp, first='';
	if (temp1[0]=='-'){
		temp = temp1.substring(1);
		first = temp1[0];
	}else{
		temp = temp1;
	}
	fr.value = temp.replace(/[^0-9]/g, '');
	if ((event.keyCode >= 96 && event.keyCode <= 105)) {
		executeComma2(fr);
	}
	else if (event.keyCode >= 48 && event.keyCode <= 57) {
		executeComma2(fr);
	}
	else if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
		executeComma2(fr);
	}
	else {
		executeComma2(fr);
	}
	fr.value = first + fr.value;
}
/*end for number*/
/*begin unicode*/
function clearInput(obj) {
    $(obj).val('');
}
var uniChars =   "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZàáảãạâầấẩẫậăằắẳẵặèéẻẽẹêềếểễệđìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửữựỳýỷỹỵÀÁẢÃẠÂẦẤẨẪẬĂẰẮẲẴẶÈÉẺẼẸÊỀẾỂỄỆĐÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỮỰỲÝỶỸỴÂĂĐÔƠƯ1234567890~!@#$%^&*()_+=-{}][|\":;'\\/.,<>? \n\r\t";
var KoDauChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZaaaaaaaaaaaaaaaaaeeeeeeeeeeediiiiiooooooooooooooooouuuuuuuuuuuyyyyyAAAAAAAAAAAAAAAAAEEEEEEEEEEEDIIIOOOOOOOOOOOOOOOOOOOUUUUUUUUUUUYYYYYAADOOU1234567890~!@#$%^&*()_+=-{}][|\":;'\\/.,<>? \n\r\t";
var Alphabe = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890";
function UnicodeToKoDau(s)
{
    var retVal = '';
    if (s == null)
        return retVal;
    var pos;
    var c = 'a';
    for (var i = 0; i < s.length; i++)
    {
        if(c == ' ' && s[i] == ' ')
        continue;
        c = s[i];
        pos = uniChars.indexOf(c);
        if (pos >= 0)
            retVal += KoDauChars[pos];
    }
    return retVal;
}
function UnicodeToKoDauUrl(s)
{
	
    var retval = '';
    if (s != null && s != '')
    {
        var reg_replace_white_space = new RegExp('( )+', "g");
        s =  s.replace(reg_replace_white_space, '-');
        if(s.length > 100)
            s = s.substring(0, 100);
        s = UnicodeToKoDau(s);
        var reg_replace_html_tag = new RegExp('<[^>]*>');
        s = s.replace(reg_replace_html_tag, '');
        var ss = '';
        var k = '-';
        for (var i = 0; i < s.length; i++)
        {
            if (Alphabe.indexOf(s[i]) >= 0){
                ss += s[i];
                k = s[i];
        	}else
            if (i<s.length-1 && k!='-'){
                ss += '-';
                k = '-';
            }
        }
        if (k=='-'){
        	ss = ss.slice(0, -1);
        }
        ss = ss.replace(reg_replace_white_space, '-');
        ss = ss.replace('-----', '-');
        ss = ss.replace('----', '-');
        ss = ss.replace('---', '-');
        ss = ss.replace('--', '-');
        ss = ss.replace('--', '-');
        ss = ss.replace('--', '-');
        ss = ss.replace('--', '-');
        ss = ss.replace('--', '-');
        ss = ss.replace('--', '-');
        retval = ss;
        var reg_replace_urlchar = new RegExp('-+');
        retval = retval.replace(reg_replace_urlchar, '-').toLowerCase();
        return retval.length > 250 ? retval.substring(0, 250) : retval;
    }
    return retval;
}
/*end unicode*/
function getSlug(fromObj, toId){
	var s = $(fromObj).val();
	$("#"+toId).val(UnicodeToKoDauUrl(s));
}

function openPopup(url, title, twidth, theight){
	var tposx= (screen.width- twidth)/2
	var tposy= (screen.height- theight)/2;		
	var newWin=window.open(url, title, "toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no,menubar=no, location=no")
	newWin.moveTo(tposx,tposy);
	newWin.focus();	
}
function refreshAndClose() {
	window.opener.location.reload(true);
	window.close();
}
function isImageUrl(url){
	var arr = [ "jpeg", "jpg", "gif", "png" ];
	var ext = url.substring(url.lastIndexOf(".")+1);	
	if(arr.indexOf(ext)>=0){     
		return true;
	}	
	return false;
}
/**
 * Format a price
 * 
 * @param div
 */
function format_price(div) {
    x = $(div).val();
    //x = x.replace(/\,/g,'');
    x = x.replace(/[^\d]/g, '');
    num = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $(div).val(num);
}
/**
 * No accept Enter Key
 *
 */
function noAcceptEnter(event){
	var x = event.which || event.keyCode;
	if (x==13)  return false;
	return true;
}

function ajax_get_district(){
	var province_id = $("#province_id").val();
	var url1 = vncms_url_admin  + "/?sub=ajax&act=get_district&province_id=" + province_id; 
	$.ajax({	
			type: "GET",
			url: url1,
			dataType: 'html',
	}).done(function(data) { //alert(data);
		$("#district_id").html(data);
	}).fail(function(data){
		
	});
}

function alertClearCacheDone(){
	alert("Đã xóa hết cache hệ thống.");
	location.href = "?";
}

function confirmClone(mod, retur) {
    var total = 0;
    var fmobj = document.theForm;
    for (var i = 0; i < fmobj.elements.length; i++) {
        var e = fmobj.elements[i];
        if ((e.name != 'allbox') && (e.type == 'checkbox') && (!e.disabled)) {
            if (e.checked) total++;
        }
    }
    if (total == 0) {
        alert('Bạn phải chọn ít nhất 1 bản ghi!');
        return false;
    }
    if (confirm("Bạn có muốn nhân đôi không [OK]:Yes [Cancel]:No?")) {
        document.theForm.action = "?mod=" + mod + "&act=clone&" + retur;
        document.theForm.submit();
        return true;
    }
    return false;
}