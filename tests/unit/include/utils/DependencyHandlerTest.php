<?php

include_once __DIR__ . '/../../../../include/utils/DependencyHandler.php';
include_once __DIR__ . '/DependencyHandlerFake.php';

use SuiteCRM\Test\SuitePHPUnit_Framework_TestCase;

/** @noinspection PhpUndefinedClassInspection */
class DependencyHandlerTest extends SuitePHPUnit_Framework_TestCase
{

    /**
     * @see DependencyHandler::__construct()
     */
    public function testConstruct() {
        $dependencyHandlerFake = new DependencyHandlerFake();
        $composerJsonFile = $dependencyHandlerFake->getComposerJsonFile();
        self::assertNotEquals($composerJsonFile, '');
        self::assertTrue((bool)preg_match('/\bcomposer.json$/', $composerJsonFile));
    }

    /**
     * @see DependencyHandler::checkManifestFile()
     */
    public function testCheckManifestFile() {
        // test
        try {
            /** @noinspection PhpParamsInspection */
            DependencyHandler::check();
            self::assertTrue(false);
        } catch(RuntimeException $e) {
            self::assertTrue(true);
        }

        // test
        try {
            DependencyHandler::check('non-exist');
            self::assertTrue(false);
        } catch(RuntimeException $e) {
            self::assertTrue(true);
        }

        // test
        $manifestFile = __DIR__ . '/test-manifest-with-composer.php';
        $dependencyHandler = new DependencyHandlerFake();
        $dependencyHandler->setComposerJsonFile(__DIR__ . '/test-composer.json');
        $results = $dependencyHandler->checkManifestFilePublic($manifestFile);
        self::assertEquals($results, $manifestFile);

    }

}