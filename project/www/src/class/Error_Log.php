<?php
if (!class_exists('Error_Log')) {

    include_once dirname(__FILE__) . '/../config/config.php';

    class Error_Log {

        private $logFile;
        private $error_log;

        public function __construct() {
            $this->logFile = LOG_FILE;
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