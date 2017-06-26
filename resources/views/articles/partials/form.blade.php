<!-- Form Input -->
<div class="form-group">
  <label for="name">Nombre:</label>
  <input 
  type="text" name="name" class="form-control"
  value="{{ isset($articlee->name) ? $articlee->name : '' }}" required>
</div>
<div class="form-group">
  <label for="code">Codigo:</label>
  <input 
  type="text" name="code" class="form-control"
  value="{{ isset($articlee->code) ? $articlee->code : '' }}" required>
</div>
<div class="form-group">
  <label for="sale_price">Precio de venta:</label>
  <input 
  type="number" name="sale_price" class="form-control"
  value="{{ isset($articlee->sale_price) ? $articlee->sale_price : '' }}" required>
</div>
<div class="form-group">
  <label for="purchase_price">Precio de compra:</label>
  <input 
  type="number" name="purchase_price" class="form-control"
  value="{{ isset($articlee->purchase_price) ? $articlee->purchase_price : '' }}" required>
</div>
<div class="form-group">
  <label for="unit_or_quantity">Unidad o cantidad:</label>
  <input 
  type="number" name="unit_or_quantity" class="form-control"
  value="{{ isset($articlee->unit_or_quantity) ? $articlee->unit_or_quantity : '' }}" required>
</div>
<div class="form-group">          
  <input type = "radio" name = "radSize" id = "inventori" value = "inventario" required />
  <label for = "inventori">Inventario</label>
  <input type = "radio" name = "radSize" id = "smallBoxes" value = "Caja chica" required/>
  <label for = "smallBoxes">Caja chica</label>
</div>
<!-- Buttons -->
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('articles/') }}">Cancelar</a>
</div>