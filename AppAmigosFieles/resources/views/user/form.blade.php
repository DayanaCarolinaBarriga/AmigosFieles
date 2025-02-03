@if(isset($user) && $user->exists)
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH']) !!}
@else
    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
@endif

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('name', 'Nombre') }}</label>
    <div>
        {{ Form::text('name', isset($user) && $user->exists ? $user->name : null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para el <b>nombre</b> del usuario.</small>
    </div>
</div>


<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('email', 'Email') }}</label>
    <div>
        {{ Form::email('email', isset($user) && $user->exists ? $user->email : null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para el <b>email</b> del usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('password', 'Password') }}</label>
    <div>
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingrese la <b>contraseña</b> del usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('roles', 'Rol del Usuario') }}</label>
    <div>
        {{ Form::select('roles[]', $roles, null, [
            'class' => 'form-control' . ($errors->has('roles') ? ' is-invalid' : ''),
            'placeholder' => 'Seleccione un rol'
        ]) }}
        {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione el <b>rol</b> para el usuario</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>

{{ Form::close() }}
