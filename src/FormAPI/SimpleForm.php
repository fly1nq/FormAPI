<?php

declare(strict_types=1);

namespace FormAPI;

use pocketmine\form\FormValidationException;

class SimpleForm extends Form
{
    public const IMAGE_TYPE_PATH = 0;
    public const IMAGE_TYPE_URL = 1;

    private array $labelMap = [];

    public function __construct(?callable $callable)
    {
        parent::__construct($callable);
        
        $this->data['type'] = 'form';
        $this->data['title'] = '';
        $this->data['content'] = '';
        $this->data['buttons'] = [];
    }

    public function processData(mixed &$data): void
    {
        if ($data !== null) {
            if (!is_int($data)) {
                throw new FormValidationException('Expected an integer response, got ' . gettype($data));
            }
            
            $buttonsCount = count($this->data['buttons']);
            
            if ($data >= $buttonsCount || $data < 0) {
                throw new FormValidationException("Button {$data} does not exist");
            }
            
            $data = $this->labelMap[$data] ?? null;
        }
    }

    public function setTitle(string $title): void
    {
        $this->data['title'] = $title;
    }

    public function getTitle(): string
    {
        return $this->data['title'];
    }
    
    public function setContent(string $content): void
    {
        $this->data['content'] = $content;
    }

    public function getContent(): string
    {
        return $this->data['content'];
    }

    public function addButton(
        string $text,
        int $imageType = -1,
        string $imagePath = '',
        ?string $label = null
    ): void
    {
        $content = ['text' => $text];
        
        if ($imageType !== -1) {
            $content['image'] = [
                'type' => $imageType === self::IMAGE_TYPE_PATH ? 'path' : 'url',
                'data' => $imagePath
            ];
        }
        
        $this->data['buttons'][] = $content;
        $this->labelMap[] = $label ?? count($this->labelMap);
    }
}
