<?php

namespace Aleprosli\RepositoryPattern\Services;

class RepositoryService
{
    protected static function getStubs(string $type): string
    {
        $path = base_path("App/stubs/{$type}.stub");
        $contents = file_get_contents($path);
        if ($contents === false) {
            throw new RuntimeException("Failed to read file: {$path}");
        }
        return $contents;
    }

    public static function create(string $name): void
    {
        $repositoryPath = base_path('App/Repositories');
        if (!file_exists($repositoryPath)) {
            mkdir($repositoryPath, 0777, true);
        }

        self::makeProvider();
        self::makeInterface($name);
        self::makeRepositoryClass($name);
    }

    protected static function makeProvider(): void
    {
        $path = base_path('App/Providers/RepositoryServiceProvider.php');
        if (!file_exists($path)) {
            $template = self::getStubs('RepositoryServiceProvider');
            file_put_contents($path, $template);
        }
    }

    protected static function makeInterface(string $name): void
    {
        $path = base_path("App/Repositories/{$name}RepositoryInterface.php");
        $template = str_replace(['{{model}}'], [$name], self::getStubs('RepositoryInterface'));
        file_put_contents($path, $template);
    }

    protected static function makeRepositoryClass(string $name): void
    {
        $path = base_path("App/Repositories/{$name}Repository.php");
        $template = str_replace(['{{model}}'], [$name], self::getStubs('Repository'));
        file_put_contents($path, $template);
    }
}