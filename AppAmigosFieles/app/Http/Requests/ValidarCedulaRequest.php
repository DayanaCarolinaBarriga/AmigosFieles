<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Adoptante;

class ValidarCedulaRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Se puede agregar autorización si es necesario
    }

    public function rules()
    {
        return [
            'cedula' => [
                'required',
                'string',
                'min:10',
                'max:10',
                'regex:/^[0-9]+$/',
                function ($attribute, $value, $fail) {
                    // Validación completa de la cédula
                    if (!$this->validarCedula($value)) {
                        $fail('La cédula ingresada no es válida.');
                    }
                },
            ],
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string|max:255',
            'correo' => 'nullable|email|max:255',
            'estado' => 'nullable|string|in:activo,inactivo', // Si el campo estado es opcional
        ];
    }

    public function messages()
    {
        return [
            'cedula.required' => 'La cédula es obligatoria.',
            'cedula.string' => 'La cédula debe ser un texto.',
            'cedula.min' => 'La cédula debe tener exactamente 10 caracteres.',
            'cedula.max' => 'La cédula no debe tener más de 10 caracteres.',
            'cedula.regex' => 'La cédula solo puede contener números.',
            'cedula.unique' => 'La cédula ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',
            'correo.email' => 'El correo electrónico debe ser una dirección válida.',
            'estado.in' => 'El estado debe ser "activo" o "inactivo".',
        ];
    }

    /**
     * Función para validar la cédula.
     *
     * @param string $cedula
     * @return bool
     */
    public function validarCedula($cedula): bool
    {
        // Verificar longitud
        if (strlen($cedula) !== 10) {
            return false;
        }

        // Obtener los primeros dos dígitos (provincia)
        $provincia = substr($cedula, 0, 2);
        if ($provincia < 1 || $provincia > 24) {
            return false;
        }

        // Verificar el tercer dígito
        $tercerDigito = substr($cedula, 2, 1);
        if ($tercerDigito < 0 || $tercerDigito > 5) {
            return false;
        }

        // Validación del dígito verificador
        $suma = 0;
        for ($i = 0; $i < 9; $i++) {
            $num = (int) substr($cedula, $i, 1);
            if ($i % 2 === 0) {
                $num *= 2; // Multiplicamos los números en posiciones impares por 2
                if ($num > 9) {
                    $num -= 9; // Si el resultado de la multiplicación es mayor a 9, restamos 9
                }
            }
            $suma += $num;
        }

        // Verificar el dígito verificador
        $modulo = $suma % 10;
        $decenaSuperior = $modulo === 0 ? 0 : 10 - $modulo;

        return (int) substr($cedula, 9, 1) === $decenaSuperior;
    }
}
