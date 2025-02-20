<?php

use PHPUnit\Framework\TestCase;

class TestHighlightUsernames extends TestCase {
    public function testIrcModes()
    {
        $text = <<<EOQ
james: hi
EOQ;

        $quote = new faridoon\Quote();
        $quote->unmarshalFromText($text);

        $this->assertEquals(count($quote->lines), 1);
        $this->assertEquals($quote->lines[0]['username'], 'james');
    }

    public function testUsernamesInAngularBrackets()
    {
        $text = <<<EOQ
<James> hi
EOQ;

        $quote = new faridoon\Quote();
        $quote->unmarshalFromText($text);

        $this->assertEquals(count($quote->lines), 1);
        $this->assertEquals($quote->lines[0]['username'], 'James');
    }

    public function testBashHunter2() {
        $text = <<<EOQ
<Cthon98> hey, if you type in your pw, it will show as stars
<Cthon98> ********* see!
<AzureDiamond> hunter2
<AzureDiamond> doesnt look like stars to me
<Cthon98> <AzureDiamond> *******
<Cthon98> thats what I see
<AzureDiamond> oh, really?
<Cthon98> Absolutely
<AzureDiamond> you can go hunter2 my hunter2-ing hunter2
<AzureDiamond> haha, does that look funny to you?
<Cthon98> lol, yes. See, when YOU type hunter2, it shows to us
as *******
<AzureDiamond> thats neat, I didnt know IRC did that
<Cthon98> yep, no matter how many times you type hunter2, it
will show to us as *******
<AzureDiamond> awesome!
<AzureDiamond> wait, how do you know my pw?
<Cthon98> er, I just copy pasted YOUR ******'s and it appears
to YOU as hunter2 cause its your pw
<AzureDiamond> oh, ok.
EOQ;

        $quote = new faridoon\Quote();
        $quote->unmarshalFromText($text);

        $this->assertEquals(count($quote->lines), 20);
        $this->assertEquals($quote->lines[0]['username'], 'Cthon98');
        $this->assertEquals($quote->lines[2]['username'], 'AzureDiamond');
    }
}
