<?php
namespace App\Crawlers;

use GuzzleHttp\Client as Http;
use GuzzleHttp\Cookie\CookieJar;

class ClassListCrawler
{
    public static $eduGroups = [
        1 => 'فني و مهندسي',
        2 => 'حقوق- علوم سياسي',
        3 => 'ادبيات فارسي و زبان هاي خارجي',
        4 => 'تحصيلات تکميلي',
        5 => 'مديريت',
        7 => 'صنايع',
        8 => 'تربيت بدني و علوم ورزشي',
        9 => 'روانشناسي و علوم تربيتي',
        10 => 'علوم پايه',
        11 => 'هنر و معماري',
        12 => 'مهندسي شيمي و پليمر',
        13 => 'اقتصاد و حسابداري',
        14 => 'مهندسي برق',
    ];
    protected $targetPage = '/pages/frm_viewofferd.aspx';

    public function crawl(int $eduGroup)
    {
        $client = new Http([
            'base_uri' => 'http://enroll.azad.ac.ir',
            'cookies'  => $this->getCookieJar(),
            'headers'  => $this->getHeaders()
        ]);

        $response = $client->post($this->targetPage, [
            'form_params' => [
                '__EVENTTARGET' => 'Btn_Search',
                '__VIEWSTATE' => file_get_contents(
                    app_path('Crawlers/data/classlist.viewstate.param')
                )/**/,
                '__EVENTVALIDATION' => file_get_contents(
                    app_path('Crawlers/data/classlist.eventvalidation.param')
                )/**/,
                'Txt_Inst_Name' => '%',
                'DropDownList1' => $eduGroup,
                /*'Txt_Crs_Code' => '',
                'Txt_Crs_Name' => '',
                'MHG_ClientGrid1_RowSelIndex' => '-1',*/
            ]
        ]);

        $html = (string) $response->getBody();
        $html = str_replace(['align="left"', 'align="right"'], '', $html);

        // return $html;

        $doc = new \DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $doc = new \DOMXPath($doc);

        $classHtml = $doc->query(
            "//*[@class='GridItem']|".
            "//*[@class='AlternatingItem']|".
            "//*[@class='GridRowSelected']"
        );

        $classes = [];
        foreach ($classHtml as $row) {
            $columns = $row->childNodes;
            $classes[] = (object) [
                'courseCode' => trim($columns[1]->firstChild->data),
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

    protected function getCookieJar()
    {
        return (new CookieJar)->fromArray(
            [
                '__utma' => '247261652.1322159996.1512635778.1512635778.1512635778.1',
                '_ga' => 'GA1.3.1322159996.1512635778',
                'ASP.NET_SessionId' => 'fekua445y3jklp451l2pkm55',
            ],
            'enroll.azad.ac.ir'
        );
    }

    protected function getHeaders()
    {
        return [
            'Referer' => 'http://enroll.azad.ac.ir/pages/frm_viewofferd.aspx',
            'Origin' => 'http://enroll.azad.ac.ir',
            'Host' => 'enroll.azad.ac.ir',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Connection' => 'keep-alive',
            'DNT' => '1',
            'Accept-Encoding' => 'gzip, deflate',
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:70.0) Gecko/20100101 Firefox/70.0',
            'Upgrade-Insecure-Requests' => '1',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'no-cache',
            'Accept-Language' => 'en-US,en;q=0.5',
        ];
    }
}
