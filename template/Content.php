<?php
namespace common\template;
use common\template\component\ContentField;
use common\template\component\TemplateField;

require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';

/**
 * Class Content
 */
abstract class Content {


	/**
	 * Produces the complete HTML string for this content page given content fields for this page.
	 *
	 * @param ContentField[] $fields An associative array mapping fields to ContentField objects.
	 * @return string
	 */
	public abstract function getTemplateRendering(array $fields): string;

	/**
	 * Returns the TemplateField objects associated to this content page. These are the fields that
	 * are used within the template rendering method.
	 *
	 * @return TemplateField[]
	 */
	public abstract function getTemplateFields(): array;
}
