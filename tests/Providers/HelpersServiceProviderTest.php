<?php

namespace AuthGrove\Tests\Providers;

use AuthGrove\Tests\TestCase;

use File;

class HelpersServiceProviderTest extends TestCase {

    ///
    /// Tests specific to this service provider
    ///

    public function testOmittedFiles () {
        // Gets files in the folder
        $files = File::allFiles(app_path('Helpers'));
        array_walk($files, function (&$item) {
            $item = (string)$item; }
        );

        // Asserts each of these file are well included, if not provide an hint
        // to solve the issue.
        $this->assertArrayContainsArrayItems(
            $files,
            get_included_files(),
            "Files in the helpers/ folder are intended to be required in the "
            . "HelpersServiceProvider::register method. "
            . "Edit app/Providers/HelpersServiceProvider.php to fix the issue."
        );
    }

}
