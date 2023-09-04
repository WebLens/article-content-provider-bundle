<?php

namespace CatCasCarSkillboxSymfony\ArticleContentProviderBundle;

class MarkdownWordDecorator implements WordDecoratorInterface
{
    public function decorator(string $word, bool $isBold = true): string
    {
        if($isBold){
            $word = "**" . $word . '**';
        }else{
            $word = "_" . $word . '_';
        }
        return $word;
    }
}