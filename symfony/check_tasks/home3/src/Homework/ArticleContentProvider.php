<?php

namespace App\Homework;


class ArticleContentProvider implements ArticleContentProviderInterface
{
    private $text = [
        'Lorem ipsum **красная точка** dolor sit amet, consectetur adipiscing elit, sed
do eiusmod tempor incididunt [Сметанка](/) ut labore et dolore magna aliqua.
Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a
pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor
elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam
libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue
quisque egestas diam. **Красная точка** blandit turpis cursus in hac habitasse platea dictumst quisque.',
        '*Ullamcorper* malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque
diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue
mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae.
A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet
luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod
nisi porta lorem mollis aliquam ut porttitor leo.',
        '**Ullamcorper** dvsv proin libero nunc consequat interdum varius sit amet. Odio pellentesque
diam sdf dfvdfvvd sed egestas. Eget dfv lobortis mattis aliquam. Cursus vitae congue
mauris rhoncus vsv vel. Pretium viverra suspendisse potenti nullam ac tortor vitae.
A svsd sit amet porttitor dfvdfv dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet
luctus venesvsnatis svsd magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod
nisi porta lorem mollis sdsdv ut porttitor leo.',
        '[**UlLLAMCORPER**](/) dvsv proin [libero](/) nunc **consequat** interdum varius sit amet. Odio pellentesque
diam sdf dfvdfvvd sed egestas. Eget dfv lobortis mattis aliquam. Cursus vitae congue
mauris rhoncus vsv vel. Pretium viverra suspendisse potenti nullam ac tortor vitae.
A svsd sit amet porttitor dfvdfv dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet
luctus venesvsnatis svsd magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod
nisi porta lorem mollis sdsdv ut porttitor leo.',
        'Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis
rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus
egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed
augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat
maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor
neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo
sed egestas egestas. **Egestas** dui id ornare arcu odio ut.
',
    ];
    
    /**
     * @var bool
     */
    private $withBold;
    
    public function __construct($withBold)
    {
        $this->withBold = $withBold;
    }
    
    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        $resultText = '';
        while ($paragraphs > 0) {
            $resultText .= '   ' . $this->text[random_int(0, 4)] . PHP_EOL;
            $paragraphs--;
        }
        
        if ($word) {
            $textLenght = strlen($resultText);
    
            $word = $this->boldOrTtalics($word);
    
            while ($wordsCount > 0) {
                $resultText = substr_replace($resultText, $word, strpos($resultText, ' ', random_int(0, $textLenght)), 0);
                $wordsCount--;
            }
        }

        return $resultText;
    }
    
    protected function boldOrTtalics($word)
    {
        if ($this->withBold) {
            return ' **' . $word . '**';
        }
        
        return ' *' . $word . '*';
    }
}
