<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

return function ($event) {
    $method = $event['requestContext']['http']['method'];
    $path = $event['rawPath'];

    switch ($method) {
        case 'GET':
            return handleGET($event, $path);
        case 'POST':
            return handlePOST($event, $path);
        case 'PUT':
            return handlePUT($event, $path);
        case 'DELETE':
            return handleDELETE($event, $path);
        default:
            return json_encode(['message' => 'Unsupported method']);
    }
};

function handleGET($event, $path) {
    if ($path === '/hello') {
        return json_encode(['message' => 'GET Request: Hello ' . ($event['queryStringParameters']['name'] ?? 'world')]);
    }

    return json_encode(['message' => 'Invalid path']);
}

function handlePOST($event, $path) {
    if ($path === '/hello') {
        $postData = json_decode($event['body'], true);
        return json_encode(['message' => 'POST Request: Hello ' . ($postData['name'] ?? 'world')]);
    }

    return json_encode(['message' => 'Invalid path']);
}

function handlePUT($event, $path) {
    if ($path === '/hello') {
        $putData = json_decode($event['body'], true);
        return json_encode(['message' => 'PUT Request: Hello ' . ($putData['name'] ?? 'world')]);
    }

    return json_encode(['message' => 'Invalid path']);
}

function handleDELETE($event, $path) {
    if ($path === '/hello') {
        $putData = json_decode($event['body'], true);
        return json_encode(['message' => 'Delete Request: Hello ' . ($putData['name'] ?? 'world')]);
    }

    return json_encode(['message' => 'Invalid path']);
}
