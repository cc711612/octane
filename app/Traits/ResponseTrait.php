<?php
/**
 * @Author: Roy
 * @DateTime: 2022/7/31 上午 03:10
 */

namespace App\Traits;

use App\Support\Response;
use Illuminate\Http\Request;
use Throwable;

trait ResponseTrait
{
    public function __get($key)
    {
        $callable = [
            'response',
        ];

        if (in_array($key, $callable) && method_exists($this, $key)) {
            return $this->$key();
        }

        throw new \ErrorException('Undefined property '.get_class($this).'::'.$key);
    }

    /**
     * @return Response
     */
    protected function response()
    {
        return app(Response::class);
    }

    /**
     * Custom Normal Exception response.
     *
     * @param $request
     * @param  Throwable  $e
     */
    protected function prepareJsonResponse($request, Throwable $e)
    {
        // 要求请求头 header 中包含 /json 或 +json，如：Accept:application/json
        // 或者是 ajax 请求，header 中包含 X-Requested-With：XMLHttpRequest;
        $this->response->fail(
            '',
            $this->isHttpException($e) ? $e->getStatusCode() : 500,
            $this->convertExceptionToArray($e),
            $this->isHttpException($e) ? $e->getHeaders() : [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * Custom Failed Validation Response.
     *
     * @param Request $request
     * @param array   $errors
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (isset(static::$responseBuilder)) {
            return call_user_func(static::$responseBuilder, $request, $errors);
        }

        $this->response->fail('Validation error', 422, $errors);
    }
}
