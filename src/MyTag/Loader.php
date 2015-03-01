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
                    $sub = array_shift($args);
                    switch($sub){
                        case "":
                        case "help":
                            $sender->sendMessage(TextFormat::WHITE."/tag address");
                            $sender->sendMessage(TextFormat::WHITE."/tag health");
                            $sender->sendMessage(TextFormat::WHITE."/tag hide");
                            $sender->sendMessage(TextFormat::WHITE."/tag money");
                            $sender->sendMessage(TextFormat::WHITE."/tag op");
                            $sender->sendMessage(TextFormat::WHITE."/tag restore");
                            $sender->sendMessage(TextFormat::WHITE."/tag show");
                            return true;
                        break;
                        case "address":
                            $ip = $sender->getAddress();
                            $port = $sender->getPort();
                            $tag = $sender->getNameTag();
                            $sender->setNameTag("$tag $ip:$port");
                            return true;
                        break;
                        case "health":
                            $health = $sender->getHealth();
                            $maxhealth = $sender->getMaxHealth();
                            $tag = $sender->getNameTag();
                            $sender->setNameTag("$tag $health/$maxhealth");
                            return true;
                        break;
                        case "hide":
                            $sender->setNameTag("");
                            $sender->sendMessage("Incognito mode enabled!");
                            return true;
                        break;
                        case "money":
                            $tag = $sender->getNameTag();
                            return true;
                        break;
                        case "op":
                            if($sender->isOp()){
                                $tag = $sender->getNameTag();
                                $sender->setNameTag("[OP] $tag");
                                return true;
                            }
                            else{
                                $sender->sendMessage("You are not an op.");
                                return true;
                            }
                        break;
                        case "restore":
                            $name = $sender->getName();
                            $sender->setNameTag($name);
                            $sender->sendMessage("Your default name tag has been restored.");
                            return true;
                        break;
                        case "show":
                            $sender->setNameTag("Incognito mode disabled!");
                            return true;
                        break;
                        case "view":
                        break;
                    }
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
        $name = $event->getPlayer()->getName();
        $event->getPlayer()->setNameTag($name);
    }
}
