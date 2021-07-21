
//Although Typescript gives an error( Accessors are only available when targeting ECMAScript 5 and higher.), 
//it can be ignored, unless we wish to support ECMAScript 4 and lower. 

class Point{
    private _x: number;
    private _y: number;

    constructor(x: number, y: number){
        this._x = x;
        this._y = y;
    }
    get x(): number {
        return this._x;
    }

    get y(): number {
        return this._y;
    }
}


function manhattanDistance(Point1: Point, Point2: Point){
    const distance = Math.abs(Point1.x - Point2.x) + Math.abs(Point1.y - Point2.y);
    console.log(`The distance is ${distance} blocks.`)
}

const point1 = new Point(1, 1);
const point2 = new Point(4, 4);
const point3 = new Point(-1, -1);
const point4 = new Point(4, 4);

manhattanDistance(point1, point2); //The distance is 10 blocks.
manhattanDistance(point3, point4); //The distance is 6 blocks.