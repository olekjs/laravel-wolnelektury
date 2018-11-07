<?php

namespace Olekjs\Wolnelektury\Classes;

use Illuminate\Support\Str;

class Manage
{

    /**
     * Base URL.
     *
     * @var string $url
     */
    private $url = 'https://wolnelektury.pl/api';

    /**
     * Get book by name.
     *
     * @param string $name
     * @return object
     */
    public function getBook($name)
    {
        $name = str_replace(' ', '-', $name);
        $name = Str::lower($name);

        $url = "/books/{$name}";

        return $this->getHttpResponse($url);
    }

    /**
     *  Get Http response.
     *
     * @param  string $url
     * @return array|object
     */
    private function getHttpResponse($url)
    {
        $url     = $this->mergeURL($url);
        $headers = get_headers($url);
        $code    = substr($headers[9], 9, 3);

        if ($code != '200') {
            $data = [
                'code'    => $code,
                'message' => "Problem with API. Code {$code}",
            ];

            return $data;
        }

        $response = json_decode(file_get_contents($url), true);

        return $this->prepareResponse(collect($response));
    }

    /**
     *  Prepare response.
     *
     * @param collection $response
     * @return array
     */
    private function prepareResponse($response)
    {
        $data = [
            'title'       => $response->get('title'),
            'photo'       => $response->get('cover'),
            'author'      => $response->get('authors')[0]['name'],
            'category'    => $response->get('kinds')[0]['name'],
            'genres'      => $response->get('genres')[0]['name'],
            'epochs'      => $response->get('epochs')[0]['name'],
            'link_to_txt' => $response->get('txt'),
            'children'    => $response->get('children'),
            'parent'      => $response->get('parent'),

        ];

        return $data;
    }

    /**
     *  Merge base URL.
     *
     * @param  string $url
     * @return string
     */
    private function mergeURL($url)
    {
        return $this->url . $url;
    }
}
