<?php


namespace GodzHard\RulesUI;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§cPlugin enabled!");
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        switch ($cmd->getName()) {
            case "rulesui":
                if ($sender instanceof Player) {
                    $this->openMyForm($sender);
                }
        }
        return true;
    }

    public function openMyForm($player) {
    	$title = $this->getConfig()->get("Title");
    	$description = $this->getConfig()->get("Description");
    	$button = $this->getConfig()->get("Button");
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                    break;
            }
        });
        $form->setTitle($title);
        $form->setContent($description);
        $form->addButton($button);
        $form->sendToPlayer($player);
        return $form;
        }
}