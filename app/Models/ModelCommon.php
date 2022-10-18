<?php


namespace App\Models;


class ModelCommon
{
    function fill(array $vars) {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            $this->$name = $vars[$name] ?? NULL;
        }
    }
}
