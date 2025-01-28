<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('id_users', 'Usuario') }}</label>
    <div>
        {{ Form::hidden('id_users', Auth::user()->id) }}
        {{ Form::text('user_name', Auth::user()->name, ['class' => 'form-control', 'readonly' => 'readonly']) }}
        <small class="form-hint">Este es el usuario actualmente autenticado.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('id_tipo_gasto', 'Categoría') }}</label>
    <div>
        {{ Form::select('id_tipo_gasto', $categorias, old('id_tipo_gasto', $gasto->id_tipo_gasto ?? null), [
            'class' => 'form-control' . ($errors->has('id_tipo_gasto') ? ' is-invalid' : ''), 
            'placeholder' => 'Selecciona una categoría'
        ]) }}
        {!! $errors->first('id_tipo_gasto', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Selecciona la categoría del gasto.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('descripcion', 'Descripción') }}</label>
    <div>
        {{ Form::text('descripcion', old('descripcion', $gasto->descripcion ?? ''), [
            'class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 
            'placeholder' => 'Descripción del gasto'
        ]) }}
        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Escribe una breve descripción del gasto.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('monto', 'Monto') }}</label>
    <div>
        {{ Form::number('monto', old('monto', $gasto->monto ?? ''), [
            'class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 
            'placeholder' => 'Monto', 
            'min' => '0', 
            'step' => '0.01'
        ]) }}
        {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Introduce el monto en formato numérico positivo.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha', 'Fecha') }}</label>
    <div>
        {{ Form::date('fecha', old('fecha', $gasto->fecha ?? ''), [
            'class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : '')
        ]) }}
        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Selecciona la fecha del gasto.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('gastos.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>
