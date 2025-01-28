{!! Form::open(['route' => ['animales.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

<div class="form-group mb-3">
    {{ Form::label('nombre', 'Nombre del animal', ['class' => 'form-label']) }}
    {{ Form::text('nombre', old('nombre', $animale->nombre ?? ''), [
        'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
        'placeholder' => 'Ingrese el nombre del animal'
    ]) }}
    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('id_especie', 'Especie', ['class' => 'form-label']) }}
    {{ Form::select('id_especie', $especies, old('id_especie', $animale->id_especie ?? null), [
        'class' => 'form-control' . ($errors->has('id_especie') ? ' is-invalid' : ''),
        'placeholder' => 'Seleccione una especie'
    ]) }}
    {!! $errors->first('id_especie', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('sexo', 'Sexo', ['class' => 'form-label']) }}
    {{ Form::select('sexo', ['Macho' => 'Macho', 'Hembra' => 'Hembra'], old('sexo', $animale->sexo ?? ''), [
        'class' => 'form-control' . ($errors->has('sexo') ? ' is-invalid' : ''),
        'placeholder' => 'Seleccione el sexo del animal'
    ]) }}
    {!! $errors->first('sexo', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('fecha_nacimiento', 'Fecha de nacimiento', ['class' => 'form-label']) }}
    {{ Form::date('fecha_nacimiento', old('fecha_nacimiento', $animale->fecha_nacimiento ?? ''), [
        'class' => 'form-control' . ($errors->has('fecha_nacimiento') ? ' is-invalid' : ''),
        'max' => now()->format('Y-m-d')
    ]) }}
    {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('esterilizado', 'Esterilizado', ['class' => 'form-label']) }}
    {{ Form::select('esterilizado', [1 => 'Sí', 0 => 'No'], old('esterilizado', $animale->esterilizado ?? 0), [
        'class' => 'form-control' . ($errors->has('esterilizado') ? ' is-invalid' : ''),
        'placeholder' => 'Seleccione una opción'
    ]) }}
    {!! $errors->first('esterilizado', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('fecha_ingreso', 'Fecha de ingreso', ['class' => 'form-label']) }}
    {{ Form::date('fecha_ingreso', old('fecha_ingreso', $animale->fecha_ingreso ?? ''), [
        'class' => 'form-control' . ($errors->has('fecha_ingreso') ? ' is-invalid' : ''),
        'min' => '2020-01-01',
        'max' => now()->format('Y-m-d')
    ]) }}
    {!! $errors->first('fecha_ingreso', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('estado', 'Estado', ['class' => 'form-label']) }}
    {{ Form::select('estado', ['Disponible' => 'Disponible', 'No disponible' => 'No disponible'], old('estado', $animale->estado ?? 'Disponible'), [
        'class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''),
        'placeholder' => 'Seleccione el estado del animal'
    ]) }}
    {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    {{ Form::label('foto', 'Foto del animal', ['class' => 'form-label']) }}
    {{ Form::file('foto', [
        'class' => 'form-control' . ($errors->has('foto') ? ' is-invalid' : ''),
        'accept' => 'image/*'
    ]) }}
    {!! $errors->first('foto', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-footer text-end d-flex">
    <a href="{{ route('animales.index') }}" class="btn btn-danger">Cancelar</a>
    {{ Form::submit('Enviar', ['class' => 'btn btn-primary ms-auto']) }}
</div>

{!! Form::close() !!}
