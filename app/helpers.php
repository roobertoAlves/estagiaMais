<?php

function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

function asset($path) {
    $base = BASE_URL;
    // Garantir que não há dupla barra
    return rtrim($base, '/') . '/public/' . ltrim($path, '/');
}

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function old($key, $default = '') {
    return $_SESSION['old'][$key] ?? $default;
}

function hasError($key) {
    return isset($_SESSION['errors'][$key]);
}

function error($key) {
    return $_SESSION['errors'][$key] ?? '';
}

function clearFlashData() {
    unset($_SESSION['old']);
    unset($_SESSION['errors']);
}
