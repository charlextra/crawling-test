<?php
namespace App\Repositories;

use Lab2view\RepositoryGenerator\BaseRepository;
use App\Models\CustomLink;

class CustomLinkRepository extends BaseRepository
{
    public function __construct(CustomLink $model)
    {
        parent::__construct($model);
    }
}
