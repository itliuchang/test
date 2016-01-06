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
        </div>
    {{/each}}
</script>