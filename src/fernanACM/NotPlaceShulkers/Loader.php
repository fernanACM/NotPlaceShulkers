<?php

namespace fernanACM\NotPlaceShulkers;

use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\inventory\CreativeInventory;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Loader extends PluginBase implements Listener{

    /**
     * @return void
     */
    public function onEnable(): void{
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
        /** @var CreativeInventory $creative */
        $creative = CreativeInventory::getInstance();
        $creative->remove(VanillaBlocks::SHULKER_BOX()->asItem());
        $creative->remove(VanillaBlocks::DYED_SHULKER_BOX()->asItem());
    }

    /**
     * @param BlockPlaceEvent $event
     * @return void
     */
    public function onPlace(BlockPlaceEvent $event): void{
        $transaction = $event->getTransaction()->getBlocks();
        foreach($transaction as [$x, $y, $z, $block]){
            if($block->getTypeId() === VanillaBlocks::SHULKER_BOX()->getTypeId()){
                $event->cancel();
            }
            if($block->getTypeId() === VanillaBlocks::DYED_SHULKER_BOX()->getTypeId()){
                $event->cancel();
            }
        }
    }

    /**
     * @param PlayerInteractEvent $event
     * @return void
     */
    public function onInteract(PlayerInteractEvent $event): void{
        $block = $event->getBlock();
        if($block->getTypeId() === VanillaBlocks::SHULKER_BOX()->getTypeId()){
                $event->cancel();
        }
        if($block->getTypeId() === VanillaBlocks::DYED_SHULKER_BOX()->getTypeId()){
            $event->cancel();
        }
    }

    /**
     * @param PlayerDropItemEvent $event
     * @return void
     */
    public function onDrop(PlayerDropItemEvent $event): void{
        $block = $event->getItem();
        if($block->getTypeId() === VanillaBlocks::SHULKER_BOX()->asItem()->getTypeId()){
            $event->cancel();
        }
        if($block->getTypeId() === VanillaBlocks::DYED_SHULKER_BOX()->asItem()->getTypeId()){
            $event->cancel();
        }
    }
}