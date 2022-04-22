<?php
if (!class_exists('Error_Log')) {

    if(file_exists(dirname(__FILE__) . '/../config/config.php')) {
        include_once dirname(__FILE__) . '/../config/config.php';
    }

    class Error_Log {

        private $logFile;
        private $error_log;

        public function __construct() {
            $this->logFile = dirname(__FILE__)."/../../errors.log";
            if(defined("LOG_FILE")) {
                $this->logFile = LOG_FILE;
            }
        }

        public function addError(int $codeError, ?string $class, ?string $message): void {
            $ligne = "------------------------------------------------------------------------------------\n";
            //$ligne .= date('Y-m-d H:i:s')."\t".$codeError."\t".$class."\n";
            $ligne .= date('Y-m-d H:i:s')."\t".$message."\n";

            // Enregistrement du message d'erreur dans le fichier log
            error_log($ligne, 3, $this->logFile);
        }

    }
}
?>