<!-- Form Input -->
<div class="form-group">
  <label for="name">Nombre:</label>
  <input maxlength="191"
  type="text" name="name" class="form-control"
  value="{{ isset($provideer->name) ? $provideer->name : '' }}" required>
</div>
<div class="form-group">
  <label for="number_provider">Número de teléfono:</label>
  <input maxlength= "8" max="99999999"
  type="number" name="number_provider" class="form-control" max= "8"
  value="{{ isset($provideer->number_provider) ? $provideer->number_provider : '' }}" required>
</div>
<div class="form-group">
  <label for="address_provider">Dirección:</label>
  <input maxlength="150"
  type="text" name="address_provider" class="form-control"
  value="{{ isset($provideer->address_provider) ? $provideer->address_provider : '' }}" required>
</div>
<div class="form-group">
  <label for="email">Correo Electrónico:</label>
  <input maxlength="150"
  type="email" name="email" class="form-control" 
  value="{{ isset($provideer->email) ? $provideer->email : '' }}">
</div>
<div class="form-group">
  <label for="fax_provider">Teléfono de Fax:</label>
  <input maxlength= "8" max="99999999"
  type="number" name="fax_provider" class="form-control"
  value="{{ isset($provideer->fax_provider) ? $provideer->fax_provider : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observación:</label>
  <input maxlength="150"
  type="text" name="observation" class="form-control"
  value="{{ isset($provideer->observation) ? $provideer->observation : '' }}">
</div>

<!-- Buttons -->
<div class="form-group">
  <button onclick="disabled = true;this.form.submit()" type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-danger" href="{{ URL::to('Providers/') }}">Cancelar</a>
</div>