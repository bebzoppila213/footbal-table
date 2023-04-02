<?php 

    class FootballMatchService{

        private $matches = [];


        public function addMatch($firstTeam, $secondTeam, $circle){
            $match = new FootballMatch($firstTeam, $secondTeam, $circle);
            array_push($this->matches, $match);
        }

        public function getMatchesByCircle($circle)
        {
            $matches = array_filter($this->matches, function($match) use ($circle){
                return $match->getCircle() == $circle;
            });
            shuffle($matches);
            return $matches;
        }
    }

?>