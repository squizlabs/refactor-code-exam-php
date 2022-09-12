<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

logMsg(
    sprintf('Got request %s', json_encode($request)),
    'request'
);

try {
    if (preg_match('/contents/', $path) !== 0) {
        if ($request->query->get('term') !== null) {
            $term = $request->query->get('term');
        }

        header('Content-Type: application/json; charset=utf-8');
        $response = new JsonResponse(['data' => (new \Squiz\PhpCodeExam\Searcher())->execute($term, $type = 'content')], Response::HTTP_OK);
        logMsg(
            sprintf('Sent response %s', $response->getContent()),
            'response'
        );
        $response->send();
        exit(0);
    }

    if (preg_match('/tags/', $path) !== 0) {

        if ($request->query->get('term') != null) {
            $term = $request->query->get('term');
        }

        header('Content-Type: application/json; charset=utf-8');
        $response = new JsonResponse(['data' => (new \Squiz\PhpCodeExam\Searcher())->execute($term, 'tags')], Response::HTTP_OK);
        $response->send();
        logMsg(
            sprintf('Sent response %s', $response->getContent()),
            'response'
        );
        exit(0);
    }

    if (preg_match('/pages/', $path) !== 0) {

        $paths = explode('/', $path);
        $id = $paths[2];

        header('Content-Type: application/json; charset=utf-8');
        $response = new JsonResponse(['data' => (new \Squiz\PhpCodeExam\Searcher())->getPageById($id)], Response::HTTP_PARTIAL_CONTENT);
        $response->send();
        die();
    }

    $searcher = new \Squiz\PhpCodeExam\Searcher();
    $data = $searcher->allData;

    $null = NULL;
    $response = empty($data) ? new Response($null, Response::HTTP_NO_CONTENT) : new JsonResponse($data, Response::HTTP_ACCEPTED);
    error_log(
        sprintf('Sent response %s', $response->getContent()),
        0,
        __DIR__ . '/logs/response.log'
    );
    $response->send();

} catch (Exception $ex) {
    new JsonResponse(['exception' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
    logMsg(
        sprintf('%s: %s', $ex->getCode(), $ex->getMessage())
    );
}


$response = new JsonResponse(['error' => 'Failed to get pages'], Response::HTTP_INTERNAL_SERVER_ERROR);
$response->send();
logMsg(
    sprintf('Failed to get pages'),
    'failure'
);

function logMsg($message, $type = 'error')
{
    $logger = new \Squiz\PhpCodeExam\Logger();

    switch ($type) {
        case 'error':
            $file = __DIR__ . '/logs/error.log';
        case 'request':
            $file = __DIR__ . '/logs/request.log';
        case 'response':
            $file = __DIR__ . '/logs/response.log';
        default:
            $file = __DIR__ . '/logs/log.log';
    }
    $logger->log($message, $file);
}
