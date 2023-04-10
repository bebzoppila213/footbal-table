<?php 

    class FootballMatchService{

        public $matches = [];

        public function addMatch($firstTeam, $secondTeam, $circle, $tour){
            $match = new FootballMatch($firstTeam, $secondTeam, $circle, $tour);
            $this->matches[] = $match;
        }

        public function getMatchesByCircle($circle){
            $startTour = (19 * ($circle - 1)) + 1;
            $matches = [];
            for (; $startTour <= 19 * $circle; $startTour++){
                $matches = array_merge($matches, $this->getMatchesByParams($startTour, $circle));
            }
            return $matches;
        }

        public function getMatchesByParams($tour, $circle)
        {
            $tours = array_filter($this->matches, function($match) use ($tour, $circle){
                return $match->getTour() == $tour && $match->getCircle() == $circle;
            });
            return $tours;
        }
    }
