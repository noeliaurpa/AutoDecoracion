<!-- Form Input -->
<div class="form-group">
  <label for="tell">Telefono:</label>
  <input 
  type="text" name="tell" class="form-control"
  value="{{ isset($users->tell) ? $users->tell : '' }}">
</div>
<div class="form-group">
  <label for="salary">Salario:</label>
  <input 
  type="number" name="salary" class="form-control"
  value="{{ isset($users->salary) ? $users->salary : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observación:</label>
  <input 
  type="number" name="observation" class="form-control"
  value="{{ isset($users->observation) ? $users->observation : '' }}">
</div>
<!-- Buttons -->
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('users/') }}">Cancelar</a>
</div>