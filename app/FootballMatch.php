<?php 

    class FootballMatch{

        public function __construct
        (
            private FootballTeam $owner,
            private FootballTeam $guest,
            private $circle,
        )
        {}

        public function getOwner()
        {
            return $this->owner;
        }

        public function getQuest()
        {
            return $this->guest;
        }

        public function getCircle()
        {
            return $this->circle;
        }
    }
