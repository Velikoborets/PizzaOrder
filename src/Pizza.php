<?php
    class Pizza
    {
        public $id;
        public $size;
        public function __construct ($id, $size)
        {
            $this->id = $id;
            $this->size = $size;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getSize()
        {
            return $this->size;
        }
    }