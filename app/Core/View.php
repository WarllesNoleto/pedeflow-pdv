<?php
namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        require __DIR__ . '/../Views/layouts/header.php';
        require $viewFile;
        require __DIR__ . '/../Views/layouts/footer.php';
    }
}
