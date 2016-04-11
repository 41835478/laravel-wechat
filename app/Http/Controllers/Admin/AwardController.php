<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/9/15
 * Time: 6:10 PM
 */

namespace App\Http\Controllers\Admin;


use App\Award;
use App\Repositories\AwardRepository;
use Illuminate\Http\Request;

class AwardController extends BaseController{

    protected $award;

    public function __construct(AwardRepository $awardRepository)
    {
        parent::__construct();
        $this->award = $awardRepository;
    }

    public function index($id)
    {
        $awards = Award::where('event_id','=',$id)->get();
        return view('admin.award.index',compact('id','awards'));
    }

    public function create($id)
    {
        return view('admin.award.create',compact('id'));
    }

    public function store(Request $request)
    {
        $result = $this->award->create($request->all());
        if($result->id) {
            flash()->success('新建成功');
        }else{
            flash()->error('新建失败');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $award = Award::find($id);
        return view('admin.award.edit',compact('award'));
    }

    public function update(Request $request,$id)
    {
        $result = $this->award->update($request->all(),$id);
        if($result->id) {
            flash()->success('操作成功');
        }else{
            flash()->error('操作失败');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $result = Award::find($id);
        $result->delete();
        if($result->id) {
            flash()->success('操作成功');
        }else{
            flash()->error('操作失败');
        }
        return redirect()->back();
    }
} 