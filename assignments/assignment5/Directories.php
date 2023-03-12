<?php

class Directories {
    public function createDirectoryAndFile($dirname, $content) {
        // check if the directory already exists
        if (is_dir('directories/' . $dirname)) {
            return 'exists';
        }

        // create the directory with 777 permissions
        $result = mkdir('directories/' . $dirname, 0777);

        // check if the directory was created successfully
        if ($result === false) {
            return false;
        }

        // create the file with the given content
        $result = file_put_contents('directories/' . $dirname . '/readme.txt', $content);

        // check if the file was created successfully
        if ($result === false) {
            return false;
        }

        return true;
    }
}

?>
