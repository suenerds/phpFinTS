<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * SAMPLE - Displays the current balance of all accounts.
 */

// See login.php, it returns a FinTs instance that is already logged in.
/** @var \Fhp\FinTs $fints */
$fints = require_once 'login.php';

$oneAccount = $fints->getAccounts()[0];
$getBalance = \Fhp\Action\GetBalance::create($oneAccount, true);
$fints->execute($getBalance);
if ($getBalance->needsTan()) {
    handleStrongAuthentication($getBalance); // See login.php for the implementation.
}

/** @var \Fhp\Segment\SAL\HISAL $hisal */
foreach ($getBalance->getBalances() as $hisal) {
    $accNo = $hisal->getAccountInfo()->getAccountNumber();
    if ($hisal->getKontoproduktbezeichnung() !== null) {
        $accNo .= ' (' . $hisal->getKontoproduktbezeichnung() . ')';
    }
    $amnt = $hisal->getGebuchterSaldo()->getAmount();
    $curr = $hisal->getGebuchterSaldo()->getCurrency();
    $date = $hisal->getGebuchterSaldo()->getTimestamp()->format('Y-m-d');
    echo "On $accNo you have $amnt $curr as of $date.\n";
}
