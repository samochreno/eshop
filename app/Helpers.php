<?php

function name()
{
    return 'Ruženka';
}

function format($errors)
{
    if (!$errors || !$errors->any()) {
        return '';
    }

    return substr($errors->first(), 0, -1);
}
