<?php
/**
 * this server dispatch urls and referers
 *
 * when request is GET, it give a short list of urls
 * when request is POST, it mark the crawl as confirmed
 *
 * PHP version 5
 *
 * @category  UrlCrawler
 * @package   RefererSpoofer
 * @author    Julien J. Halle <julienhalle@heptacube.com>
 * @copyright Heptacube inc.
 * @version   10-11-2009
 *
 */
$user = 'root';
$pass = 'root';
$dburl = 'mysql:dbname=referer;host=localhost';
$db = new PDO($dburl,$user,$pass);
$client = $_REQUEST['client'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $token = $_REQUEST['token'];
    $update = $db->prepare('UPDATE crawls SET `confirmed` = 1, `updated` = CURRENT_TIMESTAMP WHERE token = :token');
    $update->bindParam(':token',$token);
    $update->execute();
} else {
    $query = $db->prepare('
        SELECT * 
        FROM urls
        JOIN referers
        LEFT JOIN crawls ON (urls.id = crawls.fk_url_id AND referers.id = crawls.fk_referer_id)
        GROUP BY urls.id, referers.id
        ORDER BY COUNT(crawls.id) asc, crawls.confirmed asc
        LIMIT 4');
    $query->execute();
    $rows = $query->fetchALL();
    $token = time();
    $insert = $db->prepare("
        INSERT INTO 
        `referer`.`crawls` (`id`, `fk_url_id`, `fk_referer_id`, `token`, `confirmed`, `created`, `updated`) 
        VALUES (NULL, :url_id, :referer_id, :token, '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    echo $token;
    foreach($rows as $row){
        echo ' '.$row['url'].','.$row['referer'];
        $insert->bindParam(':url_id',$row[0]);
        $insert->bindParam(':referer_id',$row[2]);
        $insert->bindParam(':token',$token);
        $insert->execute();
    }
}
?>
