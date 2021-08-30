$(document).ready(function(){
    reloadData();
});

const reloadData = () => {
    $.ajax({
        url: `/company`,
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
                    <td>${data[i].email}</td>
                    <td>${data[i].address}</td>
                    <td>${data[i].telephone}</td>
                    <td>${data[i].cnpj}</td>
                    <td>
                        <a class="btn btn-primary w-100 mb-2" href="/company/edit/${data[i].id}" role="button">Editar</a>
                        <button type="button w-100" class="btn btn-primary" onClick="removeData('${data[i].id}')">Deletar</button>
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
        url: `/company/${id}/delete`,
        type: 'DELETE',
        contentType: 'application/x-www-form-urlencoded',
        success: () => {
            showMessage("Empresa deletada com sucesso");
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

    $("#email").val() == '' ? $("#email-error-01").removeClass("d-none") : $("#email-error-01").addClass("d-none");
    $("#cnpj").val() == '' ? $("#cnpj-error-01").removeClass("d-none") : $("#cnpj-error-01").addClass("d-none");

    if($("#email").val() != '' && $("#cnpj").val() != '') {
        let id = window.location.href.split('edit/')[1];

        $.ajax({
            url: `/company/${id}`,
            type: 'PATCH',
            data: {
                email: $("#email").val(),
                address: $("#address").val(),
                telephone: $("#telephone").val(),
                cnpj: $("#cnpj").val()
            },
            contentType: 'application/x-www-form-urlencoded',
            success: (data) => {
                showMessage("Empresa atualizada com sucesso");
                
                setTimeout(function(){ 
                    window.location.href = "/company/list";
                }, 1000);
            },
            error: (xhr, error_text, statusText) => {
                switch (JSON.parse(xhr.responseText).message) {
                    case "This record already exists":
                        showMessage("Esta empresa já foi cadastrada");
                    break;
                        
                    default:
                        showMessage("Erro desconhecido. Não foi possível atualizar a empresa");
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

    $("#email").val() == '' ? $("#email-error-01").removeClass("d-none") : $("#email-error-01").addClass("d-none");
    $("#cnpj").val() == '' ? $("#cnpj-error-01").removeClass("d-none") : $("#cnpj-error-01").addClass("d-none");
    
    if($("#email").val() != '' && $("#cnpj").val() != '') {
       
        $.ajax({
            url: `/company`,
            type: 'POST',
            data: {
                email: $("#email").val(),
                password: $("#cnpj").val(),
                address: $("#address").val(),
                telephone: $("#telephone").val(),
                cnpj: $("#cnpj").val()
            },
            contentType: 'application/x-www-form-urlencoded',
            success: () => {
                showMessage("Empresa cadastrada com sucesso");
                setTimeout(function(){ 
                    window.location.href = "/company/list";
                }, 1000);
            },
            error: (xhr, error_text, statusText) => {
                switch (JSON.parse(xhr.responseText).message) {
                    case "This record already exists":
                        showMessage("Esta empresa já foi cadastrada");
                    break;
                        
                    default:
                        showMessage("Erro desconhecido. Não foi possível cadastrar esta empresa");
                    break;
                }
                console.log({
                    xhr: xhr,
                    error_text: error_text,
                    statusText: statusText
                })
            }
        })
    }
}

const loadUser = () => {
    let id = window.location.href.split('edit/')[1];
    console.log(id);
    
    $.ajax({
        url: `/company/${id}/show`,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded',
        success: (data) => {
            console.log(data.email);
            data = JSON.parse(data)
            $("#email").val(data[0].email);
            $("#address").val(data[0].address);
            $("#telephone").val(data[0].telephone);
            $("#cnpj").val(data[0].cnpj)
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