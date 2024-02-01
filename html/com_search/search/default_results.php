<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$images = array();

$pattern = '/id=[0-9]*/'; //$pattern = '/id=[0-9]*/'; if it is only numeric.
foreach ($this->results as $result) {
    $href = $result->href;
    if(strpos($href, "com_contact")) {
	    preg_match($pattern, $href, $id_);
        $id = substr($id_[0], 3);

	    $db = JFactory::getDbo();
        $query = $db->getQuery(true);

	    $query->select($db->quoteName(array('image')));
	    $query->from($db->quoteName('#__contact_details'));
	    $query->where($db->quoteName('id') . ' = '. $db->quote($id));
	    $db->setQuery($query);

	    $rest = $db->loadObjectList();
	    $images[$result->slug] = $rest[0];

    }
}


?>
<dl class="search-results<?php echo $this->pageclass_sfx; ?>">
<?php foreach ($this->results as $result) : ?>


    <div class="clearfix">



        <dt class="result-title">
        <?php // if($result->image) :?>
        <!-- <img src="<?= $result->image; ?>" style="float: left; max-width: 120px;" /> -->
            <?php // endif; ?>
		<?php echo $this->pagination->limitstart + $result->count . '. '; ?>
		<?php if ($result->href) : ?>
            <a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) : ?> target="_blank"<?php endif; ?>>
				<?php // $result->title should not be escaped in this case, as it may ?>
				<?php // contain span HTML tags wrapping the searched terms, if present ?>
				<?php // in the title. ?>
				<?php echo $result->title; ?>
            </a>
		<?php else : ?>
			<?php // see above comment: do not escape $result->title ?>
			<?php echo $result->title; ?>
		<?php endif; ?>

        </dt>
	    <?php if ($result->section) : ?>
            <dd class="result-category">
			<span class="small<?php echo $this->pageclass_sfx; ?>">
				(<?php echo $this->escape($result->section); ?>)
			</span>
            </dd>
	    <?php endif; ?>
        <dd class="result-text">
		    <?php echo $result->text; ?>
        </dd>
	    <?php if ($this->params->get('show_date')) : ?>
            <!-- <dd class="result-created<?php echo $this->pageclass_sfx; ?>"> -->
			    <?php // echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
            <!-- </dd> -->
	    <?php endif; ?>
    </div>
<?php endforeach; ?>
</dl>
<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
