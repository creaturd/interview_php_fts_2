<?php
require_once "DBConnect.php";

$db = new MySQLConnect();

$db->connect('mysql-rfam-public.ebi.ac.uk', '4497', 'Rfam', 'rfamro', '');

$firstQuery = $db->query(
    "SELECT DISTINCT 
    f.author, t.species FROM family f 
    LEFT JOIN taxonomy t ON f.auto_wiki = t.ncbi_id 
    WHERE f.author LIKE '%Petrov%' COLLATE latin1_bin 
    OR f.author LIKE '%Chen%' COLLATE latin1_bin 
    ORDER BY f.author ASC;");
echo $firstQuery;

$secondQuery = $db->query(
    "SELECT COUNT(upid) as count 
    FROM genome 
    WHERE description REGEXP '2019-nCov|SARS-CoV-2|MN3-MDH3|Wuhan'");
echo $secondQuery;