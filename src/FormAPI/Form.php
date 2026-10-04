<?php

declare(strict_types=1);

namespace FormAPI;

use pocketmine\form\Form as IForm;
use pocketmine\player\Player;

abstract class Form implements IForm
{
    protected array $data = [];

    public function __construct(private ?callable $callable)
    {
    }

    public function setCallable(?callable $callable): void
    {
        $this->callable = $callable;
    }

    public function getCallable(): ?callable
    {
        return $this->callable;
    }

    public function handleResponse(Player $player, mixed $data): void
    {
        $this->processData($data);
        $callable = $this->getCallable();
        
        if ($callable !== null) {
            $callable($player, $data);
        }
    }

    abstract protected function processData(mixed &$data): void;

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
