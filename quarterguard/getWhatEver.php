<?php
require_once 'core/init.php';
$company = new FrontEnd();

 $stateP = $company->getOfficals('BBStatePresident',1,0);
 if (!$stateP) {
    echo 'No Data!';
 }

 $stateS = $company->getOfficals('BBStateSSO',1,0);
 if (!$stateS) {
    echo 'No Data!';
 }


$historyBB = $company->getHistory('BBHistory', 1);
if (!$historyBB) {
   echo 'No Data!';
}

$historyBBN = $company->getHistory('BBNHistory', 1);
if (!$historyBBN) {
   echo 'No Data!';
}

$historyBBState = $company->getHistory('BBStateHistory', 1);
if (!$historyBBState) {
   echo 'No Data!';
}

$historyBBStateExe = $company->getStateEx('BBStateExecutives', 0);
if (!$historyBBStateExe) {
   echo 'No Data!';
}

$trainingofficers = $company->getStateEx('BBStateCouncilsTofficers', 0);
if (!$trainingofficers) {
   echo 'No Data!';
}

$introduction = $company->getIntroduction('BBStateCouncilsTofficers', 1,0);
if (!$introduction) {
   echo 'No Data!';
}

$councils = $company->getStateEx('BBStateCouncils', 0);
if (!$councils) {
   echo 'No Data!';
}

$introductioncou = $company->getIntroduction('BBStateCouncils', 1,0);
if (!$introductioncou) {
   echo 'No Data!';
}

$introductioncou20 = $company->getIntroduction('BBStateCouncils', 20,0);
if (!$introductioncou20) {
   echo 'No Data!';
}

$introductioncou25 = $company->getIntroduction('BBStateCouncils', 25,0);
if (!$introductioncou25) {
   echo 'No Data!';
}

$statepresidents = $company->getStateEx('statePresidents', 0);
if (!$statepresidents) {
   echo 'No Data!';
}

$statepresidentsvice = $company->getStateEx('stateVicePresidents', 0);
if (!$statepresidentsvice) {
   echo 'No Data!';
}

$statesso = $company->getStateEx('stateSSO', 0);
if (!$statesso) {
   echo 'No Data!';
}

$stateasso = $company->getStateEx('stateASSO', 0);
if (!$stateasso) {
   echo 'No Data!';
}


$statetreasures  = $company->getStateEx('stateTreasures', 0);
if (!$statetreasures) {
   echo 'No Data!';
}

$statefinsec  = $company->getStateEx('stateFinSec', 0);
if (!$statefinsec) {
   echo 'No Data!';
}

$statepros  = $company->getStateEx('statePROS', 0);
if (!$statepros) {
   echo 'No Data!';
}

$statedo = $company->getStateEx('stateDO', 0);
if (!$statedo) {
   echo 'No Data!';
}

$stateparadecommanders = $company->getStateEx('stateParadeCommanders', 0);
if (!$stateparadecommanders) {
   echo 'No Data!';
}

$statechaplains = $company->getStateEx('stateChaplains', 0);
if (!$statechaplains) {
   echo 'No Data!';
}

$statebm = $company->getStateEx('stateBandMasters', 0);
if (!$statebm) {
   echo 'No Data!';
}

$stateqm = $company->getStateEx('stateQBMasters', 0);
if (!$stateqm) {
   echo 'No Data!';
}

$statepiemem  = $company->getStateEx('stateBBPionierMem', 0);
if (!$statepiemem) {
   echo 'No Data!';
}

$statepp  = $company->getStateEx('stateBBPatrons', 0);
if (!$statepp) {
   echo 'No Data!';
}

$news = $company->selectTable(1);


$slider = $company->selectTables('carousel_item', 0);

$gallery = $company->selectTables('BBStateGallery', 0);