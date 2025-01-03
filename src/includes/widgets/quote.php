<?php

$tpl->assign('quote', $quote);
$tpl->assign('isVotingEnabled', $cfg->getBool('ENABLE_VOTING'));
$tpl->display('quote.tpl');
