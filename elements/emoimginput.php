<?php
defined('_JEXEC') or die ;

class ZoearthElementInsertEmoticonsBtn extends JFormField
{
    function fetchElement($name, $value, &$node, $control_name)
    {
		JHTML::_('behavior.modal');
		$lang = JFactory::getLanguage();
		$lang->load('plg_zoearth_insert_emoticons_btn',JPATH_ADMINISTRATOR);
		JHtml::script(JUri::root().'plugins/editors-xtd/zoearth_insert_emoticons_btn/elements/tmpl.min.js');
		$key   = 'emo'.substr(md5($name),0,4);
        $value = (is_array($value) && isset($value['title']) && is_array($value['title']) ) ? $value:array('title'=>array(0=>''),'src'=>array(0=>''));
		?>
		<script type="text/javascript"> 
		var <?php echo $key ?>Values = '<?php echo json_encode($value) ?>';
		jQuery(document).ready(function() {
			jQuery(".<?php echo $key ?>Btn").click(function(){
				add<?php echo $key ?>("","");
			});
			//ªì©lÄæ¦ì
			startAdd<?php echo $key ?>();
		});
		function startAdd<?php echo $key ?>()
		{
			<?php foreach ($value['title'] as $kn=>$title): ?>
			add<?php echo $key ?>("<?php echo $title ?>","<?php echo $value['src'][$kn] ?>");
			<?php endforeach;?>
		}
		function add<?php echo $key ?>(title,src)
		{
			var data = {
				"title"     : title,
				"src"       : src,
				"titleName" : "<?php echo $name ?>[title][]",
				"srcName"   : "<?php echo $name ?>[src][]",
				"srcId"     : "<?php echo $key ?>Src"+Math.random().toString(36).substring(7),
				};
			jQuery(".<?php echo $key ?>Div").append(tmpl("tmpl<?php echo $key ?>", data));
            
            jQuery('a.modal').unbind().click(function(){
                SqueezeBox.open(jQuery(this).attr('href'),{handler: 'iframe',size: {x: 800, y: 500}});
            });
		}
		function jMediaRefreshPreview(id){}
		function jInsertFieldValue(value, id) {
			var $ = jQuery.noConflict();
			var old_value = $("#" + id).val();
			if (old_value != value) {
				var $elem = $("#" + id);
				$elem.val(value);
				$elem.trigger("change");
				if (typeof($elem.get(0).onchange) === "function") {
					$elem.get(0).onchange();
				}
				jMediaRefreshPreview(id);
			}
		}
		</script>
		<script type="text/x-tmpl" id="tmpl<?php echo $key ?>">
		<div class="row">
		<div class="input-prepend input-append">
			<input type="text" name="{%=o.titleName%}" value="{%=o.title%}" placeholder="<?php echo JText::_('JFIELD_TITLE_DESC') ?>" >
			<input type="text" class="input-small" readonly="readonly" value="{%=o.src%}" id="{%=o.srcId%}" name="{%=o.srcName%}">
			<a class="modal btn btn-info" rel="{handler: 'iframe', size: {x: 800, y: 500}}" onclick="return false;" href="index.php?option=com_media&view=images&tmpl=component&fieldid={%=o.srcId%}" ><?php echo JText::_('JSELECT') ?></a>
			<a class="btn btn-danger" onclick="jQuery(this).parent().remove();return false;" href="#" ><?php echo JText::_('JACTION_DELETE') ?></a>
		</div>
		</div>
		</script>
		<?php
		$html = '';
		$html .= '<button class="btn btn-success '.$key.'Btn " type="button" >'.JText::_('JTOOLBAR_NEW').'</button>';
		$html .= '<div class="'.$key.'Div" ></div>';
		
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

class JFormFieldEmoImgInput extends ZoearthElementInsertEmoticonsBtn
{
    var $type = 'emoimginput';
}

class JElementEmoImgInput extends ZoearthElementInsertEmoticonsBtn
{
    var $_name = 'emoimginput';
}