<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class EditPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}
    protected function createComponentPostForm(): Form
	{
		$form = new Form;
		$form->addUpload('file', 'Soubor:')
		->setRequired();
		$form->addSubmit('send', 'Uložit a publikovat');
		$form->onSuccess[] = [$this, 'postFormSucceeded'];

		return $form;
	}
	protected function defaultComponentPostForm(): Form
	{
		$form = new Form;
		$form->addUpload('file', 'Soubor:')
		->setRequired();
		$form->addSubmit('send', 'Uložit a publikovat');
		$form->onSuccess[] = [$this, 'postFormSucceeded'];

		return $form;
	}
	public function postFormSucceeded(array $data): void
	{
		$file = $data['file'];
		if ($file->isOk()) {
			$filename = $file->getName();
			$filesize = $file->getSize();
			$filetype = $file->getContentType();
			$fileContent = $file->getContents();
			$savedDate = new \DateTime();

			$this->database->table('files_data')->insert([
				'name' => $filename,
				'type' => $filetype,
				'size' => $filesize,
				'content' => $fileContent,
				'saved_date' => $savedDate,
			]);

			echo '<script>alert("Soubor se úspěšně nahrál");</script>';
		} else {
			echo '<script>alert("Soubor se nezdařilo nahrát");</script>';
		}
	}

}