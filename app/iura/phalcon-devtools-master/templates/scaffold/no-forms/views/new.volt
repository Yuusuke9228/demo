<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("$plural$", "戻る") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        新規 $nplural$
    </h1>
</div>

{{ content() }}

{{ form("$plural$/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('登録', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
