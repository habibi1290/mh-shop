<?php
namespace Mh\Shop\Utility;



abstract class View {

    /**
     * @param mixed $path
     * @param array<mixed> $data
     * @return void
     */
    public static function render($path, array $data = []): void {
        ob_start();
        extract($data);
        require __DIR__ . '/../View/' . $path . '.view.php';
        $content = ob_get_contents();
        ob_end_clean();
        require __DIR__ . '/../View/Layout/main.view.php';
    }

    public static function error404(): void {
        http_response_code(404);
        self::render('404');
    }
}




