<?php

abstract class MyEnum3 {

    final public function __construct($value = null) {
        $c = new ReflectionClass($this);
        if (!in_array($value, $c->getConstants())) {
            throw IllegalArgumentException();
        }
        $this->value = $value;
    }

    final public function buscar($value = null) {
        $text = $this->getTextoEnum($value);
        $this->texto = $text;
    }

    final public function __toString() {
        return $this->value;
    }

    function getTextoEnum($value = null) {
        return "algo";
    }

}

class enum_ecg extends MyEnum3 {

    const
            __default = 0,
            cmodalidad = 1,
            licenciatura = 2,
            cmodulo = 3,
            carea = 4,
            cmateria = 5,
            ccurso = 6,
            cinstitucion_avala = 7,
            ctipo_actividad_docente = 8,
            crol_desempenia = 9,
            ctipo_comprobante = 10,
            ctipo_licenciatura =11,
            ctipo_curso = 12,
            ctipo_especialidad = 13,
            ctipo_formacion_profesional = 14,
            ctipo_participacion = 15,
            ctipo_material = 16,
            cestado_civil = 17,
            cejercicio_predominante = 18,
            cejercicio_profesional = 19

    ;
    /*
      guardar actuación (evaluaciones)
      corregir

     */

    function getTextoEnum($value = null) {
        switch ($value) {
            case 'CLUBS':
                return 'Genial de clubes';
                break;
        }
    }

}
