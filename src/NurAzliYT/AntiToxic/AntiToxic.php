<?php

namespace NurAzliYT\AntiToxic;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class AntiToxic extends PluginBase implements Listener {

    /** @var Config */
    private $config;

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerChat(PlayerChatEvent $event) {
        $message = $event->getMessage();
        $lowercaseMessage = strtolower($message);

        $blockedWords = $this->config->get("blocked-words", []);

        foreach ($blockedWords as $blockedWord) {
            if (strpos($lowercaseMessage, $blockedWord) !== false) {
                $event->getPlayer()->sendMessage("§¢§cPesan yang Anda kirimkan tidak diperbolehkan.");
                $event->setMessage(""); // Mengganti pesan yang akan dikirim menjadi string kosong
                break;
            }
        }
    }
}
