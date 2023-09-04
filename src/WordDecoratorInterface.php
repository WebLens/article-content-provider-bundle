<?php

namespace CatCasCarSkillboxSymfony\ArticleContentProviderBundle;

interface WordDecoratorInterface
{
    public function decorator(string $word,bool $isBold=true):string;
}