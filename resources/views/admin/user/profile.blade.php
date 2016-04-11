@extends('layouts.admin.admin')
@section('page-title')
<div class="page-title">
    <div class="title-env">
        <h1 class="title">用户信息</h1>
        <p class="description">Dynamic table variants with pagination and other controls</p>
    </div>
    
    <div class="breadcrumb-env">
        
        <ol class="breadcrumb bc-1">
            <li>
                <a href="dashboard-1.html"><i class="fa-home"></i>Dashboard</a>
            </li>
            <li>
                
                <a href="tables-basic.html">用户中心</a>
            </li>
            <li class="active">
                
                <strong>用户信息</strong>
            </li>
        </ol>
        
    </div>
</div>
@stop
@section('content')

<section class="profile-env">
				
                <div class="row">
                    
                    <div class="col-sm-3">
                        
                        <!-- User Info Sidebar -->
                        <div class="user-info-sidebar">
                            
                            <a href="#" class="user-img">
                                {!! Html::image('style/assets/images/user-4.png',null,['class'=>'img-responsive img-circle img-thumbnail']) !!}
                            </a>
                            
                            <a href="#" class="user-name">
                                {{$user->name}}
                                <span class="user-status is-online"></span>
                            </a>
                            
                            <span class="user-title">
                                @if($role){{$role}}@else 普通会员 @endif at <strong>慕庄</strong>
                            </span>
                            
                            <hr />
                            
                            <ul class="list-unstyled user-info-list">
                                <li>
                                    <i class="fa-home"></i>
                                    Prishtina, Kosovo
                                </li>
                                <li>
                                    <i class="fa-briefcase"></i>
                                    <a href="#">Laborator</a>
                                </li>
                                <li>
                                    <i class="fa-graduation-cap"></i>
                                    University of Bologna
                                </li>
                            </ul>
                            
                            <hr />
                            
                            <ul class="list-unstyled user-friends-count">
                                <li>
                                    <span>643</span>
                                    followers
                                </li>
                                <li>
                                    <span>108</span>
                                    following
                                </li>
                            </ul>
                            
                            <button type="button" class="btn btn-success btn-block text-left">
                                Following
                                <i class="fa-check pull-right"></i>
                            </button>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-9">
                        
                        <!-- User Post form and Timeline -->
                        <form method="post" action="" class="profile-post-form">
                            <textarea class="form-control input-unstyled input-lg autogrow" placeholder="What's on your mind?"></textarea>
                            <i class="el-edit block-icon"></i>
                            
                            <ul class="list-unstyled list-inline form-action-buttons">
                                <li>
                                    <button type="button" class="btn btn-unstyled">
                                        <i class="el-camera"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-unstyled">
                                        <i class="el-attach"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-unstyled">
                                        <i class="el-mic"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-unstyled">
                                        <i class="el-music"></i>
                                    </button>
                                </li>
                            </ul>
                            
                            <button type="submit" class="btn btn-single btn-xs btn-success post-story-button">Post</button>
                        </form>
                        
                        
                        <!-- User timeline stories -->
                        <section class="user-timeline-stories">
                            
                            <!-- Timeline Story Type: Status -->
                            <article class="timeline-story">
                                
                                <i class="fa-paper-plane-empty block-icon"></i>
                                
                                <!-- User info -->
                                <header>
                                    
                                    <a href="#" class="user-img">
                                        {!! Html::image('style/assets/images/user-4.png',null,['class'=>'img-responsive img-circle']) !!}
                                    </a>
                                    
                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> posted a status <a href="#">update</a>.
                                        <time>12 hours ago</time>
                                    </div>
                                    
                                </header>
                                
                                <div class="story-content">
                                    <!-- Story Content Wrapped inside Paragraph -->
                                    <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                                    
                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#">
                                            <i class="linecons-heart"></i>
                                            Like
                                            <span>(3)</span>
                                        </a>
                                        
                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comments
                                            <span>(5)</span>
                                        </a>
                                    </div>
                                    
                                    
                                    <!-- Story Comments -->
                                    <ul class="list-unstyled story-comments">
                                        <li>
                                            
                                            <div class="story-comment">
                                                <a href="#" class="comment-user-img">
                                                    {!! Html::image('style/assets/images/user-2.png',null,['class'=>'img-responsive img-circle']) !!}
                                                </a>
                                                
                                                <div class="story-comment-content">
                                                    <a href="#" class="story-comment-user-name">
                                                        Arlind Nushi
                                                        <time>28 September 2014 - 00:36</time>
                                                    </a>
                                                    
                                                    <p>Him these are visit front end for seven walls. Money eat scale now ask law learn.</p>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        <li>
                                            
                                            <div class="story-comment">
                                                <a href="#" class="comment-user-img">
                                                    {!! Html::image('style/assets/images/user-3.png',null,['class'=>'img-responsive img-circle']) !!}
                                                </a>
                                                
                                                <div class="story-comment-content">
                                                    <a href="#" class="story-comment-user-name">
                                                        Eroll Maxhuni
                                                        <time>01 September 2014 - 00:36</time>
                                                    </a>
                                                    
                                                    <p>Taken no great widow spoke of it small. Genius use except son esteem merely her limits.</p>
                                                </div>
                                            </div>
                                            
                                        </li>
                                    </ul>
                                    
                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>
                                </div>
                                
                            </article>
                            
                            <!-- Timeline Story Type: Audio -->
                            <article class="timeline-story">
                                
                                <i class="fa-music block-icon"></i>
                                
                                <!-- User info -->
                                <header>
                                    
                                    <a href="#" class="user-img">
                                        {!! Html::image('style/assets/images/user-4.png',null,['class'=>'img-responsive img-circle']) !!}
                                    </a>
                                    
                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> posted an audio <a href="#">track</a>.
                                        <time>22 hours ago</time>
                                    </div>
                                    
                                </header>
                                
                                <!-- Audio Track -->
                                <div class="story-audio-item">
                                    <div class="story-content">
                                        
                                        <div class="audio-track-info">
                                            <div class="artist-info">MC Kresha - Emceeclopedy</div>
                                            <div class="track-length">2:14 - 4:31</div>
                                        </div>
                                        
                                        <div class="audio-track-timeline">
                                            <div class="play-pause">
                                                <a href="#">
                                                    <i class="fa-to-start"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-pause"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa-to-end"></i>
                                                </a>
                                            </div>
                                            
                                            <div class="track-timeline">
                                                <div class="track-timeline-empty">
                                                    <div class="track-fill" style="width:49.4%"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="track-volume">
                                                <a href="#">
                                                    <i class="fa-volume-up"></i>
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="story-content">
                                    
                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#" class="liked">
                                            <i class="linecons-heart"></i>
                                            Like 
                                            <span>(10)</span>
                                        </a>
                                        
                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comments 
                                            <span>(0)</span>
                                        </a>
                                    </div>
                                    
                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>
                                    
                                </div>
                                
                            </article>
                            
                            <!-- Timeline Story Type: Check-in -->
                            <article class="timeline-story">
                                
                                <i class="fa-pin block-icon"></i>
                                
                                <!-- User info -->
                                <header>
                                    
                                    <a href="#" class="user-img">
                                        {!! Html::image('style/assets/images/user-4.png',null,['class'=>'img-responsive img-circle']) !!}
                                    </a>
                                    
                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> checked in at <a href="#">Laborator</a>.
                                        <time>1 day ago</time>
                                    </div>
                                    
                                </header>
                                
                                
                                <div class="story-content">
                                    
                                    <div class="story-checkin">
                                        <div id="sample-checkin" class="map-checkin" style="height: 180px; width: 100%;"></div>
                                    </div>
                                    
                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#">
                                            <i class="linecons-heart"></i>
                                            Like 
                                            <span>(4)</span>
                                        </a>
                                        
                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comment
                                            <span>(1)</span>
                                        </a>
                                    </div>
                                    
                                    
                                    <!-- Story Comments -->
                                    <ul class="list-unstyled story-comments">
                                        <li>
                                            
                                            <div class="story-comment">
                                                <a href="#" class="comment-user-img">
                                                    {!! Html::image('style/assets/images/user-1.png',null,['class'=>'img-responsive img-circle']) !!}
                                                </a>
                                                
                                                <div class="story-comment-content">
                                                    <a href="#" class="story-comment-user-name">
                                                        Ylli Pylla
                                                        <time>19 August 2014 - 00:36</time>
                                                    </a>
                                                    
                                                    <p>Appear an manner as no limits either praise in. In in written on charmed justice is amiable farther besides.</p>
                                                </div>
                                            </div>
                                            
                                        </li>
                                    </ul>
                                    
                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>
                                    
                                </div>
                                
                            </article>
                            
                            <!-- Timeline Story Type: Photos -->
                            <article class="timeline-story">
                                
                                <i class="fa-camera-retro block-icon"></i>
                                
                                <!-- User info -->
                                <header>
                                    
                                    <a href="#" class="user-img">
                                        {!! Html::image('style/assets/images/user-4.png',null,['class'=>'img-responsive img-circle']) !!}
                                    </a>
                                    
                                    <div class="user-details">
                                        <a href="#">Art Ramadani</a> added <strong>3</strong> photos to <a href="#">Holiday Trip</a> album.
                                        <time>a week ago</time>
                                    </div>
                                    
                                </header>
                                
                                <div class="story-content">
                                    
                                    <div class="story-album">
                                        <div class="col-1">
                                            <a href="#">
                                                {!! Html::image('style/assets/images/image-1.jpg',null,['class'=>'img-responsive']) !!}
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <a href="#" class="base-padding">
                                                {!! Html::image('style/assets/images/image-2.jpg',null,['class'=>'img-responsive']) !!}
                                            </a>
                                            <div class="vspacer v2"></div>
                                            <a href="#">
                                                {!! Html::image('style/assets/images/image-3.jpg',null,['class'=>'img-responsive']) !!}
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Story Options Links -->
                                    <div class="story-options-links">
                                        <a href="#" class="liked">
                                            <i class="linecons-heart"></i>
                                            Like 
                                            <span>(2)</span>
                                        </a>
                                        
                                        <a href="#">
                                            <i class="linecons-comment"></i>
                                            Comments 
                                            <span>(0)</span>
                                        </a>
                                    </div>
                                    
                                    <form method="post" action="" class="story-comment-form">
                                        <textarea class="form-control input-unstyled autogrow" placeholder="Reply..."></textarea>
                                    </form>
                                    
                                </div>
                                
                            </article>
                            
                        </section>
                        
                    </div>
                    
                </div>
                
</section>


@stop
@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
@stop