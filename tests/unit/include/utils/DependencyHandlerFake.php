<?php


include_once __DIR__ . '/../../../../include/utils/DependencyHandler.php';

class DependencyHandlerFake extends DependencyHandler
{

    public function getComposerJsonFile() {
        return $this->composerJsonFile;
    }

    public function setComposerJsonFile($composerJsonFile) {
        $this->composerJsonFile = $composerJsonFile;
    }

    public function checkManifestFilePublic($manifestFile) {
        return parent::checkManifestFile($manifestFile);
    }

}