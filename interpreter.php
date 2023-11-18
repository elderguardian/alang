<?php

class Interpreter
{
    function resolveBinarySyntaxSugar(string $code): string
    {
        $pattern = '/([(\[])(.*?)[)\]]/s'; // Detect everything in round and square brackets
        return preg_replace_callback($pattern, function($matches) {
            $bracketType = $matches[1];
            $stringWithoutBrackets = $matches[2];

            $parsedBinary = str_replace('A', '1', $stringWithoutBrackets);
            $parsedBinary = str_replace('a', '0', $parsedBinary);

            $decimalValue = bindec($parsedBinary);
            $wasRoundBracket = ($bracketType === '(');
            $character = $wasRoundBracket ? 'a' : 'A';

            return str_repeat($character, $decimalValue);
        }, $code);
    }

    function iterateAndSolve(string $code): void {
        $numberToAlphabet = array_combine(range(1, 26), range('A', 'Z'));
        $numberToAlphabetSmall = array_combine(range(1, 26), range('a', 'z'));
        $values = [];
        $currentPos = 0;
        $output = "";

        foreach (mb_str_split($code, 1, 'UTF-8') as $character) {
            switch ($character) {
                case 'ä': $currentPos += 1; break;
                case 'Ä': $currentPos -= 1; break;
                case '.': $output .= $numberToAlphabet[$values[$currentPos]]; break;
                case ',': $output .= $numberToAlphabetSmall[$values[$currentPos]]; break;
                case ':': $output .= $values[$currentPos]; break;
                case 'a': $values[$currentPos] = ($values[$currentPos] ?? 0) + 1; break;
                case 'A': $values[$currentPos] = ($values[$currentPos] ?? 0) - 1; break;
            }
        }

        echo $output;

    }

    function execute(string $code): void
    {
        $removedSyntaxSugar = $this->resolveBinarySyntaxSugar($code);
        $this->iterateAndSolve($removedSyntaxSugar);
    }
}

if ($argc < 2) {
    die("Usage: <file_path>\n");
}

try {
    $filePath = $argv[1];
    $content = file_get_contents($filePath);
    $content = mb_convert_encoding($content, 'UTF-8', 'auto');
    $compiler = new Interpreter();

    $compiler->execute($content);
    echo "\n";
} catch (Exception $e) {
    echo "Syntax Error";
}
