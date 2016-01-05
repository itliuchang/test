<script id="postlistTpl" type="text/html">
    {{each data as v k}}
        <div class="postWrapper" data-id="{{ v.id }}">
            <div class="header">
                <img src="{{ v.portrait }}" alt="" class="user" data-id="{{ v.userId }}">
                <h4>{{ v.nickName }}</h4>
                <p class="title">{{ v.title }}</p>
                <p class="companyName">{{ v.companyName }}</p>
                <p class="location">{{  v.location }}</p>
                <p class="time">{{ v.createTime | dgm }}</p>
            </div>
            <p class="content">
                {{ v.content }}
            </p>
            {{ if v.picture }}
            <img src="{{ v.picture }}" alt="" class="face">
            {{ /if }}
            <div class="footerWrapper">
                <p><span class="like_num">{{ v.like_num }}</span>like<span>{{ v.comment_num }}</span>comment</p>
                <div class="operation">
                {{ if v.islike }}
                <a class="liked" data-id="{{ v.likeId }}"></a>
                {{ else }}
                <a class="like"></a>
                {{ /if }}
                <a>COMMENT</a></div>
            </div>
        </div>
    {{/each}}
</script>
<script id="postCommentTpl" type=text/html"">
    <div class="comment">
        <p class="time">{{ data['newcomment']['createTime'] | dgm }}</p>
        <img class="user" src="{{ data['user']['portrait'] }}" alt="" data-id="<?php echo $value['userId'] ?>">
        <div class="right">
            <div class="title">
                <h3 class="name">{{ data['user']['nickName'] }}</h3>
                <p class="location">{{ data['user']['title'] }},{{ data['user']['companyName'] }},{{ data['user']['location'] }}</p>
            </div>
            <p class="content">{{ data['newcomment']['content'] }}</p>
        </div>
    </div>
</script>