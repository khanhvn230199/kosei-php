/*
 Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.addTemplates("default", {
  imagesPath : CKEDITOR.getUrl(CKEDITOR.plugins.getPath("templates") + "templates/images/"),
  templates : [
  {
    title : "FAQ",
    image : "templateFAQ.gif",
    description : "FAQ template page",
    html : '<div class="section"><a href="#">Ủy thác là gì?</a><div class="answer">Ủy thác giúp Quý khách lựa chọn các nhà Quản lý tài chính chuyên nghiệp, phù hợp với mục tiêu đầu tư. Khoản đầu tư của Quý khách sẽ được đầu tư và quản lý chuyên nghiệp, đem lại lợi nhuận tối ưu và rủi ro được hạn chế. Quý khách cũng có thể lựa chọn phân bổ vốn đầu tư, hợp tác với nhiều nhà Quản lý để giảm thiểu rủi ro.</div></div><div class="section"><a href="#">Tài khoản đầu tư tối thiểu là gì?</a><div class="answer">Tài khoản đầu tư tối thiểu phụ thuộc vào việc Quý khách lựa chọn nhà Quản lý. Mỗi nhà Quản lý tài chính sẽ có một mức nhận tài sản ủy thác tối thiểu khác nhau, số tiền này có thể thay đổi tùy theo từng hợp đồng.</div></div>'
  }, {
    title : "Image and Title",
    image : "template1.gif",
    description : "One main image with a title and text that surround the image.",
    html : '<h3><img src=" " alt="" style="margin-right: 10px" height="100" width="100" align="left" />Type the title here</h3><p>Type the text here</p>'
  }, {
    title : "Strange Template",
    image : "template2.gif",
    description : "A template that defines two colums, each one with a title, and some text.",
    html : '<table cellspacing="0" cellpadding="0" style="width:100%" border="0"><tr><td style="width:50%"><h3>Title 1</h3></td><td></td><td style="width:50%"><h3>Title 2</h3></td></tr><tr><td>Text 1</td><td></td><td>Text 2</td></tr></table><p>More text goes here.</p>'
  }, {
    title : "Text and Table",
    image : "template3.gif",
    description : "A title with some text and a table.",
    html : '<div style="width: 80%"><h3>Title goes here</h3><table style="width:150px;float: right" cellspacing="0" cellpadding="0" border="1"><caption style="border:solid 1px black"><strong>Table title</strong></caption><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table><p>Type the text here</p></div>'
  }]
});
