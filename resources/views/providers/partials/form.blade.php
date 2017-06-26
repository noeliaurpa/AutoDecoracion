<!-- Form Input -->
<div class="form-group">
  <label for="name">Nombre:</label>
  <input
  type="text" name="name" class="form-control"
  value="{{ isset($provideer->name) ? $provideer->name : '' }}">
</div>
<div class="form-group">
  <label for="number_provider">Numero:</label>
  <input maxlength= "8" max="99999999"
  type="number" name="number_provider" class="form-control" max= "8"
  value="{{ isset($provideer->number_provider) ? $provideer->number_provider : '' }}">
</div>
<div class="form-group">
  <label for="address_provider">Direccion:</label>
  <input
  type="text" name="address_provider" class="form-control" maxlength= "100"
  value="{{ isset($provideer->address_provider) ? $provideer->address_provider : '' }}">
</div>
<div class="form-group">
  <label for="email">Correo:</label>
  <input 
  type="email" name="email" class="form-control" 
  value="{{ isset($provideer->email) ? $provideer->email : '' }}">
</div>
<div class="form-group">
  <label for="fax_provider">Telefono de Fax:</label>
  <input maxlength= "8" max="99999999"
  type="number" name="fax_provider" class="form-control"
  value="{{ isset($provideer->fax_provider) ? $provideer->fax_provider : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observacion:</label>
  <input
  type="text" name="observation" class="form-control" maxlength= "100" 
  value="{{ isset($provideer->observation) ? $provideer->observation : '' }}">
</div>

<!-- Buttons -->
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-danger" href="{{ URL::to('Providers/') }}">Cancelar</a>
</div>