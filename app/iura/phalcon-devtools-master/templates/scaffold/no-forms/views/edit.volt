<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("$plural$", "戻る") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        修正 $nplural$
    </h1>
</div>

{{ content() }}

{{ form("$plural$/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('更新', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
