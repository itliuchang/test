<script id="postlistTpl" type="text/html">
    {{each data as v k}}
        <div class="postWrapper" data-id="{{ v.id }}">
            <div class="header">
                <img src="{{ v.portrait||'/images/account-default.png' }}" alt="" class="user" data-id="{{ v.userId }}">
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
<script id="productTpl" type="text/html">
    <div class="option nouse ">
        <h3>Fixed</h3>
        <div class="content">
            <div class="left">
                <h4>Entries:{{ data.name }}</h4>
                <p>Member Type:Company</p>
                <p>Location:{{ data.location }}</p>                             
                <p>{{ data.startDate }} - {{ data.endDate }}</p>
            </div>
            <div class="right">
                <h3 class="unlimited"></h3>
                <p>unlimited</p>
            </div>
        </div>
    </div>
</script>