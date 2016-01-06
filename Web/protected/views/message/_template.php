<script id="indexTpl" type="text/html">
    {{each data as v k}}
        <div class="option">
            {{if v.id2 == 0}}
                <a href="/message/{{v.id2}}/chat" class="link"></a>
                <a href="javascript:void(0);">
                  <img src="{{v.u2portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                </a>
                <div class="content">
                    <h3 class="overflow-line1">系统消息</h3>
                    <p class="overflow-line1">{{v.lastMsg | filterXSS | unhtml}}</p>
                </div>
            {{else if v.id2 == uid}}
                <a href="/message/{{v.id1}}/chat" class="link"></a>
                <a href="javascript:void(0);">
                  <img src="{{v.u1portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                </a>
                <div class="content">
                    <h3 class="overflow-line1">{{v.u1name | filterXSS}}</h3>
                    <p class="overflow-line1">{{v.lastMsg | filterXSS | unhtml}}</p>
                </div>
            {{else}}
                <a href="/message/{{v.id2}}/chat" class="link"></a>
                <a href="javascript:void(0);">
                  <img src="{{v.u2portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                </a>
                <div class="content">
                    <h3 class="overflow-line1">{{v.u2name | filterXSS}}</h3>
                    <p class="overflow-line1">{{v.lastMsg | filterXSS | unhtml}}</p>
                </div>
            {{/if}}
            
            <p class="time">{{v.utime | dgm}}</p>
        </div>
    {{/each}}
</script>

<script id="showTpl" type="text/html">
    {{each data}}
       {{if $value.senderID == uid}}
            <div class="item my">
                <div class="imgWrapper">
                    <img src="{{myportrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                    <p class="date">{{$value.ctime | dataFormat:'MM/dd'}}</p>
                </div>
                <div class="content clearfix">
                    <div class="righto"></div>
                    <p>{{$value.body | filterXSS | unhtml}}</p>
                </div>
            </div>
       {{else}}
            <div class="item other">
                <div class="imgWrapper">
                    <img src="{{user.portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                    <p class="date">{{$value.ctime | dataFormat:'MM/dd'}}</p>
                </div>
                <div class="content">
                    <div class="lefto"></div>
                    <p>{{$value.body | filterXSS | unhtml}}</p>
                </div>
            </div>
       {{/if}}
    {{/each}}
</script>