<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
$botman->hears('Get me a train time', BotManController::class.'@getTrainTime');
$botman->hears('Get me the next train to work', BotManController::class.'@getNextTrainToWork');
$botman->hears('nexttrain', BotManController::class.'@getNextTrainToWork');
