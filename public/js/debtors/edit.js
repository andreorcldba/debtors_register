
let id = window.location.href.split('edit/')[1];

$.ajax({
    url: `/debtor/${id}/show`,
    type: 'GET',
    contentType: 'application/x-www-form-urlencoded',
    success: (data) => {
        console.log(data.email);
        data = JSON.parse(data)
        $("#company_id").val(data[0].company_id);
        $("#type_cod").val(data[0].type_cod);
        $("#cod").val(data[0].cod);
        $("#date_of_birth").val(data[0].date_of_birth);
        $("#email").val(data[0].email);
        $("#address").val(data[0].address);
        $("#description").val(data[0].description);
        $("#value").val(data[0].value);
        $("#cnpj").val(data[0].cnpj);
    },
    error: (xhr, error_text, statusText) => {
        console.log({
            xhr: xhr,
            error_text: error_text,
            statusText: statusText
        })
    }
})
