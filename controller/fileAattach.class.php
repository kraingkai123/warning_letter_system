<?php

class FileAttach
{
    public function __construct()
    {
        global $conn;
    }
    public static function createFolder()
    {
        $path =  '../fileupload/';
        //เดือน
        $foldername = "";
        $foldername = $path . date('Y') . date('m') . "/";

        if (!file_exists($foldername)) {
            mkdir($foldername, 0777, true);
        }
        return $foldername;
    }
    public static function AddFile(string $temp, array $fields)
    {
        $fileId = db_insert('m_file_attach', $fields);
        if ($fileId != "") {
            move_uploaded_file($temp, $fields['full_url']);
        }
    }
    public static function Save2Master($letterId, $tempId)
    {
        unset($fields);
        $fields['letter_id'] = $letterId;
        $cond['letter_id'] = $tempId;
        db_update('m_file_attach', $fields, $cond);
    }
    public static function DeleteFile($letterId)
    {
        $listFile = self::listFile($letterId);
        foreach ($listFile as $key => $value) {
            unlink($value['full_url']);
            unset($cond);
            $cond['file_id'] = $value['file_id'];
            db_delete('m_file_attach', $cond);
        }
    }
    public static function listFile($letterId)
    {
        $response = db_query("SELECT * FROM m_file_attach WHERE letter_id='" . $letterId . "'");
        return $response;
    }
}
