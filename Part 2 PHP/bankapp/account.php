<?php

class Account {
  // Properties
  protected static $accountnumber;
  protected $firstname;
  protected $lastname;
  protected $balance;
  protected $transactionhistory;

  function __construct($firstname, $lastname) {
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->balance = 0.00;
  }

  // Methods
  function deposit($amount) {
    $this->balance += $amount;
  }
  function withdraw($amount) {
      if($this->balance -= $amount > 0){
    $this->balance -= $amount;
      }else{
          return "Insufficient balanace";
      }
  }

  function displaybalance(){
      return number_format($this->balance, 2);
  }
}
