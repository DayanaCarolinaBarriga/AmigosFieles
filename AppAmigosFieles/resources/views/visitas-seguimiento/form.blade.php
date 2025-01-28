

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('visita', 'Visita') }}</label>
    <div>
        {{ Form::select('visita', [1 => 'Sí', 0 => 'No'], $visitasSeguimiento->visita ?? null, ['class' => 'form-control' . ($errors->has('visita') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar']) }}
        {!! $errors->first('visita', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione si se realizó la visita.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha_visita', 'Fecha de Visita') }}</label>
    <div>
        {{ Form::date('fecha_visita', $visitasSeguimiento->fecha_visita ?? null, ['class' => 'form-control' . ($errors->has('fecha_visita') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Visita']) }}
        {!! $errors->first('fecha_visita', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione la fecha de la visita.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('comentario', 'Comentario') }}</label>
    <div>
        {{ Form::textarea('comentario', $visitasSeguimiento->comentario ?? null, ['class' => 'form-control' . ($errors->has('comentario') ? ' is-invalid' : ''), 'placeholder' => 'Comentario']) }}
        {!! $errors->first('comentario', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Escriba un comentario sobre la visita.</small>
    </div>
</div>


<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('visitasseguimiento.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Guardar</button>
        </div>
    </div>
</div>
