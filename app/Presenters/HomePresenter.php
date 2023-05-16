<?php
namespace App\Presenters;

use App\Model\PostFacade;
use Nette;

final class HomePresenter extends Nette\Application\UI\Presenter
{


	public function __construct(public Nette\Database\Explorer $database, private PostFacade $facade,) 
	{
		$this->database = $database;
	}

	public function renderDefault(): void
	{
		$row = $this->database->table('contacts')->fetch();

        $this->template->row = $row;
	}
}
