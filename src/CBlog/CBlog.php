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
     * @param $pages
     * @return string
     */
    public function ShowAllBlogs($pages){
        $html = "";

        if(count($pages) > 0){

            foreach($pages as $p){
                $data = $this->cTextFilter->Filter($p->filter, $p->data);
                $html .= "<div>
                         <h3><a href='blog.php?slug={$p->slug}'>{$p->title}</a></h3>
                         <div>{$data}</div>
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

        $data = $this->cTextFilter->Filter($page->filter, $page->data);
        return "<div>
                 <h3><a href='blog.php?slug={$page->slug}'>{$page->title}</a></h3>
                 <div>{$data}</div>
                </div>";

    }

}