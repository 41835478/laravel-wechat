<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/15/15
 * Time: 4:01 PM
 */
 ?>
<!-- Mailbox Sidebar -->
<div class="col-sm-3 mailbox-left">

    <div class="mailbox-sidebar">

        <a href="{{route('ucenter.wechat.create')}}" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
            <i class="fa-plus"></i>
            <span>添加公众号</span>
        </a>


        <ul class="list-unstyled mailbox-list">
            <li class="active">
                <a href="{{route('ucenter.wechat.edit',$wechatId)}}">
                    公众号设置
                    <span class="badge badge-success pull-right">edit</span>
                </a>
            </li>
            <li>
                <a href="{{route('ucenter.wechat.media',$wechatId)}}">
                    素材管理
                    <span class="badge badge-success pull-right"></span>
                </a>
            </li>
            <li>
                <a href="{{route('ucenter.wechat.reply',$wechatId)}}">
                    自动回复
                </a>
            </li>
            <li>
                <a href="#">
                    Drafts
                </a>
            </li>
            <li>
                <a href="#">
                    Spam
                    <span class="badge badge-purple pull-right">2</span>
                </a>
            </li>
            <li>
                <a href="#">
                    Trash
                </a>
            </li>
        </ul>

        <div class="vspacer"></div>

        <ul class="list-unstyled mailbox-list">
            <li class="list-header">Filter by tags</li>
            <li>
                <a href="#">
                    ThemeForest
                    <span class="badge badge-success badge-roundless pull-right upper">Envato</span>
                </a>
            </li>
            <li>
                <a href="#">
                    Society
                    <span class="badge badge-red badge-roundless pull-right upper">Friends</span>
                </a>
            </li>
            <li>
                <a href="#">
                    Work
                    <span class="badge badge-warning badge-roundless pull-right upper">Google</span>
                </a>
            </li>
        </ul>

    </div>

</div>