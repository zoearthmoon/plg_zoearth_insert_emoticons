<?php
defined('_JEXEC') or die ;

class ZoearthElementInsertEmoticonsBtn extends JFormField
{
    function fetchElement($name, $value, &$node, $control_name)
    {
        //$name
        //$value
        
        $html = 'TESTing!!!!!';
        
        return $html;
    }
    
    function getInput()
    {
        return $this->fetchElement($this->name, $this->value, $this->element, $this->options['control']);
    }
    
    function getLabel()
    {
        if (method_exists($this, 'fetchTooltip'))
        {
            return $this->fetchTooltip($this->element['label'], $this->description, $this->element, $this->options['control'], $this->element['name'] = '');
        }
        else
        {
            return parent::getLabel();
        }
    }
    
    function render()
    {
        return $this->getInput();
    }

}

class JFormFieldCustomMenus extends ZoearthElementInsertEmoticonsBtn
{
    var $type = 'emo_img_input';
}

class JElementCustomMenus extends ZoearthElementInsertEmoticonsBtn
{
    var $_name = 'emo_img_input';
}


function showIframeModal($divId,$title,$url)
{
    $modalHtml = '<div id="'.$divId.'" style="left: 0;margin-left: 10%;width: 80%;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">'.$title.'</h3>
    </div>
    <div class="modal-body">
        <iframe src="'.$url.'" width="100%" height="500px" ></iframe>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div></div>';
    return $modalHtml;
}

function showCustomItemHeadModal()
{
    $modalHtml = '<div id="customItemHeadModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">'.JText::_("TPL_ZOEARTH_CUSTOM_MENU_ITEM").'</h3>
    </div>
    <div class="modal-body">
        <legend>'.JText::_('TPL_ZOEARTH_CUSTOM_SET').'</legend>
            <input type="text" name="customMenuName" id="customMenuName" value="" >
        <div class="span2 offset10" >
            <button class="btn btn-success" id="addCustomMenuHead" type="button">'.JText::_('JTOOLBAR_NEW').'</button>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div></div>';
    return $modalHtml;
}

//20141114 zoearth 新增分類特別設定
function showSetupCategoryModal()
{
    $modalHtml = '<div id="z2SetupCategoryModal" style="left: 0;margin-left: 10%;width: 80%;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">分類特別設定</h3>
    </div>
    <div class="modal-body" style="min-height:300px">
        <table class="table table-bordered table table-striped">
        <tr>
            <td class="span3" >項目名稱</td>
            <td>
                <div><input type="text" id="title" name="title"></div>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>綁定類型<br>(只在分類有效.預設為該分類)</td>
            <td>
                <select id="bindType" name="bindType" >
                    <option value="1">該分類</option>
                    <option value="2">以該分類為母分類的分類</option>
                    <option value="3">該分類底下所有分類</option>
                </select>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>顯示欄位</td>
            <td>
                <span class="alert" >若都無勾選，則全部顯示</span>
                <label>通用設定</label>
                <select id="showField" name="showField" multiple="multiple" >
                    <option value="title">標題</option>
                    <option value="bPic">大圖</option>
                    <option value="sPic">附加小圖</option>
                    <option value="addFile">附加檔案</option>
                    <option value="extendField">附加欄位</option>
                    <option value="mainContent">主要內容</option>
                    <option value="seoTab">SEO設定</option>
                    <option value="authDate">權限與日期</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>附加說明<br>(若有設定，則會出現在分類與列表頁上方說明)</td>
            <td>
                <textarea name="alertInfo" id="alertInfo" ></textarea>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>圖片說明</td>
            <td>
                <textarea name="imgInfo" id="imgInfo" ></textarea>
            </td>
        </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" id="setupCategorySave" type="button">儲存</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">關閉</button>
    </div></div>';
    return $modalHtml;
}

function showSetupCustomMenuNameModal()
{
    $modalHtml = '<div id="customMenuNameModal" style="left: 0;margin-left: 10%;width: 80%;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">選單相關設定</h3>
    </div>
    <div class="modal-body" style="min-height:300px">
        <table class="table table-bordered table table-striped">
        <tr>
            <td class="span3" >項目名稱</td>
            <td>
                <div><input type="text" id="title" name="title"></div>
            </td>
        </tr>
        <tr>
            <td class="span3" >項目ICON<br><a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank" >參考</a></td>
            <td>
                <div><input type="text" id="icon" name="icon"></div>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>分類類型<br>(只在分類有效.預設為1)</td>
            <td>
                <select id="categoryType" name="categoryType" >
                    <option value="">--</option>
                    <option value="1">'.JText::_('TPL_ZOEARTH_ADD_Z2_TYPE_1').'</option>
                    <option value="2">'.JText::_('TPL_ZOEARTH_ADD_Z2_TYPE_2').'</option>
                    <option value="3">'.JText::_('TPL_ZOEARTH_ADD_Z2_TYPE_3').'</option>
                </select>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>子項目名稱<br>(如果有子選單)</td>
            <td>
                <div>
                <div>子項目名稱1:<input type="text" id="customMenuName1" name="customMenuName1" ></div>
                <div>子項目名稱2:<input type="text" id="customMenuName2" name="customMenuName2" ></div>
                <div>子項目名稱3:<input type="text" id="customMenuName3" name="customMenuName3" ></div>
                </div>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>顯示欄位</td>
            <td>
                <span class="alert" >若都無勾選，則全部顯示</span>
                <label>通用設定</label>
                <select id="showField" name="showField" multiple="multiple" >
                    <option value="title">標題</option>
                    <option value="bPic">大圖</option>
                    <option value="sPic">附加小圖</option>
                    <option value="addFile">附加檔案</option>
                    <option value="extendField">附加欄位</option>
                    <option value="mainContent">主要內容</option>
                    <option value="seoTab">SEO設定</option>
                    <option value="authDate">權限與日期</option>
                </select>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>編輯型態<br>(只在分類有效.預設為1)</td>
            <td>
                <input type="checkbox" value="onlyModify" id="onlyModify" name="onlyModify" >:全部鎖定(無法新增分類與項目)<br>
                <input type="checkbox" value="lockCategory" id="lockCategory" name="lockCategory" >:鎖定分類(無法新增分類)<br>
                <!--<input type="checkbox" value="lockItem" id="lockItem" name="lockItem" >:鎖定分類(無法新增項目)<br>-->
                <input type="checkbox" value="showInSubMenu" id="showInSubMenu" name="showInSubMenu" >:子選單顯示選單<br>
            </td>
        </tr>
        <tr>
            <td>附加說明<br>(若有設定，則會出現在分類與列表頁上方說明)</td>
            <td>
                <textarea name="alertInfo" id="alertInfo" ></textarea>
            </td>
        </tr>
        <tr>
            <td>群組權限設定<br>(這邊設定與群組設定連絡<br>僅供檢視)</td>
            <td>
                <input type="text" name="groupAuth" readonly value="">
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>項目相關</td>
            <td>
                <input type="checkbox" value="hideAddCat" id="hideAddCat" name="hideAddCat" >:項目隱藏附加分類<br>
                <input type="checkbox" value="useOrderSort" id="useOrderSort" name="useOrderSort" >:項目預設使用排序<br>
            </td>
        </tr>
        <tr class="z2Setup" >
            <td>圖片說明</td>
            <td>
                <textarea name="imgInfo" id="imgInfo" ></textarea>
            </td>
        </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" id="setupCustomMenuName" type="button">儲存</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">關閉</button>
    </div></div>';
    return $modalHtml;
}