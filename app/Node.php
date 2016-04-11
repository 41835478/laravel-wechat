<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 5/13/15
 * Time: 11:24 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Node extends Model{


    /**
     * Guarded.
     *
     * @var array
     */
    protected $guarded = array();

    public function parents()
    {
        return $this->belongsToMany('App\Node','node_hierarchy','node_id','node_parent_id');
    }

    public function children()
    {
        return $this->belongsToMany('App\Node','node_hierarchy','node_parent_id','node_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }


    /**
     * Make new category as root.
     *
     * @return object
     */
    public function makeRoot()
    {
        $this->save();
        $this->parents()->sync(array(0));

        return $this;
    }

    /**
     * Make new category into some parent.
     *
     * @param  CategoryInterface $category
     * @return object
     */
    public function makeChildOf(Node $node)
    {
        $this->save();
        $this->parents()->sync(array($node->getKey()));

        return $this;
    }

    /**
     * Get category with nested.
     *
     * @param  string $defination
     * @return object
     */
    public function getNested($defination)
    {
        $this->load(implode('.', array_fill(0, 20, $defination)));

        return $this;
    }

    /**
     * Get children.
     *
     * @return object
     */
    public function getChildren()
    {
        return $this->getNested('children');
    }

    /**
     * Get parents.
     *
     * @return object
     */
    public function getParents()
    {
        return $this->getNested('parents');
    }


    /**
     * Delete category with all children.
     *
     * @return object
     */
    public function deleteWithChildren()
    {
        $ids = array();

        $children = $this->getChildren()->toArray();

        array_walk_recursive($children, function($i, $k) use (&$ids) { if ($k == 'id') $ids[] = $i; });

        foreach ($ids as $id)
        {
            $this->destroy($id);
        }
    }



} 