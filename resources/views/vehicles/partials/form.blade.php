<!-- Form Input -->
<div>
  <label for="nameClient">Nombre del cliente:</label>
  <select id="client_id" class="form-control" name="client_id" required autofocus>  
  @foreach($clieen as $key)
    <option value="{{ $key->id }}">{{$key->name}}</option>
  @endforeach  
  </select>
</div>
<div class="form-group">
  <label for="license_plate_or_detail">Placa o Detalle:</label>
  <input
  type="text" name="license_plate_or_detail" class="form-control"
  value="{{ isset($vehiclee->license_plate_or_detail) ? $vehiclee->license_plate_or_detail : '' }}">
</div>
<div class="form-group">
  <label for="brand">Marca:</label>
  <input 
  type="text" name="brand" class="form-control" max= "8"
  value="{{ isset($vehiclee->brand) ? $vehiclee->brand : '' }}">
</div>
<div class="form-group">
  <label for="model">Modelo:</label>
  <input
  type="text" name="model" class="form-control" maxlength= "100" 
  value="{{ isset($vehiclee->model) ? $vehiclee->model : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observacion:</label>
  <input
  type="text" name="observation" class="form-control" maxlength= "100" 
  value="{{ isset($vehiclee->observation) ? $vehiclee->observation : '' }}">
</div>

<!-- Buttons -->
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('vehicles/') }}">Cancelar</a>
</div>