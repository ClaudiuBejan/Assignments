
//this code produces some errors beause not all types are recognised, but installing @types/node solves the problem


export class ScoreKeeper {
    private _teams : {[key:string]:number};
    private _outKeeper: OutKeeper;

    constructor(teams: Array<String>, outKeeper: OutKeeper){
        this._teams = {};
        teams.forEach(element => {
            this._teams[element.toString()] = 0;
        });
        this._outKeeper = outKeeper;
    }

    score(team: string, points: number){
        if(this._outKeeper.getOuts(team) < 3 && points > 0 && points < 5){
            this._teams[team] += points;
        }
    }



    getScores(): Array<Array<string|number>>{
        let teamsArray = Object.keys(this._teams);
        let scoreArray = new Array<Array<string|number>>();
        teamsArray.forEach(element => {
            scoreArray.push([element, this._teams[element]]);
        });
        
        
        return scoreArray;
        
    }

}

export class OutKeeper {
    private _teams : {[key:string]:number};

    constructor(teams: Array<String>){
        this._teams = {};
        teams.forEach(element => {
            this._teams[element.toString()] = 0;
        });
    }

    out(team: string){
        if(this._teams[team] < 3){
        this._teams[team] += 1;
        }
    }

    totals(): string{
        let totalOuts = '*** \n';
        Object.keys(this._teams).forEach(element => {
            totalOuts += `${element} = ${this._teams[element].toString()}`;
        });
        totalOuts += '\n***'
        console.log(totalOuts);

        return totalOuts;
    }

    getOuts(team: string): number{
        return this._teams[team];
    }
}

export class ScoreBoard {
    private _scores: ScoreKeeper;
    private _outs: OutKeeper;

    constructor(scores: ScoreKeeper, outs: OutKeeper){
        this._scores = scores;
        this._outs = outs;
    }

    totals(){
        let scores = this._scores.getScores();

        for(let idx=0; idx < scores.length; idx++){
            if(idx%2===0){
                console.log('***')
            }else{
                console.log('vs')
            }
            console.log(`Team \t${scores[idx][0]} \nRuns \t${scores[idx][1]} \nOuts \t${this._outs.getOuts(scores[idx][0].toString())}`)

            if(idx%2!==0){
                console.log('***')
            }
        }
    }
}


//Tests
var outKeeper = new OutKeeper(['team1', 'team2', 'team3', 'team4']);
var scoreKeeper = new ScoreKeeper(['team1', 'team2', 'team3', 'team4'], outKeeper);
var scoreBoard = new ScoreBoard(scoreKeeper, outKeeper)

//ScoreKeeper.score() test
scoreKeeper.score('team1', 1);
scoreKeeper.score('team2', 2);
scoreKeeper.score('team2', 50);

//OutKeeper.out() test to see if more than 3 outs are recorded
outKeeper.out('team1');
outKeeper.out('team1');
outKeeper.out('team1');
outKeeper.out('team1');

//ScoreKeeper.score() test to see if runs are incremented after 3 outs
scoreKeeper.score('team1', 1);
scoreKeeper.score('team1', 1);

//testing teams 3 and 4
scoreKeeper.score('team3', 1);
outKeeper.out('team3');
outKeeper.out('team3');
outKeeper.out('team3');
scoreKeeper.score('team3', 1);
scoreKeeper.score('team4', 2);
scoreKeeper.score('team4', 3);

//test for totals
scoreBoard.totals();

//This code produces some errors beause not all types are recognised, but installing @types/node solves the problem

//It can handle more than 2 teams (the program does not break), 
//if necessary we could handle each gamne as a separate one, with slight modifications,
//but it was not required to deal with more than 2 games per instance of class, but I tested it out anyway to see if the program is scalable 

//I could have added error handling, but it was not required to make the program expect that the user wants to break it etc.
//so I did not complicate the code unnecessarily. All the contraints for the game rules are added and tested. 

//I tried using mocha to test out the totals() method, but mocha is completely new to me, 
//I got an error: TypeError: score_keeper_js_1.OutKeeper is not a constructor
//It seems like the js code generated from ts code does not have a constructor like classes have 



