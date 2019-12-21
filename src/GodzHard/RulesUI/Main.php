<?php


namespace GodzHard\RulesUI;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public $myConfig;

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§cPlugin enabled!");
        $this->myConfig = (new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
            "UI" => [
                "Title" => "§cRulesUI",
                "Description" => "§aInsert your rules!",
                "Button" => "Close",
            ],
        )));
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
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $config = $this->myConfig->getAll();
        $title = $config["UI"] ["Title"];
        $description = $config["UI"] ["Description"];
        $button = $config["UI"] ["Button"];
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