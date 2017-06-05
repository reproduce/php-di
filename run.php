<?php

require_once __DIR__.'/vendor/autoload.php';

final class Toy { }

final class Child {
    public function __construct(Toy $toy) { }
}

final class Father {
    public function __construct(Child $child) { }
}

$containerBuilder = (new \DI\ContainerBuilder())
    ->useAnnotations(true)
    ->useAutowiring(true)
;

$definitions = [
    'autowire' => [
        Child::class => \DI\autowire(),
        Father::class => \DI\autowire(),
    ],
    'nested_autowire' => [
        Father::class => \DI\create()->constructor(\DI\autowire(Child::class)),
    ],
    'nested_create' => [
        Child::class => \DI\create()->constructor(\DI\create(Toy::class)),
        Father::class => \DI\autowire(),
    ],
];

foreach ($definitions as $name => $definition) {
    $builder = clone $containerBuilder;
    $builder->addDefinitions($definition);

    $container = $builder->build();

    try {
        $container->get(Father::class);
        echo $name.": Success\n";
    } catch (\DI\Definition\Exception\InvalidDefinition $e) {
        echo $name.": Failure\n";
        echo $e->getMessage()."\n";
    }
}
