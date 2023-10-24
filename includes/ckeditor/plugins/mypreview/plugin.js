CKEDITOR.plugins.add('mypreview',
{
    init: function (editor) {
        var pluginName = 'mypreview';
        editor.ui.addButton('Preview',
            {
                label: 'Preview this content',
                command: 'myPreview',
                icon: CKEDITOR.plugins.getPath('mypreview') + 'mybuttonicon.gif'
            });
        var cmd = editor.addCommand('myPreview', { exec: myPreview });
    }
});
function myPreview(e) {
	$("#content").html(CKEDITOR.instances[e.name].getData());
	var url = "../?";
	var lang_code = $("#lang_code").val();
	if ($("#is_page").length>0){
		var template = $("#template").val();
		url = url + 'lang=' + lang_code + '&act=page_preview&template=' + template + '&page_name=' + $("#name").val();
	}else
	if ($("#is_post").length>0){
		url = url + 'lang=' + lang_code + '&act=post_preview&post_title=' + $("#title").val();
	}
    window.open(url, 'MyWindow', 'width=1024,height=700,scrollbars=yes,scrolling=yes,location=no,toolbar=no');
}