
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('especie') }}</label>
    <div>
        {{ Form::text('especie', $especiesAnimale->especie, ['class' => 'form-control' .
        ($errors->has('especie') ? ' is-invalid' : ''), 'placeholder' => 'Especie']) }}
        {!! $errors->first('especie', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">especiesAnimale <b>especie</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
