<?php

namespace App\Parsers;

use App\Crawlers\ClassListCrawler;

class ClassListParser
{
    public static function get(ClassListCrawler $crawler)
    {
        $html = $crawler->crawl();

        $doc = new \DOMDocument();
        $doc = $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xpath = new \DOMXPath($doc);

        $classHtml = $doc->query(
            "//*[@class='GridItem']|".
            "//*[@class='AlternatingItem']|".
            "//*[@class='GridRowSelected']"
        );

        $classes = [];
        foreach ($classHtml as $row) {
            $columns = $row->childNodes;
            $classes[] = (object) [
                'courseCode' => intval($columns[1]->firstChild->data),
                'name' => trim($columns[3]->firstChild->data),
                'practical_unit_count' => intval($columns[5]->firstChild->data),
                'theoretical_unit_count' => intval($columns[6]->firstChild->data),

                'teacherName' => trim($columns[4]->firstChild->data),

                'code' => trim($columns[2]->firstChild->data),
                'firstTime' => trim($columns[7]->firstChild->data),
                'secondTime' => trim($columns[8]->firstChild->data),
                'thirdTime' => trim($columns[9]->firstChild->data),
                'examTime' => trim($columns[10]->firstChild->data),
                'examDate' => trim($columns[12]->firstChild->data),
                'remainingCap' => intval($columns[11]->firstChild->data),
                'boysCount' => intval($columns[13]->firstChild->data),
                'girlsCount' => intval($columns[14]->firstChild->data),
                'allowedGender' => trim($columns[15]->firstChild->data),
                'status15' => trim($columns[16]->firstChild->data) === 'True',
                'status17' => trim($columns[18]->firstChild->data) === 'True',
                'place' => trim($columns[17]->firstChild->data),
                //.replace(/^\s+|\s+$/gm, '')
                'fromYear' => intval($columns[19]->firstChild->data),
                'toYear' => intval($columns[20]->firstChild->data),
                'field' => trim($columns[21]->firstChild->data),
            ];
        }
        return $classes;
    }
}
