<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', $adoptante->nombre ?? '', [
            'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
            'placeholder' => 'Nombre',
            'pattern' => '[A-Za-z\s]+',
            'required' => true
        ]) }}
        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingresa el nombre completo del adoptante. Solo se permiten letras y espacios.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('telefono') }}</label>
    <div>
        {{ Form::text('telefono', $adoptante->telefono ?? '', [
            'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
            'placeholder' => 'Telefono',
            'pattern' => '^[0-9]{10}$',
            'required' => true
        ]) }}
        {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingresa un número de teléfono válido de 10 dígitos.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('correo') }}</label>
    <div>
        {{ Form::email('correo', $adoptante->correo ?? '', [
            'class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''),
            'placeholder' => 'Correo',
            'required' => true
        ]) }}
        {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingresa un correo electrónico válido. Ejemplo: usuario@dominio.com</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('direccion') }}</label>
    <div>
        {{ Form::text('direccion', $adoptante->direccion ?? '', [
            'class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''),
            'placeholder' => 'Direccion',
            'required' => true
        ]) }}
        {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingresa la dirección completa del adoptante, incluyendo calle y número.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('cedula') }}</label>
    <div>
        {{ Form::text('cedula', $adoptante->cedula ?? '', [
            'class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''),
            'placeholder' => 'Cedula',
            'pattern' => '^[0-9]{10}$',
            'required' => true
        ]) }}
        {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingresa un número de cédula válido de 10 dígitos.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('edad') }}</label>
    <div>
        {{ Form::number('edad', $adoptante->edad ?? '', [
            'class' => 'form-control' . ($errors->has('edad') ? ' is-invalid' : ''),
            'placeholder' => 'Edad',
            'min' => 17,
            'max' => 70,
            'required' => true
        ]) }}
        {!! $errors->first('edad', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">La edad debe estar entre 17 y 70 años.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('ocupacion') }}</label>
    <div>
        {{ Form::text('ocupacion', $adoptante->ocupacion ?? '', [
            'class' => 'form-control' . ($errors->has('ocupacion') ? ' is-invalid' : ''),
            'placeholder' => 'Ocupacion',
            'pattern' => '[A-Za-z\s]+',
            'required' => true
        ]) }}
        {!! $errors->first('ocupacion', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingresa la ocupación del adoptante. Solo se permiten letras y espacios.</small>
    </div>
</div>


<!-- Campos de vivienda -->
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('tipo_vivienda') }}</label>
    <div>
        {{ Form::select('tipo_vivienda', [
            'casa' => 'Casa',
            'departamento' => 'Departamento'
        ], $adoptante->tipo_vivienda ?? '', [
            'class' => 'form-control' . ($errors->has('tipo_vivienda') ? ' is-invalid' : ''),
            'required' => true
        ]) }}
        {!! $errors->first('tipo_vivienda', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Selecciona el tipo de vivienda del adoptante.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('vivienda_arrendada', '¿La vivienda es arrendada?') }}</label>
    <div>
        {{ Form::select('vivienda_arrendada', [
            1 => 'Sí',
            0 => 'No'
        ], $adoptante->vivienda_arrendada ?? '', [
            'class' => 'form-control' . ($errors->has('vivienda_arrendada') ? ' is-invalid' : ''),
            'required' => true
        ]) }}
        {!! $errors->first('vivienda_arrendada', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Selecciona si la vivienda es arrendada.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('cerramiento', '¿Tiene cerramiento?') }}</label>
    <div>
        {{ Form::select('cerramiento', [
            1 => 'Sí',
            0 => 'No'
        ], $adoptante->cerramiento ?? '', [
            'class' => 'form-control' . ($errors->has('cerramiento') ? ' is-invalid' : ''),
            'required' => true
        ]) }}
        {!! $errors->first('cerramiento', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Selecciona si la vivienda tiene cerramiento.</small>
    </div>
</div>

<div class="form-group mb-3">
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('estado') }}</label>
    <div>
        {{ Form::select('estado', [
            'activo' => 'Activo',
            'inactivo' => 'Inactivo'
        ], $adoptante->estado ?? 'activo', [
            'class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''),
            'required' => true
        ]) }}
        {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Selecciona el estado del adoptante: Activo o Inactivo.</small>
    </div>
</div>

