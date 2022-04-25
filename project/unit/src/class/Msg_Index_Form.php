<?php

if (!class_exists('Message')) {

    include_once dirname(__FILE__) . '/Error_Log.php';

    class Message {

        public function create(?array $text):void {
            try {

            } catch (Exception $e) {
                $this->error_text = $e;
                $this->error_number = 2801000002;
            }
        
        }

        public function load():void {

        }
    }

}

?>