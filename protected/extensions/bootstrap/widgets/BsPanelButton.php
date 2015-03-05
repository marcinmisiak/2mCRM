<?php
/**
 * 
 * @author Marcin Misiak
 * @license http://opensource.org/licenses/MIT The MIT License
 * @package bootstrap/widgets
 */

// Yii::import('zii.widgets.CPortlet');

/**
 * Bootstrap BsPanelButton widget.
 * Dodalem przyciski
 * 
 * @see http://getbootstrap.com/components/#panels
 */
class BsPanelButton extends BsPanel {
	public $stud_id;
	public $ogloszenie_id;
	/**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderDecoration() {
		if ($this->title !== null) {
			echo "<div class=\"{$this->decorationCssClass}\">\n";
			echo ($this->titleTag ? BsHtml::tag ( $this->titleTag, array (
					'class' => $this->titleCssClass 
			), $this->title ) : $this->title) . "\n";
			echo '<div class="btn-group pull-right">';
			
			echo CHtml::ajaxLink ( BsHtml::icon ( BsHtml::GLYPHICON_TRASH ), Yii::app ()->createUrl ( 'site/OgloszenieDoKosza' ), 
					array (
					'type' => 'POST',
					'data' => 'js:{"stud_id": ' . $this->stud_id . ', "ogloszenie_id": ' . $this->ogloszenie_id . ' }',
					'success' => 'js:function() { ukryjPanel(' . $this->id . '); } ', 
			), 
					array (
					'class' => 'btn btn-default btn-sm' 
			) );
			echo '</div>';
			
			echo "</div>";
		}
	}
	
	/**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderFooter() {
		if ($this->footer !== null) {
			echo "<div class=\"{$this->footerCssClass}\">\n";
			echo $this->footer . "\n";
			echo "</div>\n";
		}
	}
}