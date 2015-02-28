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
            case "healthtag":
                if($sender instanceof Player){
                    $health = $sender->getHealth();
                    $maxhealth = $sender->getMaxHealth();
                    $name = $sender->getName();
                    $sender->setNameTag("$name $health/$maxhealth");
                    $sender->sendMessage("Your health is now publicly visible.");
                    return true;
                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
            case "hidetag":
                if($sender instanceof Player){
                    $sender->setNameTag("");
                    $sender->sendMessage("Incognito mode enabled!");
                    return true;
                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
            case "iptag":
                if($sender instanceof Player){
                    $ip = $sender->getAddress();
                    $name = $sender->getName();
                    $sender->setNameTag("$name\n$ip");
                    return true;
                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
            case "nametag":
                if($sender instanceof Player){
                    $name = $sender->getName();
                    $sender->setNameTag("$name");
                    $sender->sendMessage("Your default tag has been restored.");
                    return true;
                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
            case "optag":
                if($sender instanceof Player){
                    if($sender->isOp()){
                        $name = $sender->getName();
                        $sender->setNameTag("[OP] $name");
                        $sender->sendMessage("Your op status is now publicly visible.");
                        return true;
                    }
                    else{
                        $sender->sendMessage("You are not an op!");
                        return true;
                    }
                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
            case "tag":
                if($sender instanceof Player){
                    $tag = $sender->getNameTag();
                    $sender->sendMessage("Your tag:\n$tag");
                    return true;
                }
                else{
                    $sender->sendMessage(TextFormat::RED."Please run this command in-game.");
                    return true;
                }
            break;
        }
    }
    
    public function onPlayerQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        $player->setNameTag("$name");
    }
}
