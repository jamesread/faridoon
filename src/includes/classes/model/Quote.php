<?php

class Quote
{
    public $id;
    public $usesSyntaxHighlighting;
    public $voteCount = 0;
    public $approved = true;
    public $created = 'unknown';

    private $content;

    public function unmarshalFromDatabase($dbquote)
    {
        $this->id = $dbquote['id'];
        $this->created = $dbquote['created'];
        $this->voteCount = $dbquote['voteCount'];
        $this->approved = $dbquote['approved'];
        $this->content = $dbquote['content'];
    }

    public function getContentForHtml()
    {
        $ret = $this->content;

        $ret = htmlspecialchars($ret);
        $ret = stripslashes($ret);
        $ret = self::explodeQuote($ret);
        $ret = self::findUsernames($ret);

        return $ret;
    }

    private static function explodeQuote($quoteContent)
    {
        $linesFixed = array();

        foreach (explode("\n", $quoteContent) as $line) {
            $lineX = array(
                'content' => $line,
                'username' => null,
                'bgColor' => null,
            );

            $linesFixed[] = $lineX;
        }

        return $linesFixed;
    }

    private static function findUsernames(array $quoteContent)
    {
        global $colors;
        global $usernameColors;

        reset($colors);
        $usernameColors = array();

        foreach ($quoteContent as &$line) {
            $regex = '#^[\]\[\(\)\:\d ]*<?[&+@~]{0,1}([\w\- ]+)[:>] (.*)#i';

            preg_match($regex, $line['content'], $matches);

            switch (count($matches)) {
            case 3: 
                $msg = str_replace('<br />', '', $matches[2]);
                $msg = trim($msg);

                if (empty($msg)) {
                    break;
                }

                $line['username'] = $matches[1];
                $line['usernameColor'] = getCol($line['username']);
                $line['content'] = htmlentities($matches[2]);

                break;
            default: 
                break;
            }

        }

        return $quoteContent;
    }
}

?>
