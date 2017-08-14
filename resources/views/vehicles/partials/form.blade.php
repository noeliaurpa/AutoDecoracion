<!-- Form Input -->
<div>
  <label for="nameClient">Nombre del cliente:</label>
  @if(count($clieen) == 0)
  <select id="client_id" class="form-control" name="client_id" required autofocus>
    <option value="">Necesita crear un cliente para poder crear un vehículo</option>
  </select>
  @else
  <select id="client_id" class="form-control" name="client_id" required autofocus>  
    @foreach($clieen as $key)
    <option value="{{ $key->id }}">{{$key->name}} {{$key->tell}}</option>
    @endforeach  
  </select>
  @endif
</div>
<div class="form-group">
  <label for="license_plate_or_detail">Placa o Detalle:</label>
  <input maxlength ="7" placeholder="Ejemplo: ABC000 o 123456"
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
      <div class="form-group">
        <label for="model">Modelo:</label>
        <input maxlength="50" placeholder="Ejemplo: Vitara"
        type="text" name="model" class="form-control" 
        value="{{ isset($vehiclee->model) ? $vehiclee->model : '' }}">
      </div>
      <div class="form-group">
        <label for="observation">Observación:</label>
        <input maxlength="150" placeholder="Ejemplo: Color celeste, SI NO AGREGA ESTE CAMPO NO HAY PROBLEMA"
        type="text" name="observation" class="form-control" 
        value="{{ isset($vehiclee->observation) ? $vehiclee->observation : '' }}">
      </div>

      <!-- Buttons -->
      <div class="form-group">
        @if(count($clieen) == 0)
        <button type="submit" class="btn btn-primary" disabled>{{ $submitButtonText }}</button>
        @else
        <button onclick="disabled = true;this.form.submit()" type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
        @endif
        <a class="btn btn-primary" href="{{ URL::to('vehicles/') }}">Cancelar</a>
      </div>