<?php

namespace DJALM;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
    
    /** @var Config */
    public $config;
    /** @var bool */
    public $enablejoinmsg = false;
    /** @var bool */
    public $enableleavemsg = false;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        @mkdir($this->getDataFolder());
        $this->saveResource("Config.yml");
        $defaults = [
            "#If false, join message will not be displayed!" => "Default: false",
            "enable-join-message" => false,
            "#If false, leave message will not be displayed!" => "Default: false",
            "enable-leave-message" => false
        ];
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, $defaults);

        $this->enablejoinmsg = $this->config->get("enable-join-message");
        $this->enableleavemsg = $this->config->get("enable-leave-message");

        $this->getServer()->getLogger()->info("§aDJALM Enabled!");
    }
   
    public function onJoin(PlayerJoinEvent $event){
        if(!$this->enablejoinmsg)  $event->setJoinMessage("");
    }
    public function onQuit(PlayerQuitEvent $event){
        if(!$this->enableleavemsg)  $event->setQuitMessage("");
    }
}