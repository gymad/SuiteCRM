<?php

class DependencyHandler
{

    protected $composerJsonFile;

    public function __construct() {
        $this->composerJsonFile = preg_replace('/\/include\/utils$/', '', __DIR__) . '/composer.json';
    }

    public static function check($manifestFile) {
        $dependencyHandler = new DependencyHandler();
        $returnValue  = $dependencyHandler->checkManifestFile($manifestFile);
        return $returnValue;
    }

    /**
     * @param $manifestFile
     * @return mixed
     * @throws \RuntimeException
     */
    protected function checkManifestFile($manifestFile) {

        if(!$manifestFile) {
            throw new RuntimeException('Manifest filename can not be empty.');
        }

        if(!file_exists($manifestFile)) {
            throw new RuntimeException("Manifest file not found: $manifestFile");
        }

        include $manifestFile;

        $manifestVariables = get_defined_vars();

        foreach($manifestVariables as $manifestVariable => $manifestValue) {
            if (!in_array($manifestVariable, array('manifestFile', 'this'), true)) {
                $check = false;
                if ($manifestVariable === 'composer') {
                    $check = $this->checkManifestComposerDependency($$manifestVariable);
                }
                if (isset($manifestValue['composer'])) {
                    $check = $this->checkManifestComposerDependency($manifestValue['composer']);
                }
                if(!$check) {
                    $GLOBALS['log']->fatal("Manifest file doesn't have composer key: $manifestFile");
                }
            }
        }

        return $manifestFile;
    }

    protected function checkManifestComposerDependency($manifestComposerDescription) {

        if(!$composerJson = file_get_contents($this->composerJsonFile)) {
            $GLOBALS['log']->fatal("{$this->composerJsonFile} not found.");
            return false;
        } else {
            if(!$composerDescription = json_decode($composerJson, true)) {
                $GLOBALS['log']->fatal("Incorrect json format in file: '$composerJson'");
            }
            $mergedComposerDescription = $this->merge($composerDescription, $manifestComposerDescription);
            if ($mergedComposerDescription !== $composerDescription) {
                return $this->updateComposerJson($mergedComposerDescription);
            } else {
                // composer.json did not change, nothing to do
                return false;
            }
        }

    }

    protected function merge($arr1, $arr2 ) {
        $keys = array_keys( $arr2 );
        foreach( $keys as $key ) {
            if( isset( $arr1[$key] )
                && is_array( $arr1[$key] )
                && is_array( $arr2[$key] )
            ) {
                $arr1[$key] = $this->merge( $arr1[$key], $arr2[$key] );
            } else {
                $arr1[$key] = $arr2[$key];
            }
        }
        return $arr1;
    }

    protected function updateComposerJson($composerDescription) {

        $next = 0;
        do {
            $composerBackupFile = "{$this->composerJsonFile}.backup" . ($next ? "-$next" : '');
            $next++;
        } while(file_exists($composerBackupFile));

        if(!copy($this->composerJsonFile, $composerBackupFile)) {
            $GLOBALS['log']->fatal("{$this->composerJsonFile} backup fails");
            return false;
        }

        if(!$composerJson = json_encode($composerDescription, JSON_PRETTY_PRINT)) {
            $GLOBALS['log']->fatal('Unable to JSON encode composer descriptions');
            return false;
        }

        if(!file_put_contents($this->composerJsonFile, $composerJson)) {
            $GLOBALS['log']->fatal("{$this->composerJsonFile} file write error.");
            return false;
        }

        return true;
    }


}