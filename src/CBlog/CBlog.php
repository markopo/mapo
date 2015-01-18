<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/12/2014
 * Time: 20:23
 */

/**
 * Class CBlog
 */
class CBlog {



    private $cTextFilter;

    public function __construct(){

        $this->cTextFilter = new CTextFilter();

    }

    /**
     * @param $filter
     * @param $data
     * @return mixed
     */
    private function MakeFilter($filter, $data){

        $filters = explode(",", $filter);

        foreach($filters as $f){
            $data = $this->cTextFilter->Filter($f, $data);
        }
        return $data;
    }

    /**
     * @param $pages
     * @return string
     */
    public function ShowAllBlogs($pages){
        $html = "";

        if(count($pages) > 0){

            foreach($pages as $p){

                $published = date("Y-m-d",strtotime($p->published));
                $html .= "<div class='blogpost'>
                         <h3><a href='blog.php?slug={$p->slug}'>{$p->title}</a></h3>
                         <p>Datum: <i>{$published}</i></p>
                        </div>";
            }
        }

        return $html;
    }

    /**
     * @param $page
     * @return string
     */
    public function ShowSlugBlog($page) {

        $data = $this->MakeFilter($page->filter, $page->data);
        return "<div  class='blogpost' >
                 <h3><a href='blog.php?slug={$page->slug}'>{$page->title}</a></h3>
                 <div>{$data}</div>
                </div>";

    }

}