<?php
defined('_JEXEC') or die;

class plgButtonZoearth_Insert_Emoticons_Btn extends JPlugin
{
    public function onDisplay($name)
    {
        /*
        20160122 zoearth 這邊的作法構想是
        1.新增一個form 欄位可以輸入多個值: [表情文字]:[指定圖片]
        2.圖片會在這邊先依據[表情文字]的 md5 的前4碼.存到外掛的資料夾底下(不能放在暫存區)
        3.檢查圖片必須是GIF才啟用.如果圖片位置有變也會重新複製一次檔案
        4.所以預設路徑為 http://www.zoearthmoon.net/plugins/editors-xtd/zoearth_insert_emoticons_btn/imgs/abcd.gif
        */
		static $showed;
		if (!$showed):
		$lang = JFactory::getLanguage();
		$lang->load('plg_zoearth_insert_emoticons_btn',JPATH_ADMINISTRATOR);
        
        //20160122 zoearth 取得目前設定
        $emoSetup = $this->params->get('emoSetup');
		$emoSetup = json_decode(json_encode($emoSetup),TRUE);
		
        $emoImgs = array();
        if (is_array($emoSetup['title']) && count($emoSetup['title']) > 0 && is_array($emoSetup['src']) && count($emoSetup['src']) > 0 )
        {
            foreach ($emoSetup['title'] as $key=>$title)
            {
				if ($title == '')continue;
				
                $nowKey = substr(md5($title),0,4);
                //20160122 zoearth 檢查圖片與複製圖片
				
				$cImg = JPATH_ROOT.DS.'plugins'.DS.'editors-xtd'.DS.'zoearth_insert_emoticons_btn'.DS.'imgs'.DS.$nowKey.'.gif';
				$wImg = JUri::root().'/plugins/editors-xtd/zoearth_insert_emoticons_btn/imgs/'.$nowKey.'.gif';
                $aImg = JPATH_ROOT.DS.$emoSetup['src'][$key];
                $rKey = md5($aImg);
                //元圖片是否存在，無則跳過
                if (!is_file($aImg))
                {
                    continue;
                }
                //圖片是否存在.不存在則複製
				else if (!is_file($cImg))
				{
                    unlink($cImg);
                    copy($aImg,$cImg);
				}
                //元圖片大小是否異動，有則更新
                else if (ceil(filesize($aImg)/10) != ceil(filesize($cImg)/10))
                {
                    unlink($cImg);
                    copy($aImg,$cImg);
                }
                $emoImgs[] = array(
					'title' => $title,
					'src'   => $wImg,
                    'rKey'  => $rKey,
					);
            }
        }
		?>
		<script language="Javascript">
		var showEmoticonInput = function (editorName){
			jQuery.data(document.body,"editorName",editorName);
			jQuery('#showemoticonsInsertModal').modal('show');			
		};
		jQuery(document).ready(function() {
			jQuery('#showemoticonsInsertModal').on('show',function (){
				//出現modal時清空textarea
				jQuery("#emoticonslink").val("");
			});
			//新增圖片
			jQuery(".addEmoticonGo").click(function(){
                
				var editorName = jQuery.data(document.body,"editorName");
                var img = jQuery(this).data('src');
                var html = '<img src="'+img+'">';
                jInsertEditorText(html, editorName);
                jQuery('#showemoticonsInsertModal').modal('hide');
			});
		});
		</script>
		<style type="text/css">
		.emo img
		{
			height:50px;
		}
		</style>
		<div id="showemoticonsInsertModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel"><?php echo JText::_('PLG_ZOEARTH_INSERT_EMO_BTN')?></h3>
			</div>
			<div class="modal-body">
				<?php foreach ($emoImgs as $key=>$emo):?>
				<button class="emo btn btn-large btn-primary addEmoticonGo" data-src="<?php echo $emo['src']?>" type="button">
					<img src="<?php echo $emo['src'].'?'.$emo['rKey']?>" >
					<?php echo $emo['title'] ?>
				</button>
				<?php endforeach;?>
			</div>
			<div class="modal-footer">
				<a class="btn" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('JOFF') ?></a>
			</div>
		</div>
		<?php
		$showed = TRUE;
		endif;
		
        $button = new JObject();				
		$button->modal = FALSE;
		$button->class = 'btn';
		$button->title = JText::_('PLG_ZOEARTH_INSERT_EMO_BTN');
        $button->text = JText::_('PLG_ZOEARTH_INSERT_EMO_BTN');
        $button->name = 'comment';
        $button->onclick = 'showEmoticonInput(\''.$name.'\');return false;';
        $button->link = '#';
        return $button;
    }
}
?>