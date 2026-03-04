<?php

namespace App\Models;

use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

class BankAccount
{
    //

    private string $name;
    public int $solde;

    public function __construct($name, $solde)
    {
        $this->$name = $name;
        $this->solde = $solde;
    }

    public function getSolde()
    {
        return $this->solde;
    }
    public function setSolde($solde)
    {

        $this->solde = $solde;
    }

    public function deposer($money)
    {
        $this->solde += $money;
    }

    public function retirer($money)
    {
        $this->solde -= $money;
    }
}



class user
{

    private string $name;
    public BankAccount $bank_account;

    public function __construct($name, BankAccount $bank_account)
    {
        $this->name = $name;
        $this->bank_account = $bank_account;
    }

    public function getName()
    {
        return $this->name;
    }

    public function toString()
    {
        return $this->name . 'has' . $this->bank_account->getSolde();
    }

    public function getAccount()
    {
        return $this->bank_account;
    }
}


$bank = new BankAccount('CIH', 100);
$user = new User('Houssam', $bank);

$user->getAccount()->deposer(500);
$user->toString();
