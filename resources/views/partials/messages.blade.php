<!-- check for flash success message -->
<div class="row" id="flash_message">
    <div class="col-md-5 col-md-offset-1">
        @if (Session::has('flash_message'))
            <div class="alert {{
       session('flash_message_level')=='warning' ? 'alert-warning'
    : (session('flash_message_level')=='danger' ? 'alert-danger'
    : (session('flash_message_level')=='success'  ? 'alert-success'
    : 'alert-info'))
    }} {{ session('flash_message_important')==true ? 'alert-important' : '' }}">

                @if (session('flash_message_important')==true)
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <strong>!Importante!</strong><br><br>
                @endif
                {{ session('flash_message') }}
            </div>
        @endif
    </div>
</div>
