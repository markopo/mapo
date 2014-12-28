<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 26/12/2014
 * Time: 14:48
 */

/**
 * Class TableHelper
 */
class TableHelper {

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowInputText($name, $value){
        $html = "<tr>";
        $html .= "<td><label for='{$name}'>{$name}</label></td>";
        $html .= "<td><input type='text' id='{$name}' name='{$name}' value='{$value}'></td>";
        $html .= "</tr>";
        return $html;
    }

    /**
     * @param $values
     * @param $name
     * @param string $selected
     * @return string
     */
    public static function TableRowSelect($values, $name, $selected = ""){
        $html = "<tr>";
        $html .= "<td><label for='{$name}'>{$name}</label></td>";
        $html .= "<td> <select id='{$name}' name='{$name}' >";

        foreach($values as $v){
            $selectedVal = $v == $selected ? "selected" : "";
            $html .= "<option {$selectedVal} value='{$v}'>{$v}</option>";
        }

        $html .= "</select></td>";
        $html .= "</tr>";
        return $html;
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowInputHidden($name, $value){
        $html = "<tr>";
        $html .= "<td></td><td><input type='hidden' id='{$name}' name='{$name}' value='{$value}'></td>";
        $html .= "</tr>";
        return $html;
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowTextArea($name, $value){
        $html = "<tr>";
        $html .= "<td></td><td class='table-cell-textarea'><textarea id='{$name}' name='{$name}'>{$value}</textarea></td>";
        $html .= "</tr>";
        return $html;
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowCheckBox($name, $value){
        $checked = $value != null ? "checked" : "";
        return "<tr>
                <td><label for='{$name}'>{$name}</label></td>
                <td><input type='checkbox' id='{$name}' name='{$name}' {$checked} value='1' ></td>
                </tr>";
    }


    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowNormalData($name, $value){
        return "<tr>
                <td><label for='{$name}'>{$name}</label></td>
                <td><span>{$value}</span></td>
                </tr>";
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowParagraph($name, $value){
        return "<tr>
                <td><label for='{$name}'>{$name}</label></td>
                <td><p style='width:450px;height:auto;'>{$value}</p></td>
                </tr>";
    }


    /**
     * @param $name
     * @param $value
     * @return string
     */
    public static function TableRowSubmit($name, $value){
        $html = "<tr>";
        $html .= "<td></td><td class='table-cell-textarea'><input type='submit' id='{$name}' name='{$name}' value='{$value}' ></td>";
        $html .= "</tr>";
        return $html;
    }



}