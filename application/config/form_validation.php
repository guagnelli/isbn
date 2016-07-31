<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config = array(
    /*'form_registro_docente' => array(
        array(
            'field' => 'reg_matricula',
            'label' => 'Matrícula',
            'rules' => 'required|max_length[18]|alpha_dash'
        ),
        array(
            'field' => 'reg_delegacion',
            'label' => 'delegación',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'reg_correo',
            'label' => 'Correo electrónico',
            'rules' => 'trim|required|valida_correo_electronico' //|callback_valid_pass
        ),
        array(
            'field' => 'reg_contrasenia',
            'label' => 'Contraseña',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'reg_captcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|check_captcha'
        ),
    ),*/
    'inicio_sesion' => array(
        array(
            'field' => 'nick',
            'label' => 'Nombre de usuario',
            'rules' => 'required|max_length[20]|alpha_dash'
        ),
        array(
            'field' => 'passwd',
            'label' => 'Contraseña',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'userCaptcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|check_captcha'
        ),
    ),
    //**Fin de validación de actividad docenete********************************
);





// VALIDACIONES
/*
             * isset
             * valid_email
             * valid_url
             * min_length
             * max_length
             * exact_length
             * alpha
             * alpha_numeric
             * alpha_numeric_spaces
             * alpha_dash
             * numeric
             * is_numeric
             * integer
             * regex_match
             * matches
             * differs
             * is_unique
             * is_natural
             * is_natural_no_zero
             * decimal
             * less_than
             * less_than_equal_to
             * greater_than
             * greater_than_equal_to
             * in_list
             *
             */


//custom validation

/*

alpha_accent_space_dot_quot
 *
alpha_numeric_accent_slash
 *
alpha_numeric_accent_space_dot_parent
 *
alpha_numeric_accent_space_dot_double_quot

*/

/*
*password_strong
*
*
*
*
*/
