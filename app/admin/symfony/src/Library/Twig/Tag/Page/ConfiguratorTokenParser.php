<?php
namespace Admin\Library\Twig\Tag\Page;

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

class ConfiguratorTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $parser = $this->parser;
        $stream = $parser->getStream();

        $value = $parser->getExpressionParser()->parseExpression();
        $stream->expect(Token::BLOCK_END_TYPE);

        return new ConfiguratorNode($value, $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'config_page';
    }
}
