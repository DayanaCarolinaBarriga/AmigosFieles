{!! Form::open(['route' => isset($adopcione) ? ['adopciones.update', $adopcione->id] : 'adopciones.store', 'method' => isset($adopcione) ? 'PATCH' : 'POST', 'files' => true]) !!}
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('id_animal', 'Animal') }}</label>
    <div>
        {{ Form::select('id_animal', $animales->pluck('nombre', 'id')->toArray(), isset($adopcione) ? $adopcione->id_animal : null, ['class' => 'form-control' . ($errors->has('id_animal') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Animal']) }}
        {!! $errors->first('id_animal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccionar el animal para la adopción.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('id_adoptante', 'Adoptante') }}</label>
    <div>
        {{ Form::select('id_adoptante', $adoptantes->pluck('nombre', 'id')->toArray(), isset($adopcione) ? $adopcione->id_adoptante : null, ['class' => 'form-control' . ($errors->has('id_adoptante') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Adoptante']) }}
        {!! $errors->first('id_adoptante', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccionar el adoptante para la adopción.</small>
    </div>
</div>

<!-- Contenedor para las alertas -->
<div id="alertas-container"></div>

<!-- Estado del proceso de adopción -->
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('estado_proceso', 'Estado del Proceso') }}</label>
    <div>
        {{ Form::select('estado_proceso', ['pendiente' => 'Pendiente', 'aprobado' => 'Aprobado', 'rechazado' => 'Rechazado'], isset($adopcione) ? $adopcione->estado_proceso : null, ['class' => 'form-control' . ($errors->has('estado_proceso') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar Estado']) }}
        {!! $errors->first('estado_proceso', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccionar el estado del proceso de adopción.</small>
    </div>
</div>

<!-- Fecha de adopción (solo visible cuando el estado es 'aprobado') -->
<div class="form-group mb-3" id="fecha_adopcion_group" style="display: {{ isset($adopcione) && $adopcione->estado_proceso == 'aprobado' ? 'block' : 'none' }};">
    <label class="form-label">{{ Form::label('fecha_adopcion', 'Fecha de Adopción') }}</label>
    <div>
        {{ Form::date('fecha_adopcion', isset($adopcione) ? $adopcione->fecha_adopcion : null, ['class' => 'form-control' . ($errors->has('fecha_adopcion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Adopción']) }}
        {!! $errors->first('fecha_adopcion', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Introduzca la fecha de adopción.</small>
    </div>
</div>

<!-- Cédula (solo visible cuando el estado es 'aprobado') -->
<div class="form-group mb-3" id="cedula_group" style="display: {{ isset($adopcione) && $adopcione->estado_proceso == 'aprobado' ? 'block' : 'none' }};">
    <label class="form-label">{{ Form::label('cedula', 'Cédula (PDF)') }}</label>
    <div>
        {{ Form::file('cedula', ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : '')]) }}
        {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione el archivo PDF de la cédula.</small>
    </div>
</div>

<!-- Formulario (solo visible cuando el estado es 'aprobado') -->
<div class="form-group mb-3" id="formulario_group" style="display: {{ isset($adopcione) && $adopcione->estado_proceso == 'aprobado' ? 'block' : 'none' }};">
    <label class="form-label">{{ Form::label('formulario', 'Formulario (PDF)') }}</label>
    <div>
        {{ Form::file('formulario', ['class' => 'form-control' . ($errors->has('formulario') ? ' is-invalid' : '')]) }}
        {!! $errors->first('formulario', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione el archivo PDF del formulario de adopción.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('visita_previa', '¿Visita Previa?') }}</label>
    <div>
        {{ Form::select('visita_previa', [1 => 'Sí', 0 => 'No'], isset($adopcione) ? $adopcione->visita_previa : null, ['class' => 'form-control' . ($errors->has('visita_previa') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar']) }}
        {!! $errors->first('visita_previa', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccionar si se realizó una visita previa.</small>
    </div>
</div>

<!-- Comentario de visita -->
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('comentario_visita', 'Comentario de Visita') }}</label>
    <div>
        {{ Form::textarea('comentario_visita', isset($adopcione) ? $adopcione->comentario_visita : null, ['class' => 'form-control' . ($errors->has('comentario_visita') ? ' is-invalid' : ''), 'placeholder' => 'Comentario sobre la visita previa']) }}
        {!! $errors->first('comentario_visita', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingrese cualquier comentario sobre la visita previa.</small>
    </div>
</div>

<!-- Fecha de visita -->
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha_visita', 'Fecha de Visita') }}</label>
    <div>
        {{ Form::date('fecha_visita', isset($adopcione) ? $adopcione->fecha_visita : null, ['class' => 'form-control' . ($errors->has('fecha_visita') ? ' is-invalid' : '')]) }}
        {!! $errors->first('fecha_visita', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione la fecha de la visita.</small>
    </div>
</div>

<!-- Alerta de vivienda arrendada o sin cerramiento -->
@if(isset($alerta) && $alerta)
    <div class="alert alert-warning">{{ $alerta }}</div>
@endif

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('adopciones.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    // Mostrar u ocultar campos dependiendo del estado del proceso
    document.addEventListener('DOMContentLoaded', function() {
        const estadoProceso = document.querySelector('select[name="estado_proceso"]');
        const fechaAdopcionGroup = document.getElementById('fecha_adopcion_group');
        const cedulaGroup = document.getElementById('cedula_group');
        const formularioGroup = document.getElementById('formulario_group');

        function toggleFields() {
            if (estadoProceso.value === 'aprobado') {
                fechaAdopcionGroup.style.display = 'block';
                cedulaGroup.style.display = 'block';
                formularioGroup.style.display = 'block';
            } else {
                fechaAdopcionGroup.style.display = 'none';
                cedulaGroup.style.display = 'none';
                formularioGroup.style.display = 'none';
            }
        }

        estadoProceso.addEventListener('change', toggleFields);

        // Llamar a la función al cargar la página
        toggleFields();
        
        const adoptanteSelect = document.querySelector('select[name="id_adoptante"]');
        adoptanteSelect.addEventListener('change', function () {
            const adoptanteId = this.value;
            if (adoptanteId) {
                fetch(`/adoptantes/${adoptanteId}/alertas`)
                    .then(response => response.json())
                    .then(data => {
                        const alertasContainer = document.getElementById('alertas-container');
                        alertasContainer.innerHTML = '';
                        data.alertas.forEach(alerta => {
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-warning';
                            alertDiv.textContent = alerta;
                            alertasContainer.appendChild(alertDiv);
                        });
                    });
            }
        });

        // Trigger change event on page load if an adoptante is already selected
        if (adoptanteSelect.value) {
            adoptanteSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
