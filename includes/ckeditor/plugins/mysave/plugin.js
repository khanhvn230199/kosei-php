CKEDITOR.plugins.add('mysave',
{
    init: function (editor) {
        var pluginName = 'mysave';
        editor.ui.addButton('Save',
            {
                label: 'Save this content',
                command: 'MySave',
                icon: CKEDITOR.plugins.getPath('mysave') + 'mybuttonicon.gif'
            });
        var cmd = editor.addCommand('MySave', { exec: mySave });
    }
});
function mySave(e) {
    savecontinue();
}