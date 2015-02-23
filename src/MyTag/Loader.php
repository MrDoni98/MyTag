<?php

namespace MyTag;

use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN."MyTag enabled.");
    }
    
    public function onDisable(){
        $this->getLogger()->info(TextFormat::RED."MyTag disabled.");
    }
    
    public function onPlayerQuit(PlayerQuitEvent $event){
        
    }
}
