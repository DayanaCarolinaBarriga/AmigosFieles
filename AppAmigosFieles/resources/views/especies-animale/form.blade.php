
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('especie') }}</label>
    <div>
        {{ Form::text('especie', $especiesAnimale->especie, ['class' => 'form-control' .
        ($errors->has('especie') ? ' is-invalid' : ''), 'placeholder' => 'Especie']) }}
        {!! $errors->first('especie', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Escriba el <b>nombre </b> de la especie de animal.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
            </div>
        </div>
    </div>
