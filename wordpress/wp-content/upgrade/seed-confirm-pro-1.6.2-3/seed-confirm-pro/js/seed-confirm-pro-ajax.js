jQuery(document).ready(function($) {
  $('a[href*="#slip-modal"]').click(function (event) {
    event.preventDefault();
    var orderID = parseInt(
      $(this)
        .attr('href')
        .replace(/[^0-9.]/g, '')
    );
    $.ajax({
      url: phpVars.ajax_url,
      data: {
        action: 'get_shortcode_ajax',
        order_id: orderID,
      },
      beforeSend: function() {
        $('#seed-confirm-slip-modal-loading').show();
      },
    })
    .done(function(response) {
      $('#seed-confirm-slip-modal').modal();
      $('#seed-confirm-slip-modal > #shortcode-append').html(response);

      $('#seed-confirm-slip-modal-loading').hide();

      $('#seed-confirm-slip-upload-button').click(function(event) {
        event.preventDefault();
        $('#seed-confirm-slip').trigger('click');
      });

      $('#seed-confirm-slip').change(function(e) {
        if ($(this).val()) {
          $('#seed-confirm-slip-label').removeAttr('for');
          $('.seed-confirm-slip-form button[type="submit"]').removeAttr('disabled');
          $('.seed-confirm-slip-file-selected-box').show();
          $('.seed-confirm-slip-file-selected-box > span').html(e.target.files[0].name);
        } else {
          $('#seed-confirm-slip-label').attr('for', 'seed-confirm-slip');
          $('.seed-confirm-slip-form button[type="submit"]').attr('disabled', 'disabled');
          $('.seed-confirm-slip-file-selected-box').hide();
          $('.seed-confirm-slip-file-selected-box > span').html('');
        }
      });

      submitForm();
    })
    .fail(function() {
      console.log("error");
    })
  });

  // Submit Form
  function submitForm() {
    $('.seed-confirm-slip-form').on('submit', function(e) {
      var $form = $(this);
      var form_data = new FormData();

      form_data.append('action', 'seed_comfirm_submit');
      form_data.append('order_id', $form.find('input[name="order_id"]').val());
      form_data.append('file', $form.find('input[name="seed-confirm-slip"]')[0].files[0]);
      form_data.append('seed-confirm-ajax-nonce', $form.find('input[name="seed-confirm-ajax-nonce"]').val());
      $.ajax({
        url: phpVars.ajax_url,
        type: 'POST',
        dataType: 'json',
        contentType: false,
        processData: false,
        mimeTypes:"multipart/form-data",
        data: form_data,
        beforeSend: function() {
          $('#seed-confirm-slip-modal-success-loading').show();
        },
      })
      .done(function(response) {
        $('#seed-confirm-slip-modal-success-loading').hide();
        if (!response.success) {
          alert(response.data);
        } else {
          // Remove form
          $('.seed-confirm-slip-form').remove();

          // Show success message
          $('#seed-confirm-upload-success').show();
          setTimeout(function() {
            $('.seed-confirm-upload-success-icon').addClass('active');
          }, 200);
          $('.seed-confirm-upload-success-message').text(response.data.message);

          // Remove confirm order link
          $('a[href="#slip-modal-'+response.data.order_id+'"]').remove();
        }
      })
      .fail(function(xhr, status, error) {
        $('#seed-confirm-slip-modal-success-loading').hide();
        if (!xhr.responseJSON.success) {
          alert(xhr.responseJSON.data);
        }
      })
      e.preventDefault();
    });
  }
});