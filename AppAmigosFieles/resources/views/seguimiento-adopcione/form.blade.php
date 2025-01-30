<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('adopcion_id', 'Adopciones Aprobadas') }}</label>
    <div>
        {{ Form::select('adopcion_id', $adopciones->mapWithKeys(function ($adopcion) {
            return [$adopcion->id => $adopcion->adoptante->nombre . ' - ' . $adopcion->animale->nombre . ' - ' . $adopcion->fecha_adopcion];
        })->toArray(), isset($seguimientoAdopcione) ? $seguimientoAdopcione->adopcion_id : null, ['class' => 'form-control' . ($errors->has('adopcion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Adopción Aprobada']) }}
        {!! $errors->first('adopcion_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('seguimiento', 'Seguimiento') }}</label>
    <div>
        {{ Form::select('seguimiento', [1 => 'Sí', 0 => 'No'], isset($seguimientoAdopcione) ? $seguimientoAdopcione->seguimiento : null, ['class' => 'form-control' . ($errors->has('seguimiento') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar']) }}
        {!! $errors->first('seguimiento', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('comentario_seguimiento', 'Comentario de Seguimiento') }}</label>
    <div>
        {{ Form::textarea('comentario_seguimiento', isset($seguimientoAdopcione) ? $seguimientoAdopcione->comentario_seguimiento : null, ['class' => 'form-control' . ($errors->has('comentario_seguimiento') ? ' is-invalid' : ''), 'placeholder' => 'Comentario de Seguimiento']) }}
        {!! $errors->first('comentario_seguimiento', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('apto', '¿Es Apto?') }}</label>
    <div>
        {{ Form::select('apto', [1 => 'Sí', 0 => 'No'], isset($seguimientoAdopcione) ? $seguimientoAdopcione->apto : null, ['class' => 'form-control' . ($errors->has('apto') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar']) }}
        {!! $errors->first('apto', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('retiro_adopcion', '¿Retiro de Adopción?') }}</label>
    <div>
        {{ Form::select('retiro_adopcion', [1 => 'Sí', 0 => 'No'], isset($seguimientoAdopcione) ? $seguimientoAdopcione->retiro_adopcion : null, ['class' => 'form-control' . ($errors->has('retiro_adopcion') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar']) }}
        {!! $errors->first('retiro_adopcion', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

@if(isset($seguimientoAdopcione) && $seguimientoAdopcione->retiro_adopcion == 0)
    <div class="form-group mb-3">
        <a href="{{ route('visitasseguimiento.create', ['seguimiento_id' => $seguimientoAdopcione->id]) }}" class="btn btn-success">Crear Visita</a>
    </div>
@endif
   


<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('seguimientoadopcione.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
        </div>
    </div>
</div>
