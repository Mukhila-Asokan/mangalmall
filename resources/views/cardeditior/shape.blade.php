<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_basic_shapes">Basic Shapes</a>
        </h4>
    </div>
    <div id="acc_basic_shapes" class="panel-collapse collapse in pg-basic-shaps">
        <div class="panel-body">
            
            <ul>
                @foreach ($basic_shapes as $img)
                    <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_dividers">Dividers</a>
        </h4>
    </div>
    <div id="acc_dividers" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($dividers as $img)
                 <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_abstract">Abstract</a>
        </h4>
    </div>
    <div id="acc_abstract" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($abstract_shapes as $img)
                    <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_badges">Badges</a>
        </h4>
    </div>
    <div id="acc_badges" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($badges as $img)
                  <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_ecommerce">Ecommerce</a>
        </h4>
    </div>
    <div id="acc_ecommerce" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($ecommerce as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_arrow">Arrow</a>
        </h4>
    </div>							
    <div id="acc_arrow" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($arrow as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_banners">Banners</a>
        </h4>
    </div>
    <div id="acc_banners" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($banners as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_holiday">Holiday</a>
        </h4>
    </div>
    <div id="acc_holiday" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($holiday as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_button">Button</a>
        </h4>
    </div>
    <div id="acc_button" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($button as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_social">Social</a>
        </h4>
    </div>
    <div id="acc_social" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($social as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_emoji">Emoji</a>
        </h4>
    </div>
    <div id="acc_emoji" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($emoji as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_object">Object</a>
        </h4>
    </div>
    <div id="acc_object" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($object as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="panel"> 
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#acc_seasonal">Seasonal</a>
        </h4>
    </div>
    <div id="acc_seasonal" class="panel-collapse collapse">
        <div class="panel-body">
            <ul>
                @foreach ($seasonal as $img)
                <li><a class="pg-element-svg"><img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
