

$(function(){
    
    $('#start-novo-questionario').click(function(){
        $('#novoQuestionarioModal').load('Home/novoQuestionarioModal',function(){
            $('#novoQuestionarioModal').modal('show');
        });
    });

});


function EditarPerguntas(){
    window.location = '/Perguntas';
}