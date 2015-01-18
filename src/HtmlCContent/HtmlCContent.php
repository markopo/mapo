<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 21/12/2014
 * Time: 18:42
 */

/**
 * Class HtmlCContent
 */
class HtmlCContent {

    CONST TYPEPAGE = "page";
    CONST TYPEBLOG = "blog";

    public static function GetContentTypes() {
        return array(HtmlCContent::TYPEBLOG, HtmlCContent::TYPEPAGE);
    }

    /**
     * @param $res
     * @return string
     */
    public static function HtmlTable($res){
        $html = "";
        if(count($res) > 0) {
            $html .= "<table class='ccontent-table'>";
            $html .= "<thead><tr>";
            $html .= "<th>id</th>";
            $html .= "<th>type</th>";
            $html .= "<th>title</th>";
            $html .= "<th>published</th>";
            $html .= "<th>updated</th>";
            $html .= "<th>deleted</th>";
            $html .= "<th></th>";
            $html .= "<th></th>";
            $html .= "</tr></thead>";

            $html .= "<tbody>";

            foreach ($res as $r) {
                $html .= "<tr>";
                $html .= "<td><span>{$r->id}</span></td>";
                $html .= "<td><span>{$r->type}</span></td>";
                $html .= "<td><span>{$r->title}</span></td>";
                $html .= "<td><span>".DateFormat::Ymd_Hi($r->published)."</span></td>";
                $html .= "<td><span>".DateFormat::Ymd_Hi($r->updated)."</span></td>";
                $html .= "<td><span>".DateFormat::Ymd_Hi($r->deleted)."</span></td>";
                $html .= "<td><a class='edit-content-link' href='?editcontent=".$r->id."'>edit</a></td>";
                $html .= "<td><a class='delete-content-link' href='?deletecontent=".$r->id."'>delete</a></td>";
                $html .= "</tr>";
            }

            $html .= "</tbody>";

            $html .= "</table>";
        }
        return $html;

    }



    /**
     * @param $content
     * @return string
     */
    public static function EditContent($content){
        $html = FormHelper::FormStart();
        $html .= "<table class='content-table' >";
        $html .= TableHelper::TableRowInputHidden("id", $content->id);
        $html .= TableHelper::TableRowInputText("title", $content->title);
        $html .= TableHelper::TableRowNormalData("slug", $content->slug);
        $html .= TableHelper::TableRowRadio(CTextFilter::getFilters(), "filter", $content->filter);
        $html .= TableHelper::TableRowSelect(HtmlCContent::GetContentTypes(), "type", $content->type);
        $html .= TableHelper::TableRowTextArea("data", $content->data);
        $html .= TableHelper::TableRowCheckBox("deleted", $content->deleted);
        $html .= TableHelper::TableRowSubmit("editcontent_save", "spara");
        $html .= "</table>";
        $html .= FormHelper::FormEnd();
        return $html;
    }

    /**
     * @param $content
     * @return string
     */
    public static function DeleteContent($content){
        $html = FormHelper::FormStart();
        $html .= "<h3>Vill du verkligen ta bort den här?</h3>";
        $html .= "<table class='content-table readonly' >";
        $html .= TableHelper::TableRowInputHidden("id", $content->id);
        $html .= TableHelper::TableRowNormalData("title", $content->title);
        $html .= TableHelper::TableRowNormalData("slug", $content->slug);
        $html .= TableHelper::TableRowNormalData("filter", $content->filter);
        $html .= TableHelper::TableRowNormalData("type", $content->type);
        $html .= TableHelper::TableRowParagraph("data", $content->data);
        $html .= TableHelper::TableRowSubmit("deletecontent_save", "spara");
        $html .= "</table>";
        $html .= FormHelper::FormEnd();
        return $html;
    }

    /**
     * @return string
     */
    public static function AddContent() {
        $html = FormHelper::FormStart();
        $html .= "<table class='content-table' >";
        $html .= TableHelper::TableRowInputText("title", "");
        $html .= TableHelper::TableRowRadio(CTextFilter::getFilters(), "filter", "");
        $html .= TableHelper::TableRowSelect(HtmlCContent::GetContentTypes(), "type", "");
        $html .= TableHelper::TableRowTextArea("data", "");
        $html .= TableHelper::TableRowSubmit("addcontent_save", "spara");
        $html .= "</table>";
        $html .= FormHelper::FormEnd();
        return $html;
    }
}