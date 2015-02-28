<?php

namespace MyTag;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class Loader extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN."MyTag enabled.");
    }
    
    public function onDisable(){
        $this->getLogger()->info(TextFormat::RED."MyTag disabled.");
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
            case "tag":
                if($sender instanceof Player){

                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
        }
    }
    
    public function onEntityDamage(EntityDamageEvent $event){
    
    }

    public function onEntityRegainHealth(EntityRegainHealthEvent $event){

    }

    public function onPlayerQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        $player->setNameTag("$name");
    }
}
