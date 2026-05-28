<?php

namespace MyProject\View;

class View
{
    /** @var string Путь к папке с шаблонами */
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    /**
     * Рендерит шаблон $templateName и отдаёт его клиенту.
     * Переменные из $vars становятся доступны в шаблоне напрямую.
     */
    public function renderHtml(string $templateName, array $vars = [], int $code = 200): void
    {
        http_response_code($code);

        extract($vars);

        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}
