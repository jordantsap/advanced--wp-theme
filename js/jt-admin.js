jQuery(document).ready(function($){

  var mediaUploader;

  $('#upload_profile_picture').on('click',function(e) {
    e.preventDefault();
    if( mediaUploader ) {
      mediaUploader.open();
      return;
    }

    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Chooce a Profile Picture',
      button: {
        text: 'Choose Picture'
      },
      multiple: false
    });

    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJson();
      $('#profile-picture').val(attachment.url);
    });
    mediaUploader.open();

  });

});
