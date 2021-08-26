
const auth = () => {
    $("#email-error-02").addClass("d-none")
    $("#password-error-02").addClass("d-none")
    $("#email").val() == '' ? $("#email-error-01").removeClass("d-none") : $("#email-error-01").addClass("d-none");
    $("#password").val() == '' ? $("#password-error-01").removeClass("d-none") : $("#password-error-01").addClass("d-none");
    
    if($("#email").val() != '' && $("#password").val()) {
        $.ajax({
            url: `${window.location.href}auth/`,
            type: 'POST',
            data: {
                email: $("#email").val(),
                password: $("#password").val()
            },
            cache: false,
            contentType: 'application/x-www-form-urlencoded',
            success: () => {
                window.location.href = "/home";
            },
            error: (xhr, error_text, statusText) => {
                if(xhr.status == 401) {
                    $("#email-error-02").removeClass("d-none");
                    $("#password-error-02").removeClass("d-none")
                } else {
                    console.log({
                        xhr: xhr,
                        error_text: error_text,
                        statusText: statusText
                    })
                }
            }
        })
    }
}