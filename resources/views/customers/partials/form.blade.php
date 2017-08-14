<!-- Form Input -->
<div class="form-group">
  <label for="name">Nombre:</label>
  <input maxlength="191" placeholder="Ejemplo: Luis Gonzáles"
  type="text" name="name" class="form-control"
  value="{{ isset($cliennt->name) ? $cliennt->name : '' }}">
</div>
<div class="form-group">
  <label for="tell">Teléfono:</label>
  <input maxlength= "8" max="99999999" placeholder="Ejemplo: 73456890"
  type="number" name="tell" class="form-control" max= "8"
  value="{{ isset($cliennt->tell) ? $cliennt->tell : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observación:</label>
  <input maxlength="191" placeholder="Ejemplo: Cliente frecuente, SI NO LLENA ESTE CAMPO NO HAY NINGUN PROBLEMA"
  type="text" name="observation" class="form-control" maxlength= "100" 
  value="{{ isset($cliennt->observation) ? $cliennt->observation : '' }}">
</div>

<!-- Buttons -->
<div class="form-group">
  <button onclick="disabled = true;this.form.submit()" type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('customers/') }}">Cancelar</a>
</div>