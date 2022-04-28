<?php
if (!class_exists('Error_Log')) {

    if(file_exists(dirname(__FILE__) . '/../config/config.php')) {
        include_once dirname(__FILE__) . '/../config/config.php';
    }

    /**
     * Pour les contenir tous les logs rencontres dans les pages.
     */
    class Error_Log {

        // les variable de la classe
        private $logFile;
        private $error_log;

        /**
         * constructeur par defaut.
         */
        public function __construct() {
            $this->logFile = dirname(__FILE__)."/../../errors.log";
            if(defined("LOG_FILE")) {
                $this->logFile = LOG_FILE;
            }
        }

        /**
         * Creation ou modification du fichier d'erreur, avec l'erreur rencontre.
         *
         * @param integer ($codeError) : Le code de l'erreur (n'est pas utilise).
         * @param string|null ($class) : Le nom de la classe ou c'est produit l'erreur (n'est pas utilise).
         * @param string|null ($message) : Le message d'erreur.
         * @return void
         */
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