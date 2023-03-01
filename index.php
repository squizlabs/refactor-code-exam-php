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
        if ($request->query->get('term') == null) {
            $response = new JsonResponse(['data' => false], Response::HTTP_BAD_REQUEST);
        } else {
            $term = $request->query->get('term');
            $response = new JsonResponse(['data' => (new \Squiz\PhpCodeExam\Searcher())->execute($term, $type = 'content')], Response::HTTP_OK);
        }
    }
    else if (preg_match('/tags/', $path) !== 0) {
        if ($request->query->get('term') == null) {
            $response = new JsonResponse(['data' => false], Response::HTTP_BAD_REQUEST);
        } else {
            $term = $request->query->get('term');
            $response = new JsonResponse(['data' => (new \Squiz\PhpCodeExam\Searcher())->execute($term, 'tags')], Response::HTTP_OK);
        }
    } else if (preg_match('/pages/', $path) !== 0) {
        $paths = explode('/', $path);
        $id = $paths[2];
        if ($id == null) {
            $response = new JsonResponse(['data' => false], Response::HTTP_BAD_REQUEST);
        } else {
            $result = (new \Squiz\PhpCodeExam\Searcher())->getPageById($id);
            $response = new JsonResponse(['data' => $result], $result ? Response::HTTP_PARTIAL_CONTENT : Response::HTTP_NOT_FOUND);
        }
    } else {
        // print all
        $searcher = new \Squiz\PhpCodeExam\Searcher();
        $data = $searcher->allData;

        $null = NULL;
        $response = empty($data) ? new Response(NULL, Response::HTTP_NO_CONTENT) : new JsonResponse(['data' => $data], Response::HTTP_ACCEPTED);
    }

    $response->send();
    logMsg(
        sprintf('Sent response %s', $response->getContent()),
        'response'
    );
} catch (Exception $ex) {
    new JsonResponse(['exception' => $ex->getMessage()], Response::HTTP_BAD_REQUEST);
    logMsg(
        sprintf('%s: %s', $ex->getCode(), $ex->getMessage())
    );
}

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
