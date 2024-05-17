<?php

if (!class_exists('Date_Id')) {
    

    class Date_Id {

        private $id;
        private $date;

        public function __construct() {
            $this->id = 0;
            $this->date = 0;
        }

        /**
         * Get the value of id_user
         */
        public function getId(): int {
                return $this->id;
        }

        /**
         * Set the value of id_user
         */
        public function setId(int $id): void {
                $this->id = $id;
        }

        /**
         * Set the value of id_user
         */
        public function setIdSt(?string $id): void {
                $this->id = 0;
                if (is_numeric($id)) {
                        $num = intval($id);
                        if (is_int($num)) {
                                $this->id = intval($num);
                        }
                }
        }

        /**
         * Get the value of date
         */
        public function getDate(): ?int {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */
        public function setDate(?DateTime $date):void {
                if($date != null) {
                        $this->date = $date->getTimestamp();
                }
        }

        /**
         * Set the value of date
         *
         * @return  self
         */
        public function setDateSt(?string $date):void {
                $this->date = strtotime($date);
        }

        /**
         * Set the value of date
         *
         * @return  self
         */
        public function getDateSt(): ?string {
                return date('Y-M-d h:i:s', $this->date);
        }

    }

}

?>