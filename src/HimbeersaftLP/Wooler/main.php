<?php
namespace HimbeersaftLP\Wooler;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as TF;
class Main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("Wooler by HimbeersaftLP enabled!");
     }
     
     public function getWoolMeta(string $color){
          if($color === "white"){
               $meta = 0;
          }elseif($color === "orange"){
               $meta = 1;
          }elseif($color === "magenta"){
               $meta = 2;
          }elseif($color === "lightblue" || $color === "light_blue"){
               $meta = 3;
          }elseif($color === "yellow"){
               $meta = 4;
          }elseif($color === "lime"){
               $meta = 5;
          }elseif($color === "pink"){
               $meta = 6;
          }elseif($color === "gray"){
               $meta = 7;
          }elseif($color === "lightgray" || $color === "light_gray"){
               $meta = 8;
          }elseif($color === "cyan"){
               $meta = 9;
          }elseif($color === "purple"){
               $meta = 10;
          }elseif($color === "blue"){
               $meta = 11;
          }elseif($color === "brown"){
               $meta = 12;
          }elseif($color === "green"){
               $meta = 13;
          }elseif($color === "red"){
               $meta = 14;
          }elseif($color === "black"){
               $meta = 15;
          }else{
               return false;
          }
          return $meta;
     }

     public function onCommand(CommandSender $sender, Command $command, $label, array $args){
          switch($command->getName()){
               case "wool":
                    if(!isset(args[0])){
                         return false;
                    }else{
                         switch($args[0]){
                              case "id":
                                   if(!isset($args[1])){
                                        return false;
                                   }else{
                                        $meta = $this->getWoolMeta(strtolower($args[1]));
                                        if($meta === false){
                                             $sender->sendMessage(TF::RED . "Color " . $args[1] . " not found!");
                                        }else{
                                             $sender->sendMessage("The ID of " . $args[1] . " wool is " . TF::AQUA . "35" . TF::WHITE . " and the damage tag is ". TF::AQUA . $meta . TF::WHITE . "\nShort form: 35:" . $meta);
                                        }
                                   }
                              case "give":
                                   if($sender instanceof Player){
                                        if(!isset($args[1])){
                                             return false;
                                        }else{
                                             $meta = $this->getWoolMeta(strtolower($args[1]));
                                             if($meta === false){
                                                  $sender->sendMessage(TF::RED . "Color " . $args[1] . " not found!");
                                             }else{
                                                  if(isset($args[2])){
                                                       $count = $args[2];
                                                  }else{
                                                       $count = 1;
                                                  }
                                                  $sender->getInventory()->addItem(Item::get(35,$meta,$count));
                                                  $sender->sendMessage("Wool with ID 35:" . $meta . " has been successfully added to your inventory");
                                             }
                                        }
                                   }else{
                                        $sender->sendMessage(TF::RED . "Please use this command ingame!")
                                   }
                              case "list":
                                   $sender->sendMessage("List of all wool colors with IDs:\nWhite: 35:0\n".TF::GOLD."Orange: 35:1\n".TF::LIGHT_PURPLE."Magenta: 35:2\n".TF::AQUA."Light blue: 35:3\n".TF::YELLOW."Yellow: 35:4\n".TF::GREEN."Lime: 35:5\n".TF::LIGHT_PURPLE."Pink: 35:6\n".TF::DARK_GRAY."Gray: 35:7\n".TF::GRAY."Light gray: 35:8\n".TF::DARK_AQUA."Cyan: 35:9\n".TF::DARK_PURPLE."Purple: 35:10\n".TF::BLUE."Blue: 35:11\n".TF::GOLD."Brown: 35:12\n".TF::DARK_GREEN."Green: 35:13\n".TF::RED."Red: 35:14\n".TF::BLACK."Black: 35:15");
                         }
                    }
          }
          return true;
     }
}