<?php 

    class FootballTeam{

        public function __construct
        (
            private $id,
            private $name
        )
        {}

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }
    }
