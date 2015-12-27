<script id="indexTpl" type="text/html">
    {{each data as v k}}
        <div class="option">
            {{if v.id2 == 0}}
                <a href="message/{{v.id2}}/chat" class="link"></a>
                <a href="javascript:void(0);">
                  <img src="{{v.u2portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                </a>
                <div class="content">
                    <h3 class="overflow-line1">系统消息</h3>
                    <p class="overflow-line1">{{v.lastMsg | filterXSS}}</p>
                </div>
            {{else if v.id2 == uid}}
                <a href="message/{{v.id1}}/chat" class="link"></a>
                <a href="javascript:void(0);">
                  <img src="{{v.u1portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                </a>
                <div class="content">
                    <h3 class="overflow-line1">{{v.u1name | filterXSS}}</h3>
                    <p class="overflow-line1">{{v.lastMsg | filterXSS}}</p>
                </div>
            {{else}}
                <a href="message/{{v.id2}}/chat" class="link"></a>
                <a href="javascript:void(0);">
                  <img src="{{v.u2portrait}}" onerror="this.src='/images/portrait-default.png'" alt="">
                </a>
                <div class="content">
                    <h3 class="overflow-line1">{{v.u2name | filterXSS}}</h3>
                    <p class="overflow-line1">{{v.lastMsg | filterXSS}}</p>
                </div>
            {{/if}}
            
            <p class="time">{{v.utime | dgm}}</p>
        </div>
    {{/each}}
</script>