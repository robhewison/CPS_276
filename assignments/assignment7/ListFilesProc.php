<?php
require_once("Pdo_methods.php");

class ListFilesProc extends PdoMethods {
    public function listFiles() {
        $sql = "SELECT file_name, file_path FROM pdf_files";
        $records = $this->selectNotBinded($sql);

        if ($records == 'error') {
            return 'There has been an error processing your request';
        } else {
            if (count($records) != 0) {
                return $this->createFileList($records);
            } else {
                return 'No files found';
            }
        }
    }

    private function createFileList($records) {
        $list = '<ul>';
        foreach ($records as $row) {
            $list .= "<li><a target='_blank' href='{$row['file_path']}'>{$row['file_name']}</a></li>";
        }
        $list .= '</ul>';
        return $list;
    }
    
}