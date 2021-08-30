
$(document).ready(function(){
    reloadData();
});

const loadCompany = () => {

    $.ajax({
        url: `/company`,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded',
        success: (data) => {
            data = JSON.parse(data)
            let html = '';

            for (i = 0; i < data.length; i++) {
                html +=`<option value="${data[i].id}">${data[i].cnpj}</option>`;
            }
            $("#company_id").empty().html(html);
        },
        error: (xhr, error_text, statusText) => {
            console.log({
                xhr: xhr,
                error_text: error_text,
                statusText: statusText
            })
        }
    });
}

const reloadData = () => {
    $.ajax({
        url: `/debtor`,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded',
        success: (data) => {
            data = JSON.parse(data)
            let html = '';
            let pagination_html = '';

            for (i = 0; i < data.length; i++) {
                beginNum = [0,1,2,3,4,5,6,7,8,9];

                html +=`<tr class="page page-${Math.ceil(i/10)} `;

                if(beginNum.indexOf(i) == -1) {
                    html +=`d-none">`;
                }

                html +=`
                 <th id="th-table" scope="row">${data[i].id}</th>
                    <td>${data[i].id}</td>
                    <td>${data[i].company_id}</td>
                    <td>${data[i].type_cod}</td>
                    <td>${data[i].cod}</td>
                    <td>${data[i].date_of_birth}</td>
                    <td>${data[i].email}</td>
                    <td>${data[i].address}</td>
                    <td>${data[i].description}</td>
                    <td>${data[i].value}</td>
                    <td>${data[i].expiration}</td>
                    <td>
                        <a class="btn btn-primary w-100 mb-2" href="/debtors/edit/${data[i].id}" role="button">Editar</a>
                        <button type="button" class="btn btn-primary w-100" onClick="removeData('${data[i].id}')">Deletar</button>
                    </td>
                </tr>`;
            }

            for (i = 0; i < Math.ceil(data.length / 10); i++) {
                pagination_html += `<li id="page-a-${i}" class="`;
                
                if( i + 1 ==  Math.ceil(data.length / 10 )) {
                    pagination_html += `page-last `;
                }
                
                pagination_html += `page-item"><a class="page-link" onClick="changePage('page-a-${i}',${i})">${i+1}</a></li>`;
            }
            
            $("#data-container").empty().html(html);
            $("#pagination").empty().html(pagination_html);
            $("#page-a-0").addClass("active");
            $("#th-table").remove();

        },
        error: (xhr, error_text, statusText) => {
            console.log({
                xhr: xhr,
                error_text: error_text,
                statusText: statusText
            })
        }
    })
}

const removeData = (id) => {

    $.ajax({
        url: `/debtor/${id}/delete`,
        type: 'DELETE',
        contentType: 'application/x-www-form-urlencoded',
        success: () => {
            showMessage("Devedor deletado com sucesso");
            reloadData();
        },
        error: (xhr, error_text, statusText) => {
            console.log({
                xhr: xhr,
                error_text: error_text,
                statusText: statusText
            })
        }
    })
}

const edit = () => {

    $("#cod").val() == '' ? $("#cod-error-01").removeClass("d-none") : $("#cod-error-01").addClass("d-none");
    $("#email").val() == '' ? $("#email-error-01").removeClass("d-none") : $("#email-error-01").addClass("d-none");
    $("#description").val() == '' ? $("#description-error-01").removeClass("d-none") : $("#description-error-01").addClass("d-none");
    $("#value").val() == '' ? $("#value-error-01").removeClass("d-none") : $("#value-error-01").addClass("d-none");

    if($("#email").val() != '' && $("#cnpj").val() != '') {
        let id = window.location.href.split('edit/')[1];

        $.ajax({
            url: `/debtors/${id}`,
            type: 'PATCH',
            data: {
                email: $("#email").val(),
                address: $("#address").val(),
                type_cod: $("#type_cod").val(),
                cod: $("#cod").val(),
                company_id: $("#company_id").val(),
                date_of_birth: $("#date_of_birth").val(),
                description: $("#description").val(),
                value: $("#value").val(),
                expiration: $("#expiration").val(),
            },
            contentType: 'application/x-www-form-urlencoded',
            success: () => {
                console.log('vai editar');
                showMessage("Devedor atualizado com sucesso");
                
                setTimeout(function(){ 
                    window.location.href = "/debtors/list";
                }, 1000);
            },
            error: (xhr, error_text, statusText) => {
                switch (JSON.parse(xhr.responseText).message) {
                    case "This record already exists":
                        showMessage("Este devedor já foi cadastrado");
                    break;
                        
                    default:
                        showMessage("Erro desconhecido. Não foi possível atualizar este devedor");
                    break;
                }
                console.log({
                    xhr: xhr,
                    error_text: error_text,
                    statusText: statusText
                })
            }
        });
    }
}

const create = () => {
    $("#cod").val() == '' ? $("#cod-error-01").removeClass("d-none") : $("#cod-error-01").addClass("d-none");
    $("#email").val() == '' ? $("#email-error-01").removeClass("d-none") : $("#email-error-01").addClass("d-none");
    $("#description").val() == '' ? $("#description-error-01").removeClass("d-none") : $("#description-error-01").addClass("d-none");
    $("#value").val() == '' ? $("#value-error-01").removeClass("d-none") : $("#value-error-01").addClass("d-none");
    $("#expiration").val() == '' ? $("#expiration-error-01").removeClass("d-none") : $("#expiration-error-01").addClass("d-none");
    
    if($("#cod").val() != '' && $("#email").val() != '' && $("#description").val() != '' && $("#value").val() != '' && $("#expiration").val() != '') {
       
        $.ajax({
            url: `/debtor`,
            type: 'POST',
            data: {
                email: $("#email").val(),
                address: $("#address").val(),
                type_cod: $("#type_cod").val(),
                cod: $("#cod").val(),
                company_id: $("#company_id").val(),
                date_of_birth: $("#date_of_birth").val(),
                description: $("#description").val(),
                value: $("#value").val(),
                expiration: $("#expiration").val()
            },
            contentType: 'application/x-www-form-urlencoded',
            success: (data) => {
                console.log(data);
                showMessage("Empresa cadastrada com sucesso");
                setTimeout(function(){ 
                    window.location.href = "/debtors/list";
                }, 1000);
            },
            error: (xhr, error_text, statusText) => {
                showMessage("Não foi possível cadastrar esta empresa");
                console.log({
                    xhr: xhr,
                    error_text: error_text,
                    statusText: statusText
                })
            }
        })
    }
}