<!-- Form Input -->
<div class="form-group">
  <label for="message">Escriba un mensaje:</label>
  <input  maxlength="191"
  type="text" name="message" class="form-control"
  value="{{ isset($messaje->message) ? $messaje->message : '' }}" required>
</div>
<!-- Buttons -->
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
  <a class="btn btn-danger" href="{{ URL::to('message/') }}">Cancelar</a>
</div>