<?php
namespace CIC\Cicslide\Migration;

/**
 *
 */
class AddTextBackgroundToggleToSlides1647023754 extends \CIC\Cicbase\Migration\AbstractMigration {
	public function run() {
		$this->setForgiving(true);
		$this->addTinyIntField('tx_cicslide_domain_model_slide', 'show_text_bg', 0);
	}

	public function rollback() {
		$this->setForgiving(true);
		$this->dropFieldFromTable('tx_cicslide_domain_model_slide', 'show_text_bg');
	}
}
