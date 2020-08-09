

$(function(){

    $('#start-novo-questionario').click(function(){
        $('#novoQuestionarioModal').load('/Home/novoQuestionarioModal',function(){
            $('#novoQuestionarioModal').modal('show');
        });
    });

});


function EditarPerguntas(){
    window.location = '/Perguntas';
}

function Analise(){
    window.location = '/Analise';
}

function CadastrarUsuarios(){
    window.location = '/Users';
}

function EditarTermo(){
    window.location = '/Admin/editar_termo';
}
