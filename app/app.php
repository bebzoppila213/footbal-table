<?php
require_once "./app/FootballMatch.php";
require_once "./app/FootballTeam.php";
require_once "./app/FootballMatchService.php";

class App
{
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
        for ($tour = 1; $tour <= 19; $tour++) {
            $freeCommands = $commands;

            for ($i = 1; $i <= 10; $i++) {
                $firstTeamKey = array_rand($freeCommands);
                $firstTeam = new FootballTeam($freeCommands[$firstTeamKey]['id'], $freeCommands[$firstTeamKey]['name']);
                unset($freeCommands[$firstTeamKey]);

                $secondTeamKey = array_rand($freeCommands);
                $secondTeam = new FootballTeam($freeCommands[$secondTeamKey]['id'], $freeCommands[$secondTeamKey]['name']);
                unset($freeCommands[$secondTeamKey]);

                $this->footbalService->addMatch($firstTeam, $secondTeam, 1, $tour);
                $this->footbalService->addMatch($secondTeam, $firstTeam, 2, $tour + 19);
            }
        }
    }

    public function getFootballMatchService()
    {
        return $this->footbalService;
    }
}
