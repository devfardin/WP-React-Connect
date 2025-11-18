jQuery(document).ready(function ($) {
    $('#upload_logo_button').click(function (e) {
        e.preventDefault();
        var mediaUploader = wp.media({
            title: 'Select Brand Logo',
            button: { text: 'Use this logo' },
            multiple: false,
            library: { type: 'image' }
        });
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#react_logo_url').val(attachment.url);
            $('#logo_preview').html('<img src="' + attachment.url + '" alt="Logo Preview" />');
            $('#remove_logo_button').show();
        });
        mediaUploader.open();
    });

    $('#remove_logo_button').click(function (e) {
        e.preventDefault();
        $('#react_logo_url').val('');
        $('#logo_preview').html('');
        $(this).hide();
    });
});