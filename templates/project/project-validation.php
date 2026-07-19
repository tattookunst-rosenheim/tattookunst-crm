<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_validate_project($data) {
    $errors = [];

    if (intval($data['customer_id']) <= 0) {
        $errors[] = 'Bitte wähle einen Kunden aus.';
    }

    if (trim($data['tattoo_wish']) === '') {
        $errors[] = 'Bitte gib die Motividee / den Tattoo-Wunsch ein.';
    }

    if (trim($data['project_type']) === '') {
        $errors[] = 'Bitte wähle eine Projektart aus.';
    }

    if ($data['project_type'] === 'eigene' && trim($data['project_type_custom']) === '') {
        $errors[] = 'Bitte gib die eigene Projektart ein.';
    }

    if (trim($data['project_size']) === '') {
        $errors[] = 'Bitte wähle eine Projektgröße aus.';
    }

    if (trim($data['style']) === '') {
        $errors[] = 'Bitte wähle einen Stil aus.';
    }

    if ($data['style'] === 'eigener_stil' && trim($data['style_custom']) === '') {
        $errors[] = 'Bitte gib den eigenen Stil ein.';
    }

    if (empty($data['body_parts']) && trim($data['body_parts_custom']) === '') {
        $errors[] = 'Bitte wähle mindestens eine Körperstelle aus.';
    }

    return $errors;
}