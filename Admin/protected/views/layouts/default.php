<?php $this->beginContent('//layouts/main'); ?>
<div id="container">
    <nav id="header" class="clearfix">
        <div class="logo">
            <span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span>LBSM
        </div>
        <ul class="menu clearfix">
            <li><a href="/">首页</a></li>
            <li class="dropdown<?php echo $this->id == 'map'? ' on' : ''?>">
                <!-- <a href="/map.html">Map</a> -->
                <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="title dropdown-toggle">
                        地图<span class="caret"></span>
                    </span>
                </span>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li role="presentation"<?php echo $this->action->id=='index'? ' class="selected"' : ''?>>
                        <a role="menuitem" tabindex="-1" href="/map.html">创建(多边形区域)</a>
                    </li>
                    <li role="presentation" class="last<?php echo $this->action->id=='list'? ' selected' : ''?>">
                        <a role="menuitem" tabindex="-1" href="/map/list.html">列表(多边形区域)</a>
                    </li>
                    <li role="presentation" class="section<?php echo $this->action->id=='circreate'? ' selected' : ''?>">
                        <a role="menuitem" tabindex="-1" href="/map/circule/create.html">创建(圆形区域)</a>
                    </li>
                    <li role="presentation"<?php echo $this->action->id=='cirlist'? ' class="selected"' : ''?>>
                        <a role="menuitem" tabindex="-1" href="/map/circule/list.html">列表(圆形区域)</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown<?php echo $this->id == 'tips'? ' on' : ''?>">
                <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="title dropdown-toggle">
                        锦囊<span class="caret"></span>
                    </span>
                </span>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li role="presentation"<?php echo $this->action->id=='create'?' class="selected"' : ''?>>
                        <a role="menuitem" tabindex="-1" href="/tips/create.html">创建</a>
                    </li>
                    <li role="presentation"<?php echo $this->action->id=='index'? ' class="selected"' : ''?>>
                        <a role="menuitem" tabindex="-1" href="/tips.html">列表</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="actions clearfix">
            <li class="username"><?php echo Yii::app()->user->name ?></li>
            <li>[&nbsp;<a href="/logout.html">退出</a>&nbsp;]</li>
        </ul>
    </nav>
    
    <div id="main" class="clearfix">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>