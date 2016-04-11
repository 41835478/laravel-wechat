<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Node;
use App\Repositories\NodeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NodeController extends BaseController {


    protected $node;
    public function __construct(NodeRepository $nodeRepository)
    {
        parent::__construct();
        $this->node=$nodeRepository;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $nodes = $this->node->tree();
        return view('admin.node.index',compact('nodes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		//
        $nodes = $this->node->tree();
        return view('admin.node.create',compact('nodes'));
	}

    public function newsub($id=0)
    {
        //
        $nodes = $this->node->tree();
        return view('admin.node.create',compact('id','nodes'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
        $this->node->create($request->all());

        flash()->success('创建成功');

        return redirect()->back();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $enode = Node::find($id);

        $fnode = DB::table('node_hierarchy')
            ->where('node_id','=', $id)
            ->first()->node_parent_id;
        $nodes = $this->node->tree();
        return view('admin.node.edit',compact('enode','fnode','nodes'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
        $this->node->update($request->all(),$id);

        flash()->success('修改成功');

        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $node = Node::find($id);
        $node->delete();
        //同时更新子节点为顶级节点
        $nodeIds = DB::table('node_hierarchy')->where('node_parent_id','=',$id)->lists('node_id');
        foreach($nodeIds as $nodeId){
            $node->children()->updateExistingPivot($nodeId,['node_parent_id'=>0]);
        }
        flash()->success('删除成功');
        return redirect()->back();
	}

}
