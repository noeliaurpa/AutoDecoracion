<!-- Form Input -->
<div class="form-group">
  <label for="name">Nombre:</label>
  <input  maxlength="191" 
  type="text" name="name" class="form-control" title="Solo puede utilizar letras"
  value="{{ isset($articlee->name) ? $articlee->name : '' }}" required>
</div>
<div class="form-group">
  <label for="code">Código:</label>
  <input  maxlength = "8"
  type="text" name="code" class="form-control" pattern="[A-Za-z0-9]{2,8}" title="Solo puede utilizar letras y numeros"
  value="{{ isset($articlee->code) ? $articlee->code : '' }}" required>
</div>
<div class="form-group">
  <label for="sale_price">Precio de venta:</label>
  <input maxlength= "10" max="9999999999"
  type="number" name="sale_price" class="form-control" max="10"
  value="{{ isset($articlee->sale_price) ? $articlee->sale_price : '' }}" required>
</div>
<div class="form-group">
  <label for="purchase_price">Precio de compra:</label>
  <input maxlength= "10" max="9999999999"
  type="number" name="purchase_price" class="form-control" max="10"
  value="{{ isset($articlee->purchase_price) ? $articlee->purchase_price : '' }}" required>
</div>
<div class="form-group">
  <label for="unit_or_quantity">Unidad o cantidad:</label>
  <input maxlength="6" max="999999"
  type="number" name="unit_or_quantity" class="form-control" max="6"
  value="{{ isset($articlee->unit_or_quantity) ? $articlee->unit_or_quantity : '' }}" required>
</div>
<div class="form-group">          
  <input type = "radio" name = "radSize" id = "inventori" value = "inventario" checked="checked" required />
  <label for = "inventori">Inventario</label>
  <input type = "radio" name = "radSize" id = "smallBoxes" value = "Caja chica" required/>
  <label for = "smallBoxes">Caja chica</label>
</div>
<!-- Buttons -->
<div class="form-group">
  <button onclick="disabled = true;this.form.submit()" type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-primary" href="{{ URL::to('articles/') }}">Cancelar</a>
</div>