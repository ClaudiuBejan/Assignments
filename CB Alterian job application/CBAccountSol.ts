class Account {
    private balance: number;
    private history: Array<String>;

    constructor() {
        this.balance = 0;
        this.history = [];
    }

    deposit(amount: number){
        this.balance += amount;
        this.pushToHistory(amount, '+');
    }

    withdraw(amount: number){
        this.balance -= amount;
        this.pushToHistory(amount, '-');
    }

    pushToHistory(amount: number, action: string){
        const today = new  Date(Date.now());
        this.history.push(`${today.toLocaleDateString()} \t ${action}${amount.toString()} \t\t ${this.balance.toString()}`);
    }

    printStatement() {
        console.log(`Date \t\t Amount \t Balance`);
        this.history.forEach(element => {
            console.log(element);
        });
    }
}


var account = new Account();
account.deposit(100);
account.withdraw(50);
account.printStatement();

