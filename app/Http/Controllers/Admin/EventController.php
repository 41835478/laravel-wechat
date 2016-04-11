<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/8/15
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Admin;

use App\Award;
use App\Event;
use App\Http\Controllers\Controller;
use App\Repositories\AwardRepository;
use App\Repositories\EventRepository;
use App\Winner;
use Illuminate\Http\Request;


class EventController extends BaseController {

    protected  $event;
    protected  $award;
    public function __construct(EventRepository $eventRepository ,AwardRepository $awardRepository)
    {
        parent::__construct();
        $this->event = $eventRepository;
        $this->award = $awardRepository;
    }

    //活动列表
    public function index()
    {
        //
        $events = Event::orderBy('created_at','DESC')->paginate(20);
        return view('admin.event.index',compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $result = $this->event->create($request->all());

        if($result->id) {
            flash()->success('新建成功');
        }else{
            flash()->error('新建失败');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $event = Event::find($id);

        return view('admin.event.edit',compact('event'));
    }

    public function update(Request $request,$id)
    {
        $result = $this->event->update($request->all(),$id);
        if($result->id) {
            flash()->success('新建成功');
        }else{
            flash()->error('新建失败');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $result = $event->delete();
        if($result->id) {
            flash()->success('删除成功');
        }else{
            flash()->error('删除失败');
        }
        return redirect()->back();
    }

    /*
     * 奖品
     * */

    public function awardIndex($event_id)
    {
        $awards = Award::where('event_id','=',$event_id)->get();
        return view('admin.award.index',compact('event_id','awards'));
    }

    public function awardCreate($id)
    {
        return view('admin.award.create',compact('id'));
    }

    public function awardStore(Request $request)
    {
        $result = $this->award->create($request->all());
        if($result->id) {
            flash()->success('新建成功');
        }else{
            flash()->error('新建失败');
        }
        return redirect()->back();
    }

    public function awardEdit($event_id,$id)
    {
        $award = Award::find($id);
        return view('admin.award.edit',compact('event_id','award'));
    }

    public function awardUpdate(Request $request,$id)
    {
        $result = $this->award->update($request->all(),$id);
        if($result->id) {
            flash()->success('操作成功');
        }else{
            flash()->error('操作失败');
        }
        return redirect()->back();
    }

    public function awardDestroy($id)
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


    //查看ID为eventId的活动的奖品列表
    public function awardList($id)
    {
        $event = Event::find($id);
        return view('admin.award.index',compact('event'));
    }

    //查看活动ID为eventId的活动的中奖用户
    public function showWinners($id)
    {
        $winners = Winner::where('event_id','=',$id)->get();
        return view('admin.award.winners',compact('winners'));
    }


    public function winnerCash($winner_id)
    {
        $winner = Winner::find($winner_id);
        $winner->is_cash = 1;
        $winner->save();
        if($winner->id) {
            flash()->success('操作成功');
        }else{
            flash()->error('操作失败');
        }
        return redirect()->back();
    }


} 