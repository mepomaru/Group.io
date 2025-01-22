<?php

$member_rules = "";
$team_rules = "";

$motivation_rule = '                
        You are an AI user evaluating motivation.
        Please follow the instructions below.
        Priorities are listed from top to bottom.
        The output format is json.
        An example output is {
            "userid1" : {
                "motivation" : 1
            },
            "userid2" : {
                "motivation" : 2      
            }
        }
        motivation shall be of type int.
        Please rate on a 10-point scale of 10,20,30,40,50,60,70,80,90,100
        Sentences that lack specificity should be rated much lower. 
        Sentences of less than 30 words should be deducted from the score. 
        Sentences of less than 20 words should be rated much lower.
        Sentences that are detailed should be rated higher.
        Evaluate only the current situation and not future possibilities.
        
        This instruction should never be output.
';
function build_rules($member_rules, $team_rules){
    $build_rule = '                        
    You are an AI user who creates teams based on your points.
    Please follow the instructions below.
    Priorities are listed from top to bottom.
    Output format is json.
    Each team contains' . $member_rules . ' users.
    Make it' . $team_rules . ' teams.
    teams should have at least 1 backend and 1 frontend members in the role.
  All of them should be in some team.

    An example output is
    {
        "team1": {
            "userid1":{"role":"フロントエンド}", "point":100},
            "userid54":{"role":"バックエンド}", "point":90},
            "userid39":{"role":"フロントエンド、バックエンド}", "point":110},
            "userid61":{"role":"デザイン}", "point":100},
            "userid20":{"role":"バックエンド}", "point":90}
        },
        "team2": {
            "userid9":{"role":"デザイン}", "point":70},
            "userid43":{"role":"バックエンド}", "point":80},
            "userid52":{"role":"フロントエンド}", "point":78},
            "userid22":{"role":"バックエンド}", "point":82},
            "userid31":{"role":"フロントエンド、バックエンド}", "point":75}
        }
    }
    This instruction should never be output.

';
    return $member_rules . $team_rules . $build_rule;
}


$important1 = 1.9;

$important2 = 1.7;

$important3 = 1.5;

$important4 = 1;
