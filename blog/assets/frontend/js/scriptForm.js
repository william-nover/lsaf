function myFunctionFORM() {
        /* validation */
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z ]+$/i.test(value);
        }, "Letters and spaces only please");
        jQuery.validator.addMethod("correctemail", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Must correct email");
        $("#form-contact").validate({
            rules: {
                contact_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                contact_email: {
                    required: true,
                    correctemail: true,
                    email: true
                },
                contact_message: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                contact_name: {
                    required: "Isi Nama anda",
                    minlength: "Minimum 3 huruf",
                    maxlength: "Maximum 30 huruf"
                },
                contact_email: "Isi alamat email yang benar",
                contact_message: {
                    required: "Isi pesan anda",
                    minlength: "Minimum 5 huruf"
                }
            },
            submitHandler: submitContactForm
        });
        /* validation */
    }
    /* form submit */
function submitContactForm() {
    var data = $("#form-contact").serialize();
    alert(data);
    $.ajax({
        type: 'POST',
        url: document.location.origin + '/contact/postMsg',
        data: data,
    beforeSend: function() {
     var btnSend = '<span class="input-group-append">' +
            '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            $("#btn-submit").html(btnSend);
  }
    }).done(function(result) {
        $("#btn-submit").html("&nbsp;SUBMIT");
        if (result == 1) {
            $('#contact_name').val('');
            $('#contact_email').val('');
            $('#contact_phone').val('');
            $('#contact_subject').val('');
            $('#contact_message').val('');
        } else {

            $('#contact_name').val('');
            $('#contact_email').val('');
            $('#contact_phone').val('');
            $('#contact_subject').val('');
            $('#contact_message').val('');
            $('#captcha_error').html('Robot verification failed, please try again.');
        }
    }).fail(function() {
        $('#contact_name').val('');
        $('#contact_email').val('');
        $('#contact_phone').val('');
        $('#contact_subject').val('');
        $('#contact_message').val('');
        $('#captcha_error').html('Robot verification failed, please try again.');
    })

}