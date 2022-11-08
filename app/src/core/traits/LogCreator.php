<?php

namespace Crud\Mvc\core\traits;

trait LogCreator
{
    public function wh_log($log_msg, $dir_name = "upload_logs", $file_name = '/upload_'): void
    {
        if (!file_exists("logs")) {
            mkdir("logs", 0777, true);
        }
        $log_filename = "logs/$dir_name/";
        if (!file_exists($log_filename)) {
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = "logs/$dir_name/" . $file_name . date('d-M-Y') . '.log';
        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }
}