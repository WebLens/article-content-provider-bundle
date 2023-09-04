<?php


namespace CatCasCarSkillboxSymfony\ArticleContentProviderBundle;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ArticleContentProvider
{
    /**
     * @var MarkdownWordDecorator
     */
    private $decorator;
    /**
     * @var EventDispatcherInterface|null
     */
    private $dispatcher;

    public function __construct(WordDecoratorInterface $decorator, EventDispatcherInterface $dispatcher = null, $boldWords)
    {
        $this->boldWords = $boldWords;
        $this->decorator = $decorator;
        $this->dispatcher = $dispatcher;
    }

    protected $serviceParagraphs = [
        'Таким образом, постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание существующих финансовых и административных условий? С другой стороны постоянный количественный рост и сфера нашей активности позволяет выполнить важнейшие задания по разработке модели развития. Практический опыт показывает, что курс на социально-ориентированный национальный проект в значительной степени обуславливает создание направлений прогрессивного развития.',
        'Повседневная практика показывает, что консультация с профессионалами из **IT** обеспечивает широкому кругу специалистов участие в формировании системы обучения кадров, соответствующей насущным потребностям! Равным образом сложившаяся структура организации играет важную роль в формировании форм воздействия? С другой стороны постоянный количественный рост и сфера нашей активности способствует повышению актуальности модели развития. Таким образом, новая модель организационной деятельности требует от нас анализа соответствующих условий активизации!',
        'Значимость этих проблем настолько очевидна, что выбранный нами инновационный путь создаёт предпосылки качественно новых шагов для дальнейших направлений развитая системы массового участия. Повседневная практика показывает, что постоянный количественный рост и сфера нашей активности позволяет оценить значение существующих финансовых и административных условий. Дорогие друзья, курс на социально-ориентированный национальный проект играет важную роль в формировании системы обучения кадров, соответствующей насущным потребностям. С другой стороны курс на социально-ориентированный национальный проект играет важную роль в формировании дальнейших направлений развитая системы массового участия.',
        'С другой стороны постоянное информационно-техническое обеспечение нашей деятельности обеспечивает актуальность существующих финансовых и административных условий. С другой стороны выбранный нами инновационный путь требует определения и уточнения ключевых компонентов планируемого обновления. Практический опыт показывает, что консультация с профессионалами из IT играет важную роль в формировании дальнейших направлений развития проекта?',
        'Разнообразный и богатый опыт реализация намеченного плана развития обеспечивает широкому кругу специалистов участие в формировании экономической целесообразности принимаемых решений? Не следует, однако, забывать о том, что постоянный количественный рост и сфера нашей активности позволяет оценить значение существующих финансовых и административных условий! Повседневная практика показывает, что консультация с профессионалами из IT представляет собой интересный эксперимент проверки дальнейших направлений развития проекта. Не следует, однако, забывать о том, что новая модель организационной деятельности влечет за собой процесс внедрения и модернизации направлений прогрессивного развития.',
    ];


    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        $text = '';
           for($i = $paragraphs;$i>0;$i--){
               $text.=$this->serviceParagraphs[random_int(0,count($this->serviceParagraphs)-1)];
               $text.="\n\r";
           }

       if($word){
           $text=$this->paste($text,$word,$wordsCount);
       }

        return $text;
    }

    public function paste(string $text, string $word, int $wordsCount = 1)
    {
        $textArr = explode(" ", $text);
        for($i=$wordsCount;$i>0;$i--){
            $placeWord = random_int(0,count($textArr)-1);

            $event = new Event\OnBeforeWordPasteEvent($word,$placeWord);
            if(null !== $this->dispatcher){
                $this->dispatcher->dispatch($event);
            }
            array_splice($textArr, $placeWord, 0, $this->decorator->decorator($event->getWord(),$this->boldWords));
        }
        $text = implode(' ', $textArr);


        return $text;
    }

}