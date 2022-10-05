<?php

namespace Tazz\StickEffect\Items;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\VanillaItems;
use pocketmine\utils\Config;
use pocketmine\data\bedrock\EffectIdMap;
use pocketmine\entity\effect\EffectInstance;
use StickEffect\Main;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemFactory;

class StickEffect implements Listener{

    private $coldownf;
    private $coldowns;
    private $coldownr;
    private $coldownj;
    private $coldownb;
    private $coldownh;

    public function stickForce(PlayerItemUseEvent $e){

        $p = $e->getPlayer();

        if ($p->getInventory()->getItemInHand()->getId() === VanillaItems::BLAZE_ROD()->getId()) {
            if(isset($this->coldownf[$p->getName()]) && $this->coldownf[$p->getName()] > time()){
                $e->cancel();
                $temps = $this->coldownf[$p->getName()] - time();
                $p->sendPopup(str_replace("{time}", "$temps", $this->getConfig()->get("cooldownmsgforce")));
            }if (!$e->isCancelled()) {
                $ef = new EffectInstance(EffectIdMap::getInstance()->fromId(5),200,1);
                $p->getEffects()->add($ef);
                $p->sendPopup($this->getConfig()->get("stickmsgforce"));
                $this->coldownf[$p->getName()] = time() + $this->getConfig()->get("cooldownforce");
            }
        }
    }

    public function stickVitesse(PlayerItemUseEvent $e){

        $p = $e->getPlayer();

        if ($p->getInventory()->getItemInHand()->getId() === VanillaItems::SUGAR()->getId()) {
            if(isset($this->coldowns[$p->getName()]) && $this->coldowns[$p->getName()] > time()){
                $e->cancel();
                $temps = $this->coldowns[$p->getName()] - time();
                $p->sendPopup(str_replace("{time}", "$temps", $this->getConfig()->get("cooldownmsgspeed")));
            }if (!$e->isCancelled()) {
                $ef = new EffectInstance(EffectIdMap::getInstance()->fromId(1),200,2);
                $p->getEffects()->add($ef);
                $p->sendPopup($this->getConfig()->get("stickmsgspeed"));
                $this->coldowns[$p->getName()] = time() + $this->getConfig()->get("cooldownspeed");
            }
        }
    }

    public function stickregen(PlayerItemUseEvent $e){

        $p = $e->getPlayer();

        if ($p->getInventory()->getItemInHand()->getId() === VanillaItems::NETHER_BRICK()->getId()) {
            if(isset($this->coldownr[$p->getName()]) && $this->coldownr[$p->getName()] > time()){
                $e->cancel();
                $temps = $this->coldownr[$p->getName()] - time();
                $p->sendPopup(str_replace("{time}", "$temps", $this->getConfig()->get("cooldownmsgregen")));
            }if (!$e->isCancelled()) {
                $ef = new EffectInstance(EffectIdMap::getInstance()->fromId(10),200,3);
                $p->getEffects()->add($ef);
                $p->sendPopup($this->getConfig()->get("stickmsgregen"));
                $this->coldownr[$p->getName()] = time() + $this->getConfig()->get("cooldownregen");
            }
        }
    }

    public function stickjump(PlayerItemUseEvent $e){

        $p = $e->getPlayer();

        if ($p->getInventory()->getItemInHand()->getId() === VanillaItems::BRICK()->getId()) {
            if(isset($this->coldownj[$p->getName()]) && $this->coldownj[$p->getName()] > time()){
                $e->cancel();
                $temps = $this->coldownj[$p->getName()] - time();
                $p->sendPopup(str_replace("{time}", "$temps", $this->getConfig()->get("cooldownmsgjump")));
            }if (!$e->isCancelled()) {
                $ef = new EffectInstance(EffectIdMap::getInstance()->fromId(8),200,2);
                $p->getEffects()->add($ef);
                $p->sendPopup($this->getConfig()->get("stickmsgjump"));
                $this->coldownj[$p->getName()] = time() + $this->getConfig()->get("cooldownjump");
            }
        }
    }

    public function stickbedo(PlayerItemUseEvent $e){

        $p = $e->getPlayer();

        if ($p->getInventory()->getItemInHand()->getId() === VanillaItems::GHAST_TEAR()->getId()) {
            if(isset($this->coldownb[$p->getName()]) && $this->coldownb[$p->getName()] > time()){
                $e->cancel();
                $temps = $this->coldownb[$p->getName()] - time();
                $p->sendPopup(str_replace("{time}", "$temps", $this->getConfig()->get("cooldownmsgbedo")));
            }if (!$e->isCancelled()) {
                $force = new EffectInstance(EffectIdMap::getInstance()->fromId(5),200,1);
                $speed = new EffectInstance(EffectIdMap::getInstance()->fromId(1),200,2);
                $regen = new EffectInstance(EffectIdMap::getInstance()->fromId(10),200,3);
                $jump = new EffectInstance(EffectIdMap::getInstance()->fromId(8),200,2);
                $haste = new EffectInstance(EffectIdMap::getInstance()->fromId(3),1200,2);                
                $p->getEffects()->add($force);
                $p->getEffects()->add($speed);
                $p->getEffects()->add($regen);
                $p->getEffects()->add($jump);      
                $p->getEffects()->add($haste);                  
                $p->sendPopup($this->getConfig()->get("stickmsgbedo"));
                $this->coldownb[$p->getName()] = time() + $this->getConfig()->get("cooldownbedo");
            }
        }
    }
    
        public function redbull(PlayerItemUseEvent $e){

        $p = $e->getPlayer();

        if ($p->getInventory()->getItemInHand()->getId() === VanillaItems::FEATHER()->getId()) {
            if(isset($this->coldownh[$p->getName()]) && $this->coldownh[$p->getName()] > time()){
                $e->cancel();
                $temps = $this->coldownh[$p->getName()] - time();
                $p->sendPopup(str_replace("{time}", "$temps", $this->getConfig()->get("cooldownmsgredbull")));
            }if (!$e->isCancelled()) {
                $ef = new EffectInstance(EffectIdMap::getInstance()->fromId(3),1200,2);
                $p->getEffects()->add($ef);
                $p->sendPopup($this->getConfig()->get("redbullmsg"));
                $this->coldownh[$p->getName()] = time() + $this->getConfig()->get("cooldownredbull");
                $p->getInventory()->removeItem(ItemFactory::getInstance()->get(288, 0, 1));
            }
        }
    }

    public function getConfig()
    {
        return new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
    }
}