<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            
            [
                "teamName" => "Heren 1",
                "teamId" => "Heren1",
                "source"=> "/api/teams/Heren1"
            ],
            [
                "teamName" => "Heren 2",
                "teamId" => "Heren2",
                "source"=> "/api/teams/Heren2"
            ],
            [
                "teamName" => "Heren 3",
                "teamId" => "Heren3",
                "source"=> "/api/teams/Heren3"
            ],
            [
                "teamName" => "Heren 4",
                "teamId" => "Heren4",
                "source"=> "/api/teams/Heren4"
            ],
            [
                "teamName" => "Heren 5",
                "teamId" => "Heren5",
                "source"=> "/api/teams/Heren5"
            ],
            [
                "teamName" => "Veteranen A",
                "teamId" => "HVA",
                "source"=> "/api/teams/HVA"
            ],
            [
                "teamName" => "Veteranen B",
                "teamId" => "HVB",
                "source"=> "/api/teams/HVB"
            ],
            [
                "teamName" => "Veteranen C",
                "teamId" => "HVC",
                "source"=> "/api/teams/HVC"
            ],
            [
                "teamName" => "Heren Jong 1",
                "teamId" => "HJ1",
                "source"=> "/api/teams/HJ1"
            ],
            [
                "teamName" => "Heren Veteranen HLA / MEP HLB",
                "teamId" => "HLA",
                "source"=> "/api/teams/HLA"
            ],
            [
                "teamName" => "Dames 1",
                "teamId" => "Dames1",
                "source"=> "/api/teams/Dames1"
            ],
            [
                "teamName" => "Dames 2",
                "teamId" => "Dames2",
                "source"=> "/api/teams/Dames2"
            ],
            [
                "teamName" => "Dames 3",
                "teamId" => "Dames3",
                "source"=> "/api/teams/Dames3"
            ],
            [
                "teamName" => "Dames 4",
                "teamId" => "Dames4",
                "source"=> "/api/teams/Dames4"
            ],
            [
                "teamName" => "Dames 5",
                "teamId" => "Dames5",
                "source"=> "/api/teams/Dames5"
            ],
            [
                "teamName" => "Dames 6",
                "teamId" => "Dames6",
                "source"=> "/api/teams/Dames6"
            ],
            [
                "teamName" => "Dames 7",
                "teamId" => "Dames7",
                "source"=> "/api/teams/Dames7"
            ],
            [
                "teamName" => "Dames Veteranen A",
                "teamId" => "DVA",
                "source"=> "/api/teams/DVA"
            ],
            [
                "teamName" => "Dames Jong 1",
                "teamId" => "DJ1",
                "source"=> "/api/teams/DJ1"
            ],
            [
                "teamName" => "Dames Jong 2",
                "teamId" => "DJ2",
                "source"=> "/api/teams/DJ2"
            ],
            [
                "teamName" => "Dames Jong 3",
                "teamId" => "DJ3",
                "source"=> "/api/teams/DJ3"
            ],
            [
                "teamName" => "Dames Jong 4",
                "teamId" => "DJ4",
                "source"=> "/api/teams/DJ4"
            ],
            [
                "teamName" => "Jongens A1",
                "teamId" => "JA1",
                "source"=> "/api/teams/JA1"
            ],
            [
                "teamName" => "Jongens A2",
                "teamId" => "JA2",
                "source"=> "/api/teams/JA2"
            ],
            [
                "teamName" => "Jongens A3",
                "teamId" => "JA3",
                "source"=> "/api/teams/JA3"
            ],
            [
                "teamName" => "Jongens B1",
                "teamId" => "JB1",
                "source"=> "/api/teams/JB1"
            ],
            [
                "teamName" => "Jongens B2",
                "teamId" => "JB2",
                "source"=> "/api/teams/JB2"
            ],
            [
                "teamName" => "Jongens B3",
                "teamId" => "JB3",
                "source"=> "/api/teams/JB3"
            ],
            [
                "teamName" => "Jongens C1",
                "teamId" => "JC1",
                "source"=> "/api/teams/JC1"
            ],
            [
                "teamName" => "Jongens C2",
                "teamId" => "JC2",
                "source"=> "/api/teams/JC2"
            ],
            [
                "teamName" => "Jongens C3",
                "teamId" => "JC3",
                "source"=> "/api/teams/JC3"
            ],
            [
                "teamName" => "Jongens D1",
                "teamId" => "JD1",
                "source"=> "/api/teams/JD1"
            ],
            [
                "teamName" => "Jongens D2",
                "teamId" => "JD2",
                "source"=> "/api/teams/JD2"
            ],
            [
                "teamName" => "Jongens JD3",
                "teamId" => "JD3",
                "source"=> "/api/teams/JD3"
            ],
            [
                "teamName" => "Meisjes A1",
                "teamId" => "MA1",
                "source"=> "/api/teams/MA1"
            ],
            [
                "teamName" => "Meisjes A2",
                "teamId" => "MA2",
                "source"=> "/api/teams/MA2"
            ],
            [
                "teamName" => "Meisjes A3",
                "teamId" => "MA3",
                "source"=> "/api/teams/MA3"
            ],
            [
                "teamName" => "Meisjes A4",
                "teamId" => "MA4",
                "source"=> "/api/teams/MA4"
            ],
            [
                "teamName" => "Meisjes A6",
                "teamId" => "MA6",
                "source"=> "/api/teams/MA6"
            ],
            [
                "teamName" => "Meisjes A7",
                "teamId" => "MA7",
                "source"=> "/api/teams/MA7"
            ],
            [
                "teamName" => "Meisjes A8",
                "teamId" => "MA8",
                "source"=> "/api/teams/MA8"
            ],
            [
                "teamName" => "Meisjes B1",
                "teamId" => "MB1",
                "source"=> "/api/teams/MB1"
            ],
            [
                "teamName" => "Meisjes B2",
                "teamId" => "MB2",
                "source"=> "/api/teams/MB2"
            ],
            [
                "teamName" => "Meisjes B3",
                "teamId" => "MB3",
                "source"=> "/api/teams/MB3"
            ],
            [
                "teamName" => "Meisjes B4",
                "teamId" => "MB4",
                "source"=> "/api/teams/MB4"
            ],
            [
                "teamName" => "Meisjes B5",
                "teamId" => "MB5",
                "source"=> "/api/teams/MB5"
            ],
            [
                "teamName" => "Meisjes B6",
                "teamId" => "MB6",
                "source"=> "/api/teams/MB6"
            ],
            [
                "teamName" => "Meisjes B7",
                "teamId" => "MB7",
                "source"=> "/api/teams/MB7"
            ],
            [
                "teamName" => "Meisjes B8",
                "teamId" => "MB8",
                "source"=> "/api/teams/MB8"
            ],
            [
                "teamName" => "Meisjes C1",
                "teamId" => "MC1",
                "source"=> "/api/teams/MC1"
            ],
            [
                "teamName" => "Meisjes C2",
                "teamId" => "MC2",
                "source"=> "/api/teams/MC2"
            ],
            [
                "teamName" => "Meisjes C3",
                "teamId" => "MC3",
                "source"=> "/api/teams/MC3"
            ],
            [
                "teamName" => "Meisjes C4",
                "teamId" => "MC4",
                "source"=> "/api/teams/MC4"
            ],
            [
                "teamName" => "Meisjes C5",
                "teamId" => "MC5",
                "source"=> "/api/teams/MC5"
            ],
            [
                "teamName" => "Meisjes C6",
                "teamId" => "MC6",
                "source"=> "/api/teams/MC6"
            ],
            [
                "teamName" => "Meisjes C7",
                "teamId" => "MC7",
                "source"=> "/api/teams/MC7"
            ],
            [
                "teamName" => "Meisjes D1",
                "teamId" => "MD1",
                "source"=> "/api/teams/MD1"
            ],
            [
                "teamName" => "Meisjes D2",
                "teamId" => "MD2",
                "source"=> "/api/teams/MD2"
            ],
            [
                "teamName" => "Meisjes D3",
                "teamId" => "MD3",
                "source"=> "/api/teams/MD3"
            ],
            [
                "teamName" => "Meisjes D4",
                "teamId" => "MD4",
                "source"=> "/api/teams/MD4"
            ],
            [
                "teamName" => "Meisjes D5",
                "teamId" => "MD5",
                "source"=> "/api/teams/MD5"
            ],
            [
                "teamName" => "Meisjes D6",
                "teamId" => "MD6",
                "source"=> "/api/teams/MD6"
            ],
            [
                "teamName" => "Jongens J8E1",
                "teamId" => "J8E1",
                "source"=> "/api/teams/J8E1"
            ],
            [
                "teamName" => "Jongens J8E2",
                "teamId" => "J8E2",
                "source"=> "/api/teams/J8E2"
            ],
            [
                "teamName" => "Jongens E1",
                "teamId" => "JE1",
                "source"=> "/api/teams/JE1"
            ],
            [
                "teamName" => "Jongens E2",
                "teamId" => "JE2",
                "source"=> "/api/teams/JE2"
            ],
            [
                "teamName" => "JF1",
                "teamId" => "JF1",
                "source"=> "/api/teams/JF1"
            ],
            [
                "teamName" => "JF2",
                "teamId" => "JF2",
                "source"=> "/api/teams/JF2"
            ],
            [
                "teamName" => "Meisjes M8E1",
                "teamId" => "M8E1",
                "source"=> "/api/teams/M8E1"
            ],
            [
                "teamName" => "Meisjes M8E2",
                "teamId" => "M8E2",
                "source"=> "/api/teams/M8E2"
            ],
            [
                "teamName" => "Meisjes M8E3",
                "teamId" => "M8E3",
                "source"=> "/api/teams/M8E3"
            ],
            [
                "teamName" => "Meisjes M8E4",
                "teamId" => "M8E4",
                "source"=> "/api/teams/M8E4"
            ],
            [
                "teamName" => "Meisjes M8E5",
                "teamId" => "M8E5",
                "source"=> "/api/teams/M8E5"
            ],
            [
                "teamName" => "Meisjes E1",
                "teamId" => "ME1",
                "source"=> "/api/teams/ME1"
            ],
            [
                "teamName" => "Meisjes E2",
                "teamId" => "ME2",
                "source"=> "/api/teams/ME2"
            ],
            [
                "teamName" => "Meisjes E3",
                "teamId" => "ME3",
                "source"=> "/api/teams/ME3"
            ],
            [
                "teamName" => "Meisjes E4",
                "teamId" => "ME4",
                "source"=> "/api/teams/ME4"
            ],
            [
                "teamName" => "Meisjes E5",
                "teamId" => "ME5",
                "source"=> "/api/teams/ME5"
            ],
            [
                "teamName" => "Meisjes E6",
                "teamId" => "ME6",
                "source"=> "/api/teams/ME6"
            ],
            [
                "teamName" => "Meisjes E7",
                "teamId" => "ME7",
                "source"=> "/api/teams/ME7"
            ],
            [
                "teamName" => "MF1",
                "teamId" => "MF1",
                "source"=> "/api/teams/MF1"
            ],
            [
                "teamName" => "MF2",
                "teamId" => "MF2",
                "source"=> "/api/teams/MF2"
            ],
            [
                "teamName" => "MF3",
                "teamId" => "MF3",
                "source"=> "/api/teams/MF3"
            ],
            [
                "teamName" => "MF4",
                "teamId" => "MF4",
                "source"=> "/api/teams/MF4"
            ],
            [
                "teamName" => "Funkey",
                "teamId" => "Funkey",
                "source"=> "/api/teams/Funkey"
            ],
            [
                "teamName" => "Team G2",
                "teamId" => "G2",
                "source"=> "/api/teams/G2"
            ],
            [
                "teamName" => "Team G1",
                "teamId" => "Ghockey",
                "source"=> "/api/teams/Ghockey"
            ],
            [
                "teamName" => "Maeshackers",
                "teamId" => "MAES",
                "source"=> "/api/teams/MAES"
            ],
            [
                "teamName" => "Trimmers",
                "teamId" => "TRIM",
                "source"=> "/api/teams/TRIM"
            ]
        
        ];

        foreach($teams as $team){
            
            Team::create([
                'name' => $team['teamName'],
                'teamId' => $team['teamId']
            ]);
        }
    }
}
