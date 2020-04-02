<?php
namespace App\Repositories;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\ServerException;

trait JsonTools
{
    protected function getJson($url, $headers = [])
    {
        $content = Cache::remember(Str::slug($url), 60 * 60, function () use ($url, $headers) {
            try {
                $client = new Client();
                $response = $client->request('GET', $url, $headers);
                return (
                    json_decode(
                        preg_replace(
                            '/ApoEtapeVDI\("(\w*)"\)(,?)/',
                            '',
                            $this->cleanup($response->getBody()->getContents())
                        )
                     )
                );
            } catch (ServerException $e) {
                return null;
            }
        });
        return $content;
    }



    private static function cleanup($str, $charset = 'UTF-8')
    {
        $str = str_replace("'", '"', $str);
        $str = utf8_decode($str);

        $str = str_replace("\\xc3\\xa9", 'é', $str);
        $str = html_entity_decode($str);
        return $str;
    }
}
