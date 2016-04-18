<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/4/18
 * Time: 下午10:54
 */
?>
<section class="user-timeline-stories">

    <!-- Timeline Story Type: Status -->
    <article class="timeline-story">

        <i class="fa-paper-plane-empty block-icon"></i>

        <!-- User info -->
        <header>

            <a href="#" class="user-img">
                <img src="{{ url($news->pic_url) }}" alt="user-img" class="img-responsive">
            </a>
            <hr/>
            <div class="user-details">
                <a href="#">{{ $news->author }}</a> created at
                <time>{{ $news->created_at }}</time>
            </div>

        </header>
        <hr/>
        <div class="story-content">
            <!-- Story Content Wrapped inside Paragraph -->
            <p>
                {{ $news->description }}
            </p>

            <!-- Story Comments -->
            <hr/>
            <div class="content">
                {!!  $news->body !!}
            </div>
        </div>

    </article>

</section>
