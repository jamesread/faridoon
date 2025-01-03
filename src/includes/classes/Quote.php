<?php

namespace faridoon;

class Quote
{
    public $id;
    public $usesSyntaxHighlighting;
    public $voteCount = 0;
    public $approved = true;
    public $created = 'unknown';
    public $lines = [];

    private $rawContent;

    private $colorIndex = 1;

    private $usernameColors = array();

    private function getUsernameColor($username)
    {
        if (isset($this->usernameColors[$username])) {
            return $this->usernameColors[$username];
        }

        $col = $this->colorIndex;

        $this->colorIndex++;

        $this->usernameColors[$username] = $col;

        return $col;
    }

    public function unmarshalFromDatabase($dbquote)
    {
        $this->id = $dbquote['id'];
        $this->created = $dbquote['created'];
        $this->voteCount = $dbquote['voteCount'];
        $this->approved = $dbquote['approved'];
        $this->rawContent = $dbquote['content'];

        $this->parse();
    }

    public function unmarshalFromText($text)
    {
        $this->id = 0;
        $this->voteCount = 0;
        $this->approved = true;
        $this->created = 'unknown';
        $this->rawContent = $text;

        $this->parse();
    }

    private function parse()
    {
        $c = $this->rawContent;
        $c = stripslashes($c);

        $this->explodeQuote($c);
        $this->findUsernames();
    }

    public function explodeQuote($quoteContent)
    {
        $this->lines = [];

        foreach (explode("\n", $quoteContent) as $line) {
            $lineX = array(
                'content' => $line,
                'username' => null,
                'bgColor' => null,
            );

            $this->lines[] = $lineX;
        }
    }

    private function findUsernames()
    {
        $this->colorIndex = 1;
        $this->usernameColors = [];

        foreach ($this->lines as &$line) {
            $regex = '#^[\]\[\(\)\:\d ]*<?[&+@~]{0,1}([\w\- ]+)[:>] (.*)#i';

            preg_match($regex, $line['content'], $matches);

            switch (count($matches)) {
                case 3:
                    $msg = str_replace('<br />', '', $matches[2]);
                    $msg = trim($msg);

                    if (empty($msg)) {
                        break;
                    }

                    $line['username'] = htmlspecialchars($matches[1]);
                    $line['usernameColor'] = $this->getUsernameColor($line['username']);
                    $line['content'] = htmlspecialchars($matches[2]);

                    break;
                default:
                    break;
            }
        }
    }
}
