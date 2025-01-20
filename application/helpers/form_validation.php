<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('set_validation_rules')) {
    function set_validation_rules($CI, $rules) {
        $CI->load->library('form_validation');
        foreach ($rules as $field => $rule) {
            $CI->form_validation->set_rules($field, $rule['label'], $rule['rules'], $rule['errors']);
        }
    }
}
