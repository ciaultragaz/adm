<div class="row">
    <?php
      $year  = date('Y');
        $C = new Calendar();
        for ($i=0; $i < 12 ; $i++) { 
            $C->month = $i+1;
            $C->year = $year;
            $month = $C->month();
            echo $month;
        }        
    ?>
    <div class="go-left"><a href="javascript:goNextYear();"><i class="feather icon-chevron-left"></i></a></div>
    <div class="go-right"><a href="javascript:goNextYear();"><i class="feather icon-chevron-right"></i></a></div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar horário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="date">
                    <input type="hidden" id="idPonto">
                    <input type="hidden" id="nomePonto">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Hora:</label>
                        <input type="text" class="form-control time" id="recipient-name">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">fechar</button>
                <button type="button" class="btn  btn-primary" id="btnAddHour">Adicionar</button>
            </div>
        </div>
    </div>
</div>