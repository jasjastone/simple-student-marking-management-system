<?php

class Validator
{
    /** Check if the specified file is an image
     * @param $file
     * @return bool
     */
    static public function image($file)
    {
        $imageExtestion = ['jpg', 'png', 'jpeg'];
        $file = explode('.', $file)[1];
        if (in_array($file, $imageExtestion)) {
            return $file;
        }
        return false;
    }
    /** Check if the specified file is an pdf file
     * @param $file
     * @return bool
     */
    static public function pdf($file)
    {
        $pdfExtension = ['pdf'];
        $file = explode('.', $file)[1];
        if (in_array($file, $pdfExtension)) {
            return $file;
        }
        return false;
    }

    /**
     * clear the input to be inserted to the db
     * @param string $input
     * @param mysqli $connection
     * @param string $back
     * @param string $message
     * @return string
     */
    static public function input($input, $connection)
    {
        $input = trim($input);
        if ($input == "" || $input == null) {
            return null;
        }
        $input = htmlspecialchars($input);
        $input = mysqli_real_escape_string($connection, $input);
        return $input;
    }
    /**
     * Create a directory if it doesn't exists
     * @param string $path
     * @return bool true if created or false fail to create
     */
    static public function createDirectoryIfNotExist($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
            return true;
        }
        return false;
    }
    /**
     * Check if the file is pdf or not
     * @param string $filename
     * @return bool
     */
    static public function ispdf($filename)
    {
        if (end(explode('.', $_FILES['amount_paid_only_fees_file']['name'])) != "pdf") {
            return false;
        }
        return true;
    }
    /**
     * Used to check if the file input $_FILES is empty
     * @param string $filename the name of the input type file
     * @return bool true if the file is empty false if not
     */
    static public function inputFileIsEmpty($filename)
    {
        if ($_FILES[$filename]['size'] == 0 && $_FILES[$filename]['error'] == 0) {
            return true;
        }
        return false;
    }
    /**
     * Check if the input that use post method is empty
     * @param string $input input name
     * @return bool true if the input is empty false if not
     */
    static public function isEmptyInputPostMethod($input)
    {
        if (!isset($_POST[$input]) || trim($_POST[$input]) == '') {
            return true;
        }
        return false;
    }
}
