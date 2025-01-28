@if(isset($user))
    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
@else
    {{ Form::open(['route' => 'users.store', 'method' => 'POST']) }}
@endif

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('name', 'Nombre') }}</label>
    <div>
        {{ Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para el <b>nombre</b> del usuario.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('email', 'Email') }}</label>
    <div>
        {{ Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucciones para el <b>email</b> del usuario.</small>
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
