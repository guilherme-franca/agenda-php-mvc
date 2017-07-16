/*
*
* Credits : https://github.com/Semantic-Org/Semantic-UI/issues/403
*
*/

var fileExtentionRange = '.png .jpg .jpeg';
var MAX_SIZE = 30; // MB

$(document).on('change', '.btn-file :file', function() {
    var input = $(this);

    if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
        var label = input.val();

        input.trigger('fileselect', [ 1, label, 0 ]);
    } else {
        var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        var numFiles = input.get(0).files ? input.get(0).files.length : 1;
        var size = input.get(0).files[0].size;

        input.trigger('fileselect', [ numFiles, label, size ]);
    }
});

$('.btn-file :file').on('fileselect', function(event, numFiles, label, size) {
    $('#attachmentName').attr('name', 'photo'); // allow upload.

    var postfix = label.substr(label.lastIndexOf('.'));
    if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
        if (size > 1024 * 1024 * MAX_SIZE ) {
            alert('max size：<strong>' + MAX_SIZE + '</strong> MB.');

            $('#attachmentName').removeAttr('name'); // cancel upload file.
        } else {
            $('#_attachmentName').val(label);
        }
    } else {
        alert('file type：<br/> <strong>' + fileExtentionRange + '</strong>');

        $('#attachmentName').removeAttr('name'); // cancel upload file.
    }
});