<?php
    require_once '../images/resources/CouchInnLogoFullBase64.php';

    function body($emailPreHeader, $emailTitle, $emailMsg, $emailButtonUrl, $emailButtonName) {

        return ('
            <div class="email-background" style="background-color: #eee;padding: 10px;">

                <div class="pre-header" style="color: #eee;font-size: 1px;">
                    '.$emailPreHeader.'
                </div>

                <div class="email-container" style="max-width: 500px;margin: 0 auto;font-family: sans-serif;overflow: hidden;">

                    <h1 style="text-align: center;color: #6D6D6D;">'.$emailTitle.'</h1>
                    <img src="'.emailImg().'" alt="CouchInn.com" style="max-width: 100%;">
                    <p style="margin: 20px;text-align: center;font-size: 18px;line-height: 1.5;color: #6D6D6D;font-weight: bold;">'.$emailMsg.'</p>
                    <div class="email-link" style="margin: 20px;text-align: center;">
                        <a href="'.$emailButtonUrl.'" style="text-decoration: none;display: inline-block;background: #96AC3C;color: #eee;font-weight: bold;padding: 15px 20px;border-radius: 5px;">'.$emailButtonName.'</a>
                    </div>

                </div>

            </div>
        ');

    }

?>
