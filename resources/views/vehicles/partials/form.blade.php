<!-- Form Input -->
<div>
  <label for="nameClient">Nombre del cliente:</label>
  <select id="client_id" class="form-control" name="client_id" required autofocus>  
    @foreach($clieen as $key)
    <option value="{{ $key->id }}">{{$key->name}} {{$key->tell}}</option>
    @endforeach  
  </select>
</div>
<div class="form-group">
  <label for="license_plate_or_detail">Placa o Detalle:</label>
  <input maxlength ="7"
  type="text" name="license_plate_or_detail" class="form-control"
  value="{{ isset($vehiclee->license_plate_or_detail) ? $vehiclee->license_plate_or_detail : '' }}">
</div>
<div>
  <label for="nameClient">Marca:</label>
  <select class="form-control" name="brand" size="1" required autofocus>
    <optgroup label="Autos">
      @foreach($brands as $key)
      @if($key->brand == "Aeon")
      <optgroup label="Motos">
        @elseif($key->brand == "Ammann")
        <optgroup label="Camiones">
          @endif
          <option value="{{$key->brand}}">{{$key->brand}}</option>
          @endforeach  
        </select>
      </div>
<!-- <div class="form-group">
  <label for="brand">Marca:</label>
  <input maxlength="50"
  type="text" name="brand" class="form-control" 
  value="{{ isset($vehiclee->brand) ? $vehiclee->brand : '' }}">
</div> -->
<div class="form-group">
  <label for="model">Modelo:</label>
  <input maxlength="50"
  type="text" name="model" class="form-control" 
  value="{{ isset($vehiclee->model) ? $vehiclee->model : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observación:</label>
  <input maxlength="150"
  type="text" name="observation" class="form-control" 
  value="{{ isset($vehiclee->observation) ? $vehiclee->observation : '' }}">
</div>

<!-- Buttons -->
<div class="form-group">
  <button onclick="disabled = true;this.form.submit()" type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('vehicles/') }}">Cancelar</a>
</div>