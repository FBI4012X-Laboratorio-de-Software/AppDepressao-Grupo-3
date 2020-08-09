
<script>

    function ExportExcel(){
        window.location = '/Analise/ExportExcel';
    }
</script>

 <div class="col-lg-12 col-md-12 col-sm-6 col-6">

    
    <div class="row">
        <button class="btn btn-success" onclick="ExportExcel()"> <i class="fas fa-file-excel"></i> Exportar Excel</button>
        <table class="table table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Pergunta</th>
                    <th>Sintoma Atribuido</th>
                    <!-- <th>Des</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $pergunta): ?>
                    <tr>
                        <td>
                            <?= esc($pergunta->question_desc) ?>
                        </td>
                        <td>
                            <?php switch ($pergunta->question_symp):
                                case null:
                                    echo '--';
                                break;
                                case \App\Models\QuestionSymp::depressao:
                                    echo 'Depressão';
                                break;
                                case \App\Models\QuestionSymp::ansiedade:
                                    echo 'Ansiedade';
                                break;
                                case \App\Models\QuestionSymp::stress:
                                    echo 'Stress';
                                break;
                                
                                default:
                                    echo '--';
                                break;
                             ?>
                              <?php endswitch ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="option-list" colspan="2">
                            <table class="table table-sm option-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Opções</th>
                                        <th>Total de respostas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pergunta->options as $option): ?>
                                        <tr>
                                            <td>
                                                <?= esc($option->question_item_desc) ?>
                                            </td>
                                            <td>
                                                <?= esc($option->reply_total) ?>
                                            </td>
                                        </tr>
                                        <?php if(!empty($option->reply_list)): ?>
                                            <tr>
                                                <td class="plus-title" colspan="2">
                                                    Respostas Descritivas:
                                                </td>
                                            </tr>
                                            <?php foreach ($option->reply_list as $reply): ?>
                                                <tr>
                                                    <td colspan="2" class="plus">
                                                        <?= esc($reply['reply_text']) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif ?>

                                        <?php if(!empty($option->justification_list)): ?>
                                            <tr>
                                                <td class="plus-title" colspan="2">
                                                    Justificativas:
                                                </td>
                                            </tr>
                                            <?php foreach ($option->justification_list as $justification): ?>
                                                <tr>
                                                    <td colspan="2" class="plus">
                                                        <?= esc($justification['justification']) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        
    </div>
     
</div>