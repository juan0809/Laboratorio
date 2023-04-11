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
        <input type="hidden" name="idlaboratorio" id="idlaboratorio" value="">
          <div class="form-group">
            <label for="control-label">Titulo del Laboratorio:</label>
            <input type="text" class="form-control" name="titulo" id="titulo">
          </div>

          <div class="form-group">
            <label for="control-label">Descripcion :</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion">
          </div>
         
          <div class="form-group">
            <label for="control-label">Codigo:</label>
            <input type="text" class="form-control" name="codigo" id="codigo">
          </div>

          <div class="form-group">
                <label for="listEstado">Seleccione la Materia</label>
                <select class="form-control" name="listMateria" id="listMateria">
                    <!-- CONTENIDO AJAX -->
                </select>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" id="action" type="submit">Guardar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>