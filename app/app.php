<?php 
    require_once "./app/FootballMatch.php";
    require_once "./app/FootballTeam.php";
    require_once "./app/FootballMatchService.php";

    class App{
        private FootballMatchService $footbalService;
        private string $fileCommandsPath;

        public function __construct(string $filePath)
        {
            $this->footbalService = new FootballMatchService();
            $this->fileCommandsPath = $filePath;
        }

        public function loadDataFromFile()
        {
            $commands = json_decode(file_get_contents($this->fileCommandsPath), true);
            for ($i = 0; $i <= count($commands) - 1; $i++) {
                $firstTeam = new FootballTeam($commands[$i]['id'], $commands[$i]['name']);
                for ($j = $i + 1; $j  < count($commands); $j++) { 
                    $secondTeam = new FootballTeam($commands[$j]['id'], $commands[$j]['name']);
                    $this->footbalService->addMatch($firstTeam, $secondTeam, 1);
                    $this->footbalService->addMatch($secondTeam, $firstTeam, 2);
                }
            }
        }

        public function getFootballMatchService(){
            return $this->footbalService;
        }
    }

?>