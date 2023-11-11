<?php
// phpinfo();



// Обнновиться до 8.3 PHP для GraphQL

include_once 'vendor/autoload.php';

use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;

$books = json_decode(file_get_contents('books.json'));

try {
    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'book' => [
                'type' => Type::string(),
                'args' => [
                    'idbook' => ['type' => Type::int()],
                ],
                'resolve' => static function ($rootValue, array $args): string {
                    return $rootValue['prefix'] . $args['message'];
                },
            ],
        ],
    ]);

    $mutationType = new ObjectType([
        'name' => 'Mutation',
        'fields' => [
            'sum' => [
                'type' => Type::int(),
                'args' => [
                    'x' => ['type' => Type::int()],
                    'y' => ['type' => Type::int()],
                ],
                
                'resolve' => static function ($calc, array $args): int {
                    return $args['x'] + $args['y'];
                },
            ],
        ],
    ]);

    // See docs on schema options:
    // https://webonyx.github.io/graphql-php/schema-definition/#configuration-options
    $schema = new Schema(
        (new SchemaConfig())
        ->setQuery($queryType)
        ->setMutation($mutationType)
    );

    if ($rawInput === false) {
        throw new RuntimeException('Failed to get php://input');
    }

    $rawInput       = file_get_contents('php://input');
    $input          = json_decode($rawInput, true);
    $query          = $input['query'];
    $variableValues = $input['variables'] ?? null;

    $rootValue = ['prefix' => 'Вы сказали: '];
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray();
} catch (Throwable $e) {
    $output = [
        'error' => [
            'message' => $e->getMessage(),
        ],
    ];
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output, JSON_THROW_ON_ERROR);