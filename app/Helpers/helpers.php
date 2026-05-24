<?php

function app_base_path(): string
{
    static $base = null;
    if ($base !== null) return $base;

    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $base = rtrim(str_replace('/index.php', '', $script), '/');
    return $base ?: '';
}

function base_url(string $path = ''): string
{
    $path = '/' . ltrim($path, '/');
    return app_base_path() . ($path === '/' ? '' : $path);
}

function redirect(string $url): void
{
    if (!str_starts_with($url, '/')) {
        $url = '/' . $url;
    }
    header('Location: ' . base_url($url));
    exit;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function money_br(float|int|string|null $value): string
{
    return 'R$ ' . number_format((float) $value, 2, ',', '.');
}

function status_badge(string $status): string
{
    $map = [
        'pendente' => 'warning', 'aceito' => 'info', 'em_preparo' => 'primary',
        'pronto_retirada' => 'secondary', 'saiu_entrega' => 'dark',
        'finalizado' => 'success', 'cancelado' => 'danger',
    ];
    $label = str_replace('_', ' ', ucfirst($status));
    $badgeClass = $map[$status] ?? 'light text-dark';
    return "<span class=\"badge bg-{$badgeClass}\">{$label}</span>";
}

function flash(string $type, string $message): void { $_SESSION['flash'][$type] = $message; }
function auth_user(): ?array { return $_SESSION['user'] ?? null; }
function require_auth(): void { if (!auth_user()) { flash('error', 'Faça login para continuar.'); redirect('/login'); } }

function csrf_token(): string
{
    if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['_csrf'];
}
function csrf_field(): string { return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">'; }
function verify_csrf(): void
{
    if (($_POST['_csrf'] ?? '') !== ($_SESSION['_csrf'] ?? null)) {
        http_response_code(419); exit('CSRF token inválido');
    }
}
