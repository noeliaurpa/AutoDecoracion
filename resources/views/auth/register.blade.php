@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading-Login">Registrar</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tell') ? ' has-error' : '' }}">
                            <label for="tell" class="col-md-4 control-label">Telefono</label>

                            <div class="col-md-6">
                                <input id="tell" type="number" max="99999999" class="form-control" name="tell" value="{{ old('tell') }}" required autofocus>

                                @if ($errors->has('tell'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tell') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('workstation') ? ' has-error' : '' }}">
                            <label for="workstation" class="col-md-4 control-label">Puesto de trabajo</label>

                            <div class="col-md-6">
                                <!-- <input id="workstation" type="text" class="form-control" name="workstation" value="{{ old('workstation') }}" required autofocus> -->

                                <select id="workstation" class="form-control" name="workstation" required autofocus>    
                                   <option value="Administrador" selected="selected">Administrador</option>
                                   <option value="Usuario">Usuario</option>
                               </select>

                               @if ($errors->has('workstation'))
                               <span class="help-block">
                                <strong>{{ $errors->first('workstation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                        <label for="salary" class="col-md-4 control-label">Salario</label>

                        <div class="col-md-6">
                            <input id="salary" type="text" class="form-control" name="salary" value="{{ old('salary') }}" required autofocus>

                            @if ($errors->has('salary'))
                            <span class="help-block">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('observation') ? ' has-error' : '' }}">
                        <label for="observation" class="col-md-4 control-label">Observacion</label>

                        <div class="col-md-6">
                            <input id="observation" type="text" class="form-control" name="observation" value="{{ old('observation') }}">

                            @if ($errors->has('observation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('observation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Registrar
                            </button>
                            <a class="btn btn-primary" href="{{ URL::to('/users') }}">Ver Usuario</a>
                            <a class="btn btn-danger" href="{{ URL::to('/home') }}">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="navbar navbar-default" id="footerLogin">
</div>
@endsection
