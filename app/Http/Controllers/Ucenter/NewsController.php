<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/27/15
 * Time: 4:16 PM
 */

namespace App\Http\Controllers\Ucenter;


use App\Repositories\WechatRepositories\NewsRepository;
use App\WechatNews;
use Illuminate\Http\Request;

class NewsController extends BaseController{

    protected $news;

    public function __construct(NewsRepository $newsRepository)
    {
        parent::__construct();
        $this->news = $newsRepository;
    }

    public function index()
    {

    }

    public function create($wechatId)
    {
        $type = 'create';
        return view('ucenter.public.media.create_edit_news',compact('type'));
    }

    public function store(Request $request,$wechatId)
    {
        $this->news->create($request->all(),$wechatId);

        flash()->success('保存成功');

        return redirect()->back();
    }

    public function edit($wechatId,$id)
    {
        $news = WechatNews::find($id);
        $type = 'edit';

        return view('ucenter.public.media.create_edit_news',compact('type','news'));
    }

    public function update(Request $request,$wechatId,$id)
    {
        $this->news->update($request->all(),$id);

        flash()->success('保存成功');

        return redirect()->back();
    }
} 