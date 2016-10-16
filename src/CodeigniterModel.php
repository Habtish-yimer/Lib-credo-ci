<?php

namespace Rougin\Credo;

/**
 * Codeigniter Model
 *
 * @package Credo
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class CodeigniterModel extends \CI_Model
{
    /**
     * @var \Rougin\Credo\Credo
     */
    protected $credo;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    public function __construct()
    {
        parent::__construct();

        $this->credo      = new Credo($this->db);
        $this->repository = $this->credo->getRepository(get_class($this));
    }

    /**
     * Returns all of the models from the database.
     *
     * @return array
     */
    public function all()
    {
        return $this->find_by([]);
    }

    /**
     * Deletes the specified ID of the model from the database.
     *
     * @param  integer $id
     * @return void
     */
    public function delete($id)
    {
        $item = $this->find($id);

        $this->credo->remove($item);
        $this->credo->flush();
    }

    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param  mixed    $id
     * @param  int|null $lockMode
     * @param  int|null $lockVersion
     * @return object|null
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->repository->find($id, $lockMode, $lockVersion);
    }

    /**
     * Finds models by a set of criteria.
     *
     * @param  array        $criteria
     * @param  array|null   $orderBy
     * @param  integer|null $limit
     * @param  integer|null $offset
     * @return array
     */
    public function find_by(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }
}