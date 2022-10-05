<?php

namespace StickEffect;

use pocketmine\plugin\PluginBase;
use StickEffect\Items\StickEffect;

class Main extends PluginBase{

    public static Main $instance;

    public function onEnable(): void{

        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
        $this->getServer()->getLogger()->notice("StickEffect plugin enabled");

        $this->getServer()->getPluginManager()->registerEvents(new StickEffect(), $this);
    }

    public static function getInstance() : Main{
        return self::$instance;
    }
}