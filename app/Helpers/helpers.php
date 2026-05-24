<?php

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'][$type] = $message;
}

function auth_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_auth(): void
{
    if (!auth_user()) {
        flash('error', 'Faça login para continuar.');
        redirect('/pedeflow-pdv/public/login');
    }
}
