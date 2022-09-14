<?php


use Jenssegers\Blade\Blade;

if (! function_exists('view')) {
    /**
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        $blade = new Blade(
            dirname(__DIR__) . '/resources/views',
            dirname(__DIR__) . '/resources/cache'
        );

        return $blade->render($view, ['data' => $data]);
    }
}

if (! function_exists('old')) {

    function old($param, $data)
    {
        if (isset($data['olds'][$param])) {
            return $data['olds'][$param];
        }
        return null;
    }
}

if (! function_exists('paginationUrl')) {

    function paginationUrl($pagination, $page): string
    {
        $total = $pagination['total'];
        $page = min($page, $total);
        $url = explode('&page', $pagination['url'])[0];
        return $url . '&page=' . $page;
    }
}
