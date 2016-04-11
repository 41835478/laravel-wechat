<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 5/13/15
 * Time: 4:00 PM
 */

namespace App\Repositories;


use App\Node;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NodeRepository {

    public function create(array $data)
    {
        DB::transaction(function() use ($data){
            $node = Node::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'photo' => $data['photo']
            ]);

            $node->parents()->attach($data['node_parent_id']);

        });
    }

    public function update(array $data,$id)
    {
        DB::transaction(function() use ($data,$id){
            $node = $this->updateData($data,$id);

//            $node->parents()->updateExistingPivot($node->id,['node_parent_id'=>$data['node_parent_id']]);
            DB::table('node_hierarchy')
                ->where('node_id', $node->id)
                ->update(['node_parent_id' => $data['node_parent_id']]);
        });

    }

    public function updateData(array $data,$id)
    {
        $node = Node::find($id);
        $node->title = $data['title'];
        $node->description = $data['description'];
        $node->photo = $data['photo'];
        $node->save();
        return $node;
    }

    public function boot()
    {
        $boots = Node::whereHas('parents',function($q){
            $q->where('node_parent_id','=','0');
        })->get();

        return $boots;
    }

    /**
     * Buiding collections to tree.
     *
     * @param  Collection $source
     * @return object
     */
    public function tree()
    {
        $tree = $this->boot()->load('children');
        return $tree;
    }
} 