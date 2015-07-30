<?php
/**
 * this client hit somes url with a spoofed referer
 *
 * This client should be triggered by cron, once triggered it connect to 
 * '$server_url' and receive a list of url and referer.
 * The script will hit each url with proper referer.
 * Once done, it contact the server again to confirm the process.
 * For confirmation purpose,  token is receive in step 1 and send back in
 * step 2.
 *
 * PHP version 5
 *
 * @category  UrlCrawler
 * @package   RefererSpoofer
 * @author    Julien J. Halle <julienhalle@heptacube.com>
 * @copyright Heptacube inc.
 * @version   10-11-2009
 *
 *
 */
// each client must have a unique client_id, it could be anything..
$client_id = 'first_client';
// where to refere for new links
$server_url = 'http://localhost';

// STEP 1 get links list
$datas = file_get_contents($server_url);
$datas = explode(' ',$datas);
$token = $datas[0];
unset($datas[0]);

// STEP 2 hit the urls
foreach($datas as $line){
    list($url,$referer) = explode(',',$line);
    if($url && $referer){
        $opts = array(
            'http'=>array(
                'header'=>array("Referer: $referer\r\n")
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context,-1,2);
    }
}

// STEP 3 report success
$opts = array(
    'http'=>array(
        'method'=>"POST",
        "Cookie: client=$client_id,\r\n" .
        "token=$token\r\n"
    )
);
$context = stream_context_create($opts);
file_get_contents("$server_url?client=$client_id&token=$token", false, $context);
