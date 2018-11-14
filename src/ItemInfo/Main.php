<?php

namespace ItemInfo;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    private $EnchantNames = [
        0 => "PROTECTION",
        1 => "FIRE_PROTECTION",
        2 => "FEATHER_FALLING",
        3 => "BLAST_PROTECTION",
        4 => "PROJECTILE_PROTECTION",
        5 => "THORNS",
        6 => "RESPIRATION",
        7 => "DEPTH_STRIDER",
        8 => "AQUA_AFFINITY",
        9 => "SHARPNESS",
        10 => "SMITE",
        11 => "BANE_OF_ARTHROPODS",
        12 => "KNOCKBACK",
        13 => "FIRE_ASPECT",
        14 => "LOOTING",
        15 => "EFFICIENCY",
        16 => "SILK_TOUCH",
        17 => "UNBREAKING",
        18 => "FORTUNE",
        19 => "POWER",
        20 => "PUNCH",
        21 => "FLAME",
        22 => "INFINITY",
        23 => "LUCK_OF_THE_SEA",
        24 => "LURE",
        25 => "FROST_WALKER",
        26 => "MENDING",
    ];

    public function onEnable()
    {

    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "iteminfo":
                if (!$sender instanceof Player) {
                    $sender->sendMessage("You can only use this command in game!");
                    return false;
                }
                if (!$sender->hasPermission("iteminfo.use")) {
                    $sender->sendMessage("You don't have permission to use this command!");
                    return false;
                }

                $item = $sender->getInventory()->getItemInHand();
                $id = $item->getId();
                $name = $item->getName();
                $sender->sendMessage("Name: " . $name, "ID: " . $id, "Enchantment:");
                if ($item->hasEnchantments() == true) {
                    foreach ($item->getEnchantments() as $i) {
                        $iid = $i->getId();
                        $ilevel = $i->getLevel();
                        $enchantments = $this->EnchantNames[$iid];
                        $sender->sendMessage("- " . $enchantments . " " . $ilevel);
                    }
                } else {
                    $sender->sendMessage("None");
                }
                break;
        }
        return true;
    }
}