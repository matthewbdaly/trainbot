<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Get me the next train to work', BotManController::class.'@getNextTrainToWork');
$botman->hears('nexttrain', BotManController::class.'@getNextTrainToWork');
