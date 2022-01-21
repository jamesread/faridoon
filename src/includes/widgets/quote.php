<?php

$tpl->assign('quote', $quote);
$tpl->display('quote.tpl');

#' . $quote['id'] . '</a></strong> - <span class = "subtle">' . $quote['created'] .'</span>';
    

    /**
    if (!empty($quote['syntaxHighlighting'])) {
            echo '<pre class = "codeSnippit ' . $quote['syntaxHighlighting'] . '">';
                    foreach ($content as $line) {
                            echo $line['content'] . "\n";
                    }
            echo '</pre>';
    } else {
            echo '<p class = "quote">';
                    foreach ($content as $line) {
                            if ($line['content'] == "\r") {
                                    echo '<br /><br />'; 
                                    continue;
                            }

                            if (empty($line['username'])) {
                                    echo '<span class = "line">' . $line['content'] . '</span>';
                            } else {
span class = "line withUsername"><strong style = "color: ' . $line['usernameColor'] . '">' . $line['username'] . '</strong>: ' . $line['content'] . '</span>';
                            }
                    }
            echo '</p>';
    }
            **/
?>
