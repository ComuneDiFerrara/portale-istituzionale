<?php

/*
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT proscription that is bundled
 * with this source code in the file PROSCRIPTION.
 */

namespace PhpCsFixer\Fixer\PhpUnit;

use PhpCsFixer\Fixer\AbstractPhpUnitFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Analyzer\FunctionsAnalyzer;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

/**
 */
final class PhpUnitMockShortWillReturnFixer extends AbstractPhpUnitFixer
{
    /**
     * @internal
     */
    const RETURN_METHODS_MAP = [
        'returnargument' => 'willReturnArgument',
        'returncallback' => 'willReturnCallback',
        'returnself' => 'willReturnSelf',
        'returnvalue' => 'willReturn',
        'returnvaluemap' => 'willReturnMap',
    ];

    /**
     * {@inheritdoc}
     */
    public function getDefinition()
    {
        return new FixerDefinition(
            'Usage of PHPUnit\'s mock e.g. `->will($this->returnValue(..))` must be replaced by its shorter equivalent such as `->willReturn(...)`.',
            [
                new CodeSample('<?php
final class MyTest extends \PHPUnit_Framework_TestCase
{
    public function testSomeTest()
    {
        $someMock = $this->createMock(Some::class);
        $someMock->method("some")->will($this->returnSelf());
        $someMock->method("some")->will($this->returnValue("example"));
        $someMock->method("some")->will($this->returnArgument(2));
        $someMock->method("some")->will($this->returnCallback("str_rot13"));
        $someMock->method("some")->will($this->returnValueMap(["a","b","c"]));
    }
}
'),
            ],
            null,
            'Risky when PHPUnit classes are overridden or not accessible, or when project has PHPUnit incompatibilities.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isRisky()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function applyPhpUnitClassFix(Tokens $tokens, $startIndex, $endIndex)
    {
        $functionsAnalyzer = new FunctionsAnalyzer();

        for ($index = $startIndex; $index < $endIndex; ++$index) {
            if (!$tokens[$index]->isObjectOperator()) {
                continue;
            }

            $functionToReplaceIndex = $tokens->getNextMeaningfulToken($index);
            if (!$tokens[$functionToReplaceIndex]->equals([T_STRING, 'will'], false)) {
                continue;
            }

            $functionToReplaceOpeningBraceIndex = $tokens->getNextMeaningfulToken($functionToReplaceIndex);
            if (!$tokens[$functionToReplaceOpeningBraceIndex]->equals('(')) {
                continue;
            }

            $classReferenceIndex = $tokens->getNextMeaningfulToken($functionToReplaceOpeningBraceIndex);
            $objectOperatorIndex = $tokens->getNextMeaningfulToken($classReferenceIndex);
            $functionToRemoveIndex = $tokens->getNextMeaningfulToken($objectOperatorIndex);

            if (!$functionsAnalyzer->isTheSameClassCall($tokens, $functionToRemoveIndex)) {
                continue;
            }

            if (!\array_key_exists(strtolower($tokens[$functionToRemoveIndex]->getContent()), self::RETURN_METHODS_MAP)) {
                continue;
            }

            $openingBraceIndex = $tokens->getNextMeaningfulToken($functionToRemoveIndex);
            if (!$tokens[$openingBraceIndex]->equals('(')) {
                continue;
            }

            $closingBraceIndex = $tokens->findBlockEnd(Tokens::BLOCK_TYPE_PARENTHESIS_BRACE, $openingBraceIndex);

            $tokens[$functionToReplaceIndex] = new Token([T_STRING, self::RETURN_METHODS_MAP[strtolower($tokens[$functionToRemoveIndex]->getContent())]]);
            $tokens->clearTokenAndMergeSurroundingWhitespace($classReferenceIndex);
            $tokens->clearTokenAndMergeSurroundingWhitespace($objectOperatorIndex);
            $tokens->clearTokenAndMergeSurroundingWhitespace($functionToRemoveIndex);
            $tokens->clearTokenAndMergeSurroundingWhitespace($openingBraceIndex);
            $tokens->clearTokenAndMergeSurroundingWhitespace($closingBraceIndex);
        }
    }
}
