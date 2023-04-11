<div class="modal fade" id="modalLaboratorio" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Laboratorio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formLaboratorio" name="formLaboratorio">
        $(document).ready(function(){
    var maxField = 10; 
    var addButton = $('#add_button');
    var wrapper = $('#field_wrapper'); 
    var fieldHTML = '<div><input type="text" class="form-control mr-2 mb-2" name="field_name[]" placeholder="Correo"/><a href="javascript:void(0);" class="btn btn-danger" id="remove_button"><i class="fas fa-minus"></i></a></div>';
    var x = 1; 
    $(addButton).click(function(){ 
        if(x < maxField){ 
            x++; 
            $(wrapper).append(fieldHTML); 
        }
    });
    $(wrapper).on('click', '#remove_button', function(e){ 
        e.preventDefault();
        $(this).parent('div').remove(); 
        x--;
    });
});
        </form>
      </div>
    </div>
  </div>
</div>