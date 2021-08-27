
const logout = () => {
    $.ajax({
        url: `/logout`,
        type: 'POST',
        data: {},
        cache: false,
        contentType: 'application/x-www-form-urlencoded',
        success: () => {
            window.location.href = "/";
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

const showMessage = (alertText) => {

    $('.modal').hide();
    $('.modal').remove();
  
    let modal =
        `<div id="msg-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mensagem do Administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>${alertText}</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>`;
  
    $("body").append(modal);
    $('#msg-modal').modal({ keyboard: false,backdrop: 'static',show:true });	
}

const changePage = (id, page) => {    
    $(".page").each(function() {
        $( this ).addClass( "d-none" );
    });

    $(".page-item").each(function() {
        $( this ).removeClass( "active" );
    });

    $(`#${id}`).addClass( "active" );

    $(`.page-${page+1}`).removeClass( "d-none" );
}