<?php

require_once __DIR__ . '/../../autoload.php';

$simpleRemoteControl = new \Command\example01\SimpleRemoteControl();
$light = new \Command\example01\Entity\Light();

$lightOnCommand = new \Command\example01\Command\LightOnCommand($light);
$simpleRemoteControl->setCommand($lightOnCommand);
$simpleRemoteControl->buttonWasPressed();

$garageDoor = new \Command\example01\Entity\GarageDoor();
$garageDoorOpenCommand = new \Command\example01\Command\GarageDoorOpenCommand($garageDoor);
$simpleRemoteControl->setCommand($garageDoorOpenCommand);
$simpleRemoteControl->buttonWasPressed();

//======================================================================================================================
$remoteControl = new \Command\example01\RemoteControl();

$stereo = new \Command\example01\Entity\Stereo();
$stereoOnWithCD = new \Command\example01\Command\StereoOnWithCDCommand($stereo);
$stereoOff = new \Command\example01\Command\StereoOffCommand($stereo);

$remoteControl->setCommand(2, $stereoOnWithCD, $stereoOff);
$remoteControl->onButtonWasPushed(2);

// Вариант с сохранением предыдущего состояния.
$remoteControlWithUndo = new \Command\example01\RemoteControlWithUndo();

$light1 = new \Command\example01\Entity\Light();
$light1On = new \Command\example01\Command\LightOnCommand($light1);
$light1Off = new \Command\example01\Command\LightOffCommand($light1);

$remoteControlWithUndo->setCommand(0, $light1On, $light1Off);
$remoteControlWithUndo->offButtonWasPushed(0);
$remoteControlWithUndo->undoButtonWasPushed();