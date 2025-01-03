<?php

require_once 'includes/common.php';

use libAllure\Session;
use libAllure\DatabaseFactory;

if (!$cfg->getBool('VOTING_ENABLED')) {
    outputJson(
        array(
        "type" => "error",
        "message" => "Voting is disabled.",
        "cause" => "votingDisabled"
        )
    );
}

$cause = "";

try {
    $dir = libAllure\Shortcuts::san()->filterString('dir');
    $id = libAllure\Shortcuts::san()->filterUint('id');

    switch ($dir) {
        case 'up':
            $delta = 1;
            break;
        case 'down':
            $delta = -1;
            break;
        default:
            throw new Exception('What direction is that?!');
    }

    if (!Session::isLoggedIn()) {
        $cause = 'needsLogin';
        throw new Exception("You need to be logged in.");
    } else {
        $sql = 'SELECT v.delta FROM votes v WHERE v.quote = :quote AND v.user = :user LIMIT 1';
        $stmt = DatabaseFactory::getInstance()->prepare($sql);
        $stmt->bindValue('quote', $id);
        $stmt->bindValue('user', Session::getUser()->getId());
        $stmt->execute();

        if ($stmt->numRows() > 0) {
            $currentVote = $stmt->fetchRow();
            $currentVote['delta'] = intval($currentVote['delta']);

            $delta = $currentVote['delta'] + $delta;

            if ($delta > 1) {
                $delta = 1;
            } elseif ($delta < -1) {
                $delta = -1;
            }
        }

        $sql = 'INSERT INTO votes (quote, user, delta) VALUES (:quote, :user, :delta1) ON DUPLICATE KEY UPDATE delta = :delta2';
        $stmt = DatabaseFactory::getInstance()->prepare($sql);
        $stmt->bindValue('quote', $id);
        $stmt->bindValue('user', Session::getUser()->getId());
        $stmt->bindValue('delta1', $delta);
        $stmt->bindValue('delta2', $delta);
        $stmt->execute();

        $sql = 'SELECT SUM(v.delta) AS newVal FROM quotes q LEFT JOIN votes v ON v.quote = q.id WHERE q.id = :id GROUP BY q.id';
        $stmt = DatabaseFactory::getInstance()->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        $quote = $stmt->fetchRowNotNull();
        $newVal = intval($quote['newVal']);
    }

    outputJson(
        array(
        "type" => "ok",
        "id" => $id,
        "newVal" => $newVal,
        )
    );
} catch (Exception $e) {
    $error = array(
    "type" => "error",
    "message" => $e->getMessage(),
    "cause" => $cause
    );

    outputJson($error);
}
