<?php

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', false, true);

// template name
  $app    = JFactory::getApplication();
  $templatename = $app->getTemplate();

// Include module's assets
if ($include_css) {
	JHtml::_('stylesheet', 'modules/mod_ajaxsearch/assets/css/style.css');
}
JHtml::_('script', 'modules/mod_ajaxsearch/assets/js/script.js');

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_ajaxsearch' . $module->id;
	$css = 'div.mod_ajaxsearch' . $module->id . ' input[type="search"]';
	$doc->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
} else {
	$width = '';
}

$input = $app->input;
if ($input->get('searchword', '', 'string')!='') {
	$text = $input->get('searchword', '', 'string');
}

// js settings
$js = '
	var asoptions = {
		lower_limit: '.$lower_limit.',
		max_results: '.$max_results.'
	};
	var asstrings = {
		show_all: "'.JText::_('MOD_AJAXSEARCH_SHOW_ALL').'"
	};
';
$doc->addScriptDeclaration($js);

$action_url = 'index.php?option=com_search&view=search';
$action_url_contact = 'index.php?option=com_search&view=search&areas[0]=contacts';

if ($mitemid) {
	$action_url .= '&Itemid='.$mitemid;
}



?>
<div class="ajax-search<?php echo $moduleclass_sfx ?>">
	<form id="mod-ajaxsearch-form<?= $module->id; ?>" action="<?php echo JRoute::_($action_url);?>" method="post" class="form-inline">
		<div class="btn-toolbar">
			<div>
				<input type="search" name="searchword" id="mod-ajaxsearch-searchword<?= $module->id; ?>" placeholder="<?php echo $label; ?>"<?php echo $width; ?> maxlength="<?php echo $maxlength; ?>" class="inputbox form-control" value="<?php echo $text; ?>" autocomplete="off" onblur="if (this.value=='') this.value='<?php echo $text; ?>';" onfocus="if (this.value=='<?php echo $text; ?>') this.value='';" />
			</div>
			<?php if ($button) : ?>
				<div class="btn-group pull-left">
               
					<button name="Search" type="submit" class="btn btn-secondary" title="<?php echo JHtml::tooltipText($button_text);?>">
                        <img class="" src="<?php echo 'templates/'.$templatename;?>/images/icon-search.png"/>
                        <span class="icon-search"></span></button>
				</div>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
        <div class="search-type hidden-md-down pt-2">
            
            <label class="pr-2" for="all-search<?= $module->id; ?>">
                <input type="radio" name="search-type" value="all" id="all-search<?= $module->id; ?>" checked/>
                <?php echo JText::_("MOD_AJAXSEARCH_SEARCHBUTTON_ALL"); ?>
            </label>
			<label for="contact-search<?= $module->id; ?>">
                <input type="radio" name="search-type" value="contacts" id="contact-search<?= $module->id; ?>"/>
                <?php echo JText::_("MOD_AJAXSEARCH_SEARCHBUTTON_CON"); ?>
            </label>
        </div>
		<div id="mod-ajaxsearch-results-box<?= $module->id; ?>" class="results-box"></div>
        <input type="hidden" name="task" value="search" />
		<input type="hidden" name="limit" value="<?php echo $pagination_limit; ?>" />
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>

    function submitButtton() {
            dataSend();
    };

    function dataSend() {

        var asxhr;
        var el = jQuery('#mod-ajaxsearch-searchword<?= $module->id; ?>');
        var search_string = el.val();
        if (search_string !== '' && search_string.length >= asoptions.lower_limit) {
            if (asxhr && asxhr.readyState != 4) {
                asxhr.abort()
            }
            asxhr = jQuery.ajax({
                type: 'POST',
                beforeSend: function () {
                    el.addClass('loading')
                },
                async: false,
                url: jQuery('#mod-ajaxsearch-form<?= $module->id; ?>').attr('action'),
                data: {
                    type: 'raw',
                    option: 'com_search',
                    searchword: search_string,
                    limit: asoptions.max_results,
                    tmpl: 'component',

                },
                cache: false,
                complete: function () {
                    el.removeClass('loading')
                },
                success: function (response) {
                    var container = jQuery('#mod-ajaxsearch-results-box<?= $module->id; ?>');
                    if (jQuery(response).find('.search-results').html()) {
                        container.html(jQuery(response).find('.search-results'));
                        container.append('<div class="mod-ajaxsearch-results-footer<?= $module->id; ?>"><a href="javascript: void(0);" onclick="document.getElementById(\'mod-ajaxsearch-form<?= $module->id; ?>\').submit();">' + asstrings.show_all + '</a></div>')
                    } else {
                        container.html('<span class="epty-resoults"><?php echo JText::_("MOD_AJAXSEARCH_FIELD_NO_RESULTS"); ?></span>')
                    }
                },
                dataType: 'html'
            })
        } else {
            jQuery('#mod-ajaxsearch-results-box<?= $module->id; ?>').html('')
        }
        return false
    }

    jQuery(document).ready(function () {
        jQuery('.search-type input[type=radio]').on('change', function() {
            var type = jQuery(this).val();
            if(type== 'contacts') {
                jQuery('#mod-ajaxsearch-form<?= $module->id; ?>').append('<input type="hidden" name="areas[0]" value="contacts" id="typeData<?= $module->id; ?>" />');
                jQuery('#mod-ajaxsearch-form<?= $module->id; ?>').attr('action', "<?php echo JRoute::_($action_url_contact);?>")
            } else {
                jQuery('#typeData<?= $module->id; ?>').remove();
                jQuery('#mod-ajaxsearch-form<?= $module->id; ?>').attr('action', "<?php echo JRoute::_($action_url);?>")


            }
        });

        var interval = 0;
        jQuery('#mod-ajaxsearch-form<?= $module->id; ?>').on('submit', function (e) {
            if(jQuery(document).width() > 992) {
                e.preventDefault()
                dataSend();
            } else {
                jQuery('#mod-ajaxsearch-form<?= $module->id; ?>').submit();
            }

        });


        jQuery('#mod-ajaxsearch-searchword<?= $module->id; ?>').on('keyup', function (e) {

                clearInterval(interval);
                interval = window.setTimeout(function () {
                    if(jQuery(document).width() > 992) {
                        dataSend();
                    }
                }, 7000);

        });
        jQuery(document).on('click', function (e) {
            var container = jQuery('#mod-ajaxsearch-results-box<?= $module->id; ?>');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.html('')
            }
        })
    });


</script>