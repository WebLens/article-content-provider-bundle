<?php

namespace CatCasCarSkillboxSymfony\ArticleContentProviderBundle\Event;


use Symfony\Contracts\EventDispatcher\Event;

class OnBeforeWordPasteEvent extends Event
{

    /**
     * @var string
     */
    private $word;
    /**
     * @var int
     */
    private $position;

    public function __construct(string $word, int $position)
    {
        $this->word = $word;
        $this->position = $position;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setWord(string $word): void
    {
        $this->word = $word;
    }

}