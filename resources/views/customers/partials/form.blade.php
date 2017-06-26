<!-- Form Input -->
<div>
  <label for="nameProvider">Nombre del proveedor:</label>
  <select id="provider_id" class="form-control" name="provider_id" autofocus>
  <option></option>  
  @foreach($proveer as $key)
    <option value="{{ $key->id }}">{{$key->name}}</option>
  @endforeach  
  </select>
</div>
<div class="form-group">
  <label for="name">Nombre:</label>
  <input
  type="text" name="name" class="form-control"
  value="{{ isset($cliennt->name) ? $cliennt->name : '' }}">
</div>
<div class="form-group">
  <label for="tell">Telefono:</label>
  <input maxlength= "8" max="99999999"
  type="number" name="tell" class="form-control" max= "8"
  value="{{ isset($cliennt->tell) ? $cliennt->tell : '' }}">
</div>
<div class="form-group">
  <label for="observation">Observacion:</label>
  <input
  type="text" name="observation" class="form-control" maxlength= "100" 
  value="{{ isset($cliennt->observation) ? $cliennt->observation : '' }}">
</div>

<!-- Buttons -->
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('customers/') }}">Cancelar</a>
</div>